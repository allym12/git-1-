<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FashionResource\Pages;
use App\Filament\Resources\FashionResource\RelationManagers;
use App\Models\Fashion;
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

class FashionResource extends Resource
{
    protected static ?string $model = Fashion::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Fashion Items';

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

                        Forms\Components\TextInput::make('title')
                            ->autofocus()->required()
                        ,
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull()
                            ->autofocus(),

                        Forms\Components\TextInput::make('price')
                            ->numeric(11)->columnSpanFull()
                    ]),
                Forms\Components\Card::make()
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\CheckboxList::make('colors')
                            ->label('Available Colors')
                            ->options([
                                'red' => 'Red',
                                'green' => 'Green',
                                'blue' => 'Blue',
                                'yellow' => 'Yellow',
                                'black' => 'Black',
                                'white' => 'White',
                                'orange' => 'Orange',
                                'purple' => 'Purple',
                                'pink' => 'Pink',
                                'brown' => 'Brown',
                                'gray' => 'Gray',
                                'silver' => 'Silver',
                                'gold' => 'Gold',
                                'violet' => 'Violet',
                                'indigo' => 'Indigo',
                                'beige' => 'Beige',

                            ])->columns(6)
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
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('owner.name')
                    ->sortable()
                    ->visible(fn() => auth()->user()->isAdmin()),
                ImageColumn::make('image'),
                TextColumn::make('title')->wrap()->limit(50)->searchable(),
                TextColumn::make('price'),

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
            'index' => Pages\ListFashions::route('/'),
            'create' => Pages\CreateFashion::route('/create'),
            'edit' => Pages\EditFashion::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Fashion Item';
    }

}
