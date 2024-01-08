<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationGroup = 'Øvelsesbank';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->autocomplete(false),
                        Forms\Components\ViewField::make('empty')->view('filament.select-exercise-type')
                            ->hidden(fn (Get $get): bool => ! empty($get('exercise_type'))),
                        Forms\Components\Section::make('Description')
                            ->schema([
                                Forms\Components\Repeater::make('description')
                                    ->schema([
                                        Forms\Components\TextInput::make('title'),
                                        Forms\Components\RichEditor::make('content'),
                                    ])
                                    ->label('')
                                    ->addActionLabel('Tilføj sektion')
                                    ->reorderableWithButtons()
                                    ->reorderableWithDragAndDrop(false)
                                    ->default(function (Get $get) {
                                        if ($get('exercise_type') == 'football') {
                                            return [
                                                ['title' => 'Beskrivelse', 'content' => ''],
                                                ['title' => 'Instruktioner', 'content' => ''],
                                                ['title' => 'Progression / Regression', 'content' => ''],
                                            ];
                                        } elseif ($get('exercise_type') == 'fitness') {
                                            return [
                                                ['title' => 'Instruktioner', 'content' => ''],
                                                ['title' => 'Progression / Regression', 'content' => ''],
                                            ];
                                        }

                                        return [];
                                    }),
                            ])
                            ->collapsible()
                            ->hidden(fn (Get $get): bool => ! $get('exercise_type'))
                            ->key('description'),

                        Forms\Components\Section::make('Media')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image(),
                                Forms\Components\TextInput::make('video_url')
                                    ->maxLength(255)
                                    ->autocomplete(false),
                            ])
                            ->hidden(fn (Get $get): bool => ! $get('exercise_type')),

                        Forms\Components\Section::make('Settings')
                            ->schema([
                                Forms\Components\Select::make('age_group_id_from')
                                    ->relationship('ageGroupFrom', 'name'),
                                Forms\Components\Select::make('age_group_id_to')
                                    ->relationship('ageGroupTo', 'name'),
                                Forms\Components\TextInput::make('players_from')
                                    ->hidden(fn (Get $get): bool => $get('exercise_type') === 'fitness')
                                    ->numeric()
                                    ->autocomplete(false),
                                Forms\Components\TextInput::make('players_to')
                                    ->hidden(fn (Get $get): bool => $get('exercise_type') === 'fitness')
                                    ->numeric()
                                    ->autocomplete(false),
                            ])
                            ->columns(2)
                            ->hidden(fn (Get $get): bool => ! $get('exercise_type')),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Select::make('exercise_type')
                                    ->options([
                                        'football' => 'Football',
                                        'fitness' => 'Fitness',
                                    ])
                                    ->disabledOn('edit')
                                    ->live()
                                    ->afterStateUpdated(function (?Exercise $record, Select $component, Forms\Set $set) {
                                        if (! is_null($record)) {
                                            return;
                                        }

                                        if ($component->getState() == 'football') {
                                            $set('description', [
                                                ['title' => 'Beskrivelse', 'content' => ''],
                                                ['title' => 'Instruktioner', 'content' => ''],
                                                ['title' => 'Progression / Regression', 'content' => ''],
                                            ]);
                                        } else {
                                            $set('description', [
                                                ['title' => 'Instruktioner', 'content' => ''],
                                                ['title' => 'Progression / Regression', 'content' => ''],
                                            ]);
                                        }

                                    }),
                                Forms\Components\Select::make('activity_type')
                                    ->options(function (Get $get) {
                                        if ($get('exercise_type') == 'football') {
                                            return [
                                                'øvelse' => 'Øvelse',
                                                'spil' => 'Spil',
                                                'kamp' => 'Kamp',
                                                'leg' => 'Leg',
                                            ];
                                        } elseif ($get('exercise_type') == 'fitness') {
                                            return [
                                                'cardio' => 'Cardio',
                                                'strength' => 'Styrke',
                                                'agility' => 'Smidighed',
                                                'balance' => 'Balance',
                                            ];
                                        }

                                        return [];
                                    })
                                    ->hidden(fn (Get $get): bool => ! $get('exercise_type')),
                            ]),

                        Forms\Components\Section::make('Tags')
                            ->description('Tilføj de relevante tags til øvelse')
                            ->schema([
                                Select::make('Technical')
                                    ->multiple()
                                    ->options(Tag::where('type', 'technical')->pluck('name', 'id')->toArray()),
                                Select::make('Physical')
                                    ->multiple()
                                    ->options(Tag::where('type', 'physical')->pluck('name', 'id')->toArray()),
                                Select::make('Mental')
                                    ->multiple()
                                    ->options(Tag::where('type', 'mental')->pluck('name', 'id')->toArray()),
                                Select::make('Tactical')
                                    ->multiple()
                                    ->options(Tag::where('type', 'tactical')->pluck('name', 'id')->toArray()),
                            ]),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Exercise $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (Exercise $record): ?string => $record->updated_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('created_by')
                                    ->label('Created by')
                                    ->content(fn (Exercise $record): ?string => 'Troels Johnsen'),
                            ])
                            ->columnSpan(['lg' => 1])
                            ->hidden(fn (?Exercise $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Group::make()
                    ->schema([
                        Infolists\Components\Section::make('Description')
                            ->schema([
                                RepeatableEntry::make('description')
                                    ->label('')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('title')
                                            ->label('')
                                            ->html()
                                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large),
                                        Infolists\Components\TextEntry::make('content')
                                            ->label('')
                                            ->html(),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                        Infolists\Components\Section::make('Media')
                            ->schema([
                                Infolists\Components\ImageEntry::make('image'),
                                Infolists\Components\TextEntry::make('video_url'),
                            ])->columns(2),
                        Infolists\Components\Section::make('Settings')
                            ->schema([
                                Infolists\Components\TextEntry::make('ageGroupFrom'),
                                Infolists\Components\TextEntry::make('ageGroupTo'),
                                Infolists\Components\TextEntry::make('players_from'),
                                Infolists\Components\TextEntry::make('players_to'),
                            ])->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Infolists\Components\Group::make()
                    ->schema([
                        Infolists\Components\Section::make('Type')
                            ->schema([
                                Infolists\Components\TextEntry::make('activity_type'),
                                Infolists\Components\TextEntry::make('exercise_type'),
                            ]),
                        Infolists\Components\Section::make('Categories')
                            ->schema([
                                Infolists\Components\SpatieTagsEntry::make('technical')
                                    ->type('technical'),
                                Infolists\Components\SpatieTagsEntry::make('physical')
                                    ->type('physical'),
                                Infolists\Components\SpatieTagsEntry::make('tactical')
                                    ->type('tactical'),
                                Infolists\Components\SpatieTagsEntry::make('mental')
                                    ->type('mental'),
                            ]),
                        Infolists\Components\Section::make('Dates')
                            ->schema([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->dateTime(),
                                Infolists\Components\TextEntry::make('updated_at')
                                    ->dateTime(),
                                Infolists\Components\TextEntry::make('created_by'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);

        //            ->schema([
        //                Infolists\Components\TextEntry::make('activity_type'),
        //                Infolists\Components\TextEntry::make('exercise_type'),
        //                Infolists\Components\TextEntry::make('name')
        //                    ->columnSpanFull(),
        //                Infolists\Components\TextEntry::make('slug')
        //                    ->columnSpanFull(),
        //                RepeatableEntry::make('description')
        //                    ->schema([
        //                        TextEntry::make('title')
        //                            ->size(TextEntry\TextEntrySize::Large),
        //                        TextEntry::make('content')
        //                            ->markdown()
        //                            ->columnSpan(2),
        //                    ])
        //                    ->columnSpanFull(),
        //                Infolists\Components\ImageEntry::make('image')
        //                    ->disk('public')
        //                    ->columnSpanFull(),
        //                Infolists\Components\TextEntry::make('video_url')
        //                    ->columnSpanFull(),
        //                Infolists\Components\TextEntry::make('age_group_id_from'),
        //                Infolists\Components\TextEntry::make('age_group_id_to'),
        //                Infolists\Components\TextEntry::make('age_from'),
        //                Infolists\Components\TextEntry::make('age_to'),
        //                Infolists\Components\TextEntry::make('players_from'),
        //                Infolists\Components\TextEntry::make('players_to'),
        //                Infolists\Components\TextEntry::make('duration_from'),
        //                Infolists\Components\TextEntry::make('duration_to'),
        //                Infolists\Components\TextEntry::make('tags_as_string')
        //                    ->label('Tags'),
        //
        //            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exercise_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('activity_type')
                    ->searchable(),
            ])
            ->filters([
                //
                SelectFilter::make('exercise_type')
                    ->options([
                        'football' => 'Football',
                        'fitness' => 'Fitness',
                    ])
                    ->attribute('exercise_type'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    /*
    protected static function footballExerciseSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->autocomplete(false),
            Forms\Components\Select::make('activity_type')
                ->options([
                    'spil' => 'Spil',
                    'øvelse' => 'Øvelse',
                ]),
            Forms\Components\Repeater::make('description')
                ->schema([
                    Forms\Components\TextInput::make('title'),
                    Forms\Components\RichEditor::make('content'),
                ])->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->image(),
            Forms\Components\TextInput::make('video_url')
                ->maxLength(255)
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_group_id_from')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_group_id_to')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_from')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_to')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('players_from')
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('players_to')
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('duration_from')
                ->numeric()
                ->autocomplete(false)
                ->label('Duration to (minutes)'),
            Forms\Components\TextInput::make('duration_to')
                ->numeric()
                ->autocomplete(false)
                ->label('Duration from (minutes)'),
            Forms\Components\Section::make('Tags')
                ->description('Tilføj de relevante tags til øvelse')
                ->schema([
                    SpatieTagsInput::make('Position')
                        ->type('position'),
                    SpatieTagsInput::make('Role')
                        ->type('role'),
                    SpatieTagsInput::make('Phase')
                        ->type('phase'),
                    SpatieTagsInput::make('Technical')
                        ->type('technical'),
                    SpatieTagsInput::make('Physical')
                        ->type('physical'),
                    SpatieTagsInput::make('Mental')
                        ->type('mental'),
                    SpatieTagsInput::make('Tactical')
                        ->type('tactical'),
                ])
                ->collapsed(),
        ];
    }

    protected static function fitnessExerciseSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->columnSpanFull()
                ->autocomplete(false),
            Forms\Components\Repeater::make('description')
                ->schema([
                    Forms\Components\TextInput::make('title'),
                    Forms\Components\RichEditor::make('content'),
                ])
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->image(),
            Forms\Components\TextInput::make('video_url')
                ->maxLength(255)
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_group_id_from')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_group_id_to')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_from')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\TextInput::make('age_to')
                ->required()
                ->numeric()
                ->autocomplete(false),
            Forms\Components\Section::make('Tags')
                ->description('Tilføj de relevante tags til fitness øvelse')
                ->schema([
                    SpatieTagsInput::make('Område')
                        ->type('område'),
                    SpatieTagsInput::make('Øvelses type')
                        ->type('exercise_type'),
                    SpatieTagsInput::make('Intensitet')
                        ->type('intensitet'),
                ])
                ->collapsed(),
        ];
    }
    */

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\ExercisesRelationManager::class,
            RelationManagers\EquipmentRelationManager::class,
            RelationManagers\CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'view' => Pages\ViewExercise::route('/{record}'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
