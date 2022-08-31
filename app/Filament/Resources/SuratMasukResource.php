<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratMasukResource\Pages;
use App\Filament\Resources\SuratMasukResource\RelationManagers;
use App\Models\SuratMasuk;
use Filament\Forms;
use Filament\Forms\Components\Card;
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
use Illuminate\Support\Collection;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';
    protected static ?string $navigationGroup = 'Manajemen Surat';
    protected static ?string $recordTitleAttribute = 'document';
    protected static ?string $navigationLabel = 'Surat Masuk';
    protected static ?int $navigationSort = 3;




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('document')
                            ->label("Surat")
                            ->enableDownload()
                            ->required()
                            ->preserveFilenames()
                            ->unique(),
                        TextInput::make('to')->label("Ditujukan ke")->required(),
                        TextInput::make('from')->label("Dari")->required(),
                    ]),
                Card::make()
                    ->schema([
                        Textarea::make("description")->label("Deskripsi")->required(),
                    ])
            ]);
    }


    public static function table(Table $table): Table
    {
        $tertuju = static::restructure(static::$model::select('to')->distinct()->get()->pluck('to'));
        $dari = static::restructure(static::$model::select('from')->distinct()->get()->pluck('from'));
        return $table
            ->columns([
                TextColumn::make('document')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
                TextColumn::make('from')->label("Dari")->sortable()->searchable(),
                TextColumn::make('to')->label("Ditujukan ke")->sortable()->searchable(),
                TextColumn::make('created_at')
                    ->label("Dibuat pada")
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make("to")->label("Ditujukan ke")->options($tertuju),
                SelectFilter::make("from")->label("Dari")->options($dari)

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function restructure(array|Collection $items){
        $res = [];
        foreach($items as $t){
            $res[$t] = $t;
        }
        return $res;
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
