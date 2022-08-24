<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratMasukResource\Pages;
use App\Filament\Resources\SuratMasukResource\RelationManagers;
use App\Models\SuratMasuk;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';
    protected static ?string $navigationGroup = 'Manajemen Surat';
    protected static ?string $recordTitleAttribute = 'document';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make("description")->label("Deskripsi"),
                TextInput::make('to')->label("Ditujukan ke"),
                FileUpload::make('document')
                    ->enableDownload()
                    ->required()
                    ->preserveFilenames()
                    ->unique()
            ]);
    }


    public static function table(Table $table): Table
    {
        $tertuju = static::$model::select('to')->distinct()->get()->pluck('to');
        $res = [];
        foreach($tertuju as $t){
            $res[$t] = $t;
        }
        $tertuju = $res;
        return $table
            ->columns([
                TextColumn::make('document')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
                TextColumn::make('to')->label("Ditujukan ke")->sortable()->searchable(),
                TextColumn::make('created_at')
                    ->label("Dibuat pada")
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make("to")->label("Ditujukan ke")->options($tertuju)

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
            'index' => Pages\ListSuratMasuks::route('/'),
            'create' => Pages\CreateSuratMasuk::route('/create'),
            'edit' => Pages\EditSuratMasuk::route('/{record}/edit'),
        ];
    }
}
