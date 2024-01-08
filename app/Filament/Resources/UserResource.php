<?php

namespace App\Filament\Resources;

use App\Actions\User\ApproveUser;
use App\Filament\Resources\UserResource\Pages;
use App\Models\Club;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getNavigationBadge(): ?string
    {
        $userCount = static::getModel()::isNotApproved()->count();
        if ($userCount == 0) {
            return '';
        }

        return $userCount;

    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Bruger')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Profil billede')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image(),
                    ]),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\DateTimePicker::make('approved_at'),
                Forms\Components\Select::make('club_id')
                    ->relationship('club', 'name'),
                Forms\Components\TextInput::make('profile_photo_path')
                    ->maxLength(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('club.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ageGroup.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_login_at')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('approved_at_boolean')
                    ->label('Bruger godkendt')
                    ->boolean('approved_at')
                    ->sortable(['approved_at'])
                    ->toggleable(),
            ])
            ->filters([
                //
                Tables\Filters\Filter::make('club')
                    ->form([
                        Forms\Components\Select::make('club_id')
                            ->required()
                            ->options(Club::all()->pluck('name', 'id')->toArray())
                            ->label('Klub'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['club_id'],
                            fn (Builder $query, $clubId): Builder => $query->whereHas('club', function ($query) use ($clubId) {
                                $query->where('clubs.id', $clubId);
                            })
                        );
                    }),
                Tables\Filters\Filter::make('approved_at')
                    ->query(fn (Builder $query): Builder => $query->whereNull('approved_at'))
                    ->label('Ikke godkendte brugere'),
            ])
            ->actions([
                Tables\Actions\Action::make('Godkend Bruger')
                    ->button()
                    ->action(function ($record) {
                        $user = User::find($record->id);
                        if ($user) {
                            ApproveUser::run($user);
                        }
                    })
                    ->visible(function ($record) {
                        return is_null($record->approved_at);
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
