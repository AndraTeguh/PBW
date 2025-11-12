<?php

namespace App\Filament\Resources;

use App\Models\Komentar;
use Filament\Tables;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Tables\Actions\DeleteAction;
use App\Filament\Resources\KomentarResource\Pages;

class KomentarResource extends Resource
{
    protected static ?string $model = Komentar::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Komentar';
    protected static ?string $pluralModelLabel = 'Komentar';
    protected static ?string $navigationGroup = 'Manajemen Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('news_id')
                    ->relationship('news', 'judul')
                    ->label('Judul Berita')
                    ->disabled(),
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Komentator')
                    ->disabled(),
                Forms\Components\Textarea::make('isi')
                    ->label('Isi Komentar')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('news.judul')->label('Judul Berita')->sortable()->searchable(),
                TextColumn::make('nama')->label('Nama Komentator')->sortable()->searchable(),
                TextColumn::make('isi')->label('Isi Komentar')->limit(50),
                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime()->sortable(),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKomentars::route('/'),
        ];
    }
}
