<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Usuário';
    protected static ?string $pluralLabel = 'Usuários';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Grid::make(['default' => 8])->schema([

                    Grid::make()->schema([

                        FileUpload::make('photo')->image()->imageEditor()->imageCropAspectRatio('1:1')
                            ->panelLayout('integrated')->panelAspectRatio('1:1')->label('Foto')->columnSpanFull(),

                        Toggle::make('is_admin')->required()->columnSpanFull(),

                    ])->columnSpan(2),

                    Grid::make(['default' => 6])->schema([

                        TextInput::make('name')->required()->maxLength(255)->minLength(3)->label('Nome')->columnSpanFull(),

                        TextInput::make('email')->email()->required()->maxLength(255)->columnSpanFull(),

                        TextInput::make('password')->password()->required()->maxLength(255)->columnSpanFull(),

                        TextInput::make('email_verified_at')->readOnly(true)->disabled(true)->columnSpanFull(),

                    ])->columnSpan(6),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->circular()->defaultImageUrl(url('/images/user_1.png'))->label('Foto'),

                TextColumn::make('name')->searchable()->sortable(),

                TextColumn::make('email')->searchable()->sortable(),

                ToggleColumn::make('is_admin')->label('admin')->sortable(),

                TextColumn::make('created_at')->dateTime('d/m/y')->sortable()->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])

            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])

            ->actions([
                /*EditAction::make()->button()->size('xl')->label('')->icon('gmdi-edit-square')->color('gray'),*/

                DeleteAction::make()->button()->size('xl')->label('')->icon('gmdi-delete')->color('gray'),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
