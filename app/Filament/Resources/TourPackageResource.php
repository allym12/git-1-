<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourPackageResource\Pages;
use App\Filament\Resources\TourPackageResource\RelationManagers;
use App\Models\Province;
use App\Models\TourPackage;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nuhel\FilamentCroppie\Components\Croppie;

class TourPackageResource extends Resource
{
    protected static ?string $model = TourPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Forms\Components\Card::make()
                    ->columns()
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


                        Forms\Components\TextInput::make('package_title')
                            ->label('Tour title')
                            ->autofocus()->required()
                        ,
                        Forms\Components\RichEditor::make('package_description')
                            ->label('Tour description')
                            ->columnSpanFull()
                            ->autofocus()
                        ,
                    ]),


                Forms\Components\Card::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('package_price')
                            ->numeric(11),

                        Forms\Components\Select::make('package_location')
                            ->label('Tour location')
                            ->searchable()
                            ->options(
                                Province::query()
                                    ->pluck('province_name', 'province_name')
                                    ->toArray()
                            )
                            ->placeholder('Select Location'),

                        Forms\Components\TextInput::make('package_duration')
                            ->numeric(11)
                        ->suffix('Days'),

                    ]),


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
            ->columns([
                ImageColumn::make('image')->rounded(),
                TextColumn::make('package_title'),
                TextColumn::make('package_location'),
                TextColumn::make('package_price'),
                TextColumn::make('package_duration'),
                TextColumn::make('created_at')->label('Created')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTourPackages::route('/'),
            'create' => Pages\CreateTourPackage::route('/create'),
            'edit' => Pages\EditTourPackage::route('/{record}/edit'),
        ];
    }
}
