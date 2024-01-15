<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Our customers';

    protected static ?string $slug = 'customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                        ->unique(User::class, 'email',ignoreRecord: true)
                        ->disableAutocomplete()
                        ->placeholder(__('Email')),

                    Forms\Components\TextInput::make('phone')
                        ->type('tel')
                        ->required()
                        ->unique( ignoreRecord: true)
                        ->disableAutocomplete()
                        ->placeholder(__('Phone')),

                    Forms\Components\Select::make('role')
                        ->required()
                        ->options([
                            'admin' => __('Admin'),
                            'seller' => __('Seller'),
                            'user' => __('User'),
                        ])
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')->boolean(),
            ])
            ->filters([
                DateRangeFilter::make('created_at')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Impersonate::make(),
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
            'index' => Pages\ListCustomers::route('/'),
//            'create' => Pages\CreateCustomer::route('/create'),
//            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'user');
    }
}
