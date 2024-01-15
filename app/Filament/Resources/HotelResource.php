<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\District;
use App\Models\Hotel;
use App\Models\House;
use App\Models\Province;
use App\Models\Sector;
use App\Models\User;
use Filament\Forms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Nuhel\FilamentCroppie\Components\Croppie;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;
    protected static ?string $navigationLabel = 'Hotels';
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->columns(1)
                    ->schema([

                        Forms\Components\Select::make('user_id')
                            ->label('Seller')
                            ->searchable()
                            ->required()
                            ->visible(fn() => auth()->user()->isAdmin()) // only admin can see this field
                            ->options(\App\Models\User::query()
                                ->where('role', 'seller')
                                ->pluck('name', 'id')->toArray())
                            ->createOptionForm([
                                Forms\Components\Card::make()->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->autofocus()
                                        ->required()
                                        ->maxLength(255)
                                        ->disableAutocomplete()
                                        ->placeholder(__('Name')),

                                    Forms\Components\TextInput::make('email')
                                        ->type('email')
                                        ->required()
                                        ->unique(User::class, 'email')
                                        ->disableAutocomplete()
                                        ->placeholder(__('Email')),

                                    Forms\Components\TextInput::make('phone')
                                        ->type('tel')
                                        ->unique(User::class, 'phone')
                                        ->required()
                                        ->placeholder(__('Phone')),

                                    Forms\Components\Hidden::make('role')
                                        ->default('seller')
                                ])->columns(2),
                            ])
                            ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                                return $action
                                    ->modalHeading('Create customer')
                                    ->modalButton('Create customer')
                                    ->modalWidth('lg');
                            })

                            ->createOptionUsing(function (array $data) {
                                $created = User::create($data);
                                return $created->id;
                            })

                            ->preload(),


                        Forms\Components\TextInput::make('name')
                            ->label('Hotel name')
                            ->required()
                            ->autofocus()
                        ,
                        Forms\Components\RichEditor::make('description')
                            ->autofocus()
                        ,
                    ]),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('province')
                            ->label('Province')
                            ->options(Province::all()->pluck('province_name', 'id')->toArray())
                            ->reactive()
                            ->searchable()
                            ->afterStateUpdated(fn(callable $set) => $set('district', null)),

                        Forms\Components\Select::make('district')
                            ->label('District')
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn(callable $set) => $set('sector', null))
                            ->options(function (callable $get) {
                                $province = Province::find($get('province'));
                                if (!$province) {
                                    return [];
                                }
                                return $province->districts->pluck('district_name', 'id');
                            }),


                        Forms\Components\Select::make('sector')
                            ->label('Sector')
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn(callable $set) => $set('cell_id', null))
                            ->options(function (callable $get) {
                                $district = District::find($get('district'));
                                if (!$district) {
                                    return [];
                                }
                                return $district->sectors->pluck('sector_name', 'id');
                            }),

                    ])->columns(4),

                Forms\Components\Card::make()
                    ->columns(1)
                    ->schema([
                        Croppie::make('image')
                            ->enableOpen()->enableDownload()
                            ->imageResizeTargetWidth('600')
                            ->imageResizeTargetHeight('370')
                            ->modalSize('xl'),
                        Forms\Components\FileUpload::make('other_photos')
                            ->multiple()->image(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('owner.name')
                    ->sortable()
                    ->visible(fn() => auth()->user()->isAdmin()),
                ImageColumn::make('image'),
                TextColumn::make('name')->wrap()->limit(50)->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->enum([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->icons([
                        'heroicon-o-x' => '0',
                        'heroicon-o-check' => '1',
                    ])
                    ->colors([
                        'danger' => '0',
                        'success' => '1',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                DateRangeFilter::make('created_at')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\ActionGroup::make([

                    Tables\Actions\Action::make('activate')
                        ->action(function (Hotel $record) {
                            $record->update(['status' => 1]);

                            Notification::make()
                                ->success()
                                ->title('Hotel is activated')
                                ->body('The recently uploaded hotel has been activated successfully.')
                                ->actions([
                                    Action::make('view')
                                        ->button()
                                        ->color('primary')
                                        ->url(HotelResource::getUrl(), shouldOpenInNewTab: true)
                                ])
                                ->icon('heroicon-o-document-text')
                                ->iconColor('success')
                                ->send()
                                ->sendToDatabase(User::find($record->user_id));

                        })
                        //visible only if the record is inactive
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation('Are you sure you want to activate this hotel?'),


                    Tables\Actions\Action::make('deactivate')
                        ->action(function (Hotel $record) {
                            $record->update(['status' => 0]);
                        })
                        //visible only if the record is active
                        ->icon('heroicon-o-x')
                        ->color('danger')
                        ->requiresConfirmation('Are you sure you want to deactivate this hotel?'),
                ])->hidden(fn() => auth()->user()->role !== 'admin') // only admin can see this action group

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
