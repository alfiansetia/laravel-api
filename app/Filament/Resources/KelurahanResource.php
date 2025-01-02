<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelurahanResource\Pages;
use App\Filament\Resources\KelurahanResource\RelationManagers;
use App\Models\Kelurahan;
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

class KelurahanResource extends Resource
{
    protected static ?string $model = Kelurahan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Wilayah';

    protected static ?string $navigationLabel = 'Kelurahan';

    protected static ?int $navigationSort = 4;

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
                TextInput::make('pos_code')
                    ->label('Pos Code')
                    ->required()
                    ->maxLength(255),
                Select::make('kecamatan_id')
                    ->label('Kecamatan')
                    ->relationship('kecamatan', 'name')
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
                TextColumn::make('code')->label('Code')->sortable()->searchable(),
                TextColumn::make('full_code')->label('Full Code')->sortable()->searchable(),
                TextColumn::make('pos_code')->label('Pos Code')->sortable()->searchable(),
                TextColumn::make('kecamatan.name')->label('Kecamatan'),
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
            'index' => Pages\ListKelurahans::route('/'),
            // 'create' => Pages\CreateKelurahan::route('/create'),
            // 'edit' => Pages\EditKelurahan::route('/{record}/edit'),
        ];
    }
}
