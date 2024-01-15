<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
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
                Impersonate::make(),

                Tables\Actions\EditAction::make()->slideOver(),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Activate')

                        ->action(function (User $record) {
                            $record->update(['status' => 1]);
                            Filament::notify('success', __('User Activated'));

                            Notification::make()
                                ->title('Saved successfully')
                                ->success()
                                ->body('Changes to the **post** have been saved.')
                                ->actions([
                                    Action::make('view')
                                        ->button(),
                                    Action::make('undo')
                                        ->color('secondary'),
                                ])
                                ->sendToDatabase(auth()->user());
                        })
                        //visible only if the record is inactive
                        ->hidden(fn (User $record) => $record->status == 1)
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation(),


                    Tables\Actions\Action::make('deactivate')
                        ->action(function (User $record) {
                            $record->update(['status' => 0]);
                            Notification::make()
                                ->title('User Deactivated')
                                ->warning()
                                ->send();
                        })
                        //visible only if the record is active
                        ->icon('heroicon-o-x')
                        ->color('danger')
                        ->requiresConfirmation(),
                ]),
            ])

            ->headerActions([
                    FilamentExportHeaderAction::make('export')
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export')
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
            'index' => Pages\ListUsers::route('/'),
//            'create' => Pages\CreateUser::route('/create'),
//            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query()->whereNot('id',auth()->id())->where('role','!=','user');
    }




}
