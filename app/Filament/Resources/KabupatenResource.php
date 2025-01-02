<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KabupatenResource\Pages;
use App\Filament\Resources\KabupatenResource\RelationManagers;
use App\Models\Kabupaten;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KabupatenResource extends Resource
{
    protected static ?string $model = Kabupaten::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Wilayah';

    protected static ?string $navigationLabel = 'Kabupaten';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->label('Code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('full_code')
                    ->label('Full Code')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Type')
                    ->options(['kabupaten', 'kota'])
                    ->required(),
                Select::make('provinsi_id')
                    ->label('Provinsi')
                    ->relationship('provinsi', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                TextColumn::make('type')->label('Type')->sortable()->searchable(),
                TextColumn::make('code')->label('Code')->sortable()->searchable(),
                TextColumn::make('full_code')->label('Full Code')->sortable()->searchable(),
                TextColumn::make('provinsi.name')->label('Provinsi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListKabupatens::route('/'),
            // 'create' => Pages\CreateKabupaten::route('/create'),
            // 'edit' => Pages\EditKabupaten::route('/{record}/edit'),
        ];
    }
}
