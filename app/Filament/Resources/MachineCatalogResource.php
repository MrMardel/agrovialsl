<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MachineCatalogResource\Pages;
use App\Filament\Resources\MachineCatalogResource\RelationManagers;
use App\Models\MachineCatalog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;

class MachineCatalogResource extends Resource
{
    protected static ?string $model = MachineCatalog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Crear máquina')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Datos generales')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('brand')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('images')
                                    ->required()
                                    ->multiple()
                                    ->directory('machine-catalogs')
                                    ->preserveFilenames()
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1920')
                                    ->imageResizeTargetHeight('1080'),
                                Forms\Components\FileUpload::make('attachments')
                                    ->directory('machine-attachments'),
                                Forms\Components\TextInput::make('model')
                                    ->maxLength(255),
                                Forms\Components\Select::make('power_type')
                                    ->required()
                                    ->options([
                                        'diesel' => 'Diesel',
                                        'nafta' => 'Nafta',
                                        'litio' => 'Litio',
                                        'plomo' => 'Plomo'
                                    ])
                                    ->native(false)
                                    ->preload(),
                                Forms\Components\TextInput::make('condition')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('year'),
                                Forms\Components\TextInput::make('hours')
                                    ->numeric(),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('location')
                                    ->maxLength(255)
                                    ->default('General Pico')
                                    ->readOnly(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Descripción')
                            ->schema([
                                Forms\Components\RichEditor::make('description')
                                    ->label('Descripción general')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Técnico')
                            ->schema([
                                Forms\Components\Repeater::make('technical_specs')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')->required(),
                                        Forms\Components\TextInput::make('value')->required(),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Características')
                            ->schema([
                                Forms\Components\Repeater::make('features')
                                    ->schema([
                                        Forms\Components\TextInput::make('value')->required(),
                                    ])
                                    ->columns(1),
                                Forms\Components\Repeater::make('maintenance')
                                    ->schema([
                                        Forms\Components\TextInput::make('value')->required(),
                                    ])
                                    ->columns(1),
                            ])->columnSpan(2),

                        Forms\Components\Tabs\Tab::make('Publicación')
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('Publicado')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Fecha de publicación'),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ])->columnSpanFull()
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('power_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('condition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMachineCatalogs::route('/'),
        ];
    }
}
