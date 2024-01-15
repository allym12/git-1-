<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentTransactionResource\Pages;
use App\Filament\Resources\PaymentTransactionResource\RelationManagers;
use App\Models\PaymentTransaction;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class PaymentTransactionResource extends Resource
{
    protected static ?string $model = PaymentTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('payment_phone')
                            ->tel()
                            ->telRegex('/^078\d{7}$/')
                            ->placeholder('Format: 078XXXXXXX')

                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('number_of_uploads')
                            ->numeric()->required()
                            ->minValue(0)
                            ->maxValue(1000)
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('total_amount', $state * config('payouts.uploading_cost'));
                            }),


                        Forms\Components\TextInput::make('total_amount')
                            ->required()
                            ->label('Total Amount to be paid')
                            ->suffix('RWF')
                            ->disabled(),
                    ])->columns(3)


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Seller')->visible(fn() => auth()->user()->isAdmin()),
                Tables\Columns\TextColumn::make('transaction_id')->wrap(),
                Tables\Columns\BadgeColumn::make('status')
                    ->enum([
                        '1' => 'Paid',
                        '0' => 'Not paid',
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

                Tables\Columns\TextColumn::make('created_at')
                    ->date('d/m/Y H:i:s')

            ])
            ->filters([
                DateRangeFilter::make('created_at')
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
            'index' => Pages\ListPaymentTransactions::route('/'),
            'create' => Pages\CreatePaymentTransaction::route('/create'),
            'edit' => Pages\EditPaymentTransaction::route('/{record}/edit'),
        ];
    }



}
