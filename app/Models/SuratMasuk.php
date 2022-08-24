<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = "documents";
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('surat-masuk', function (Builder $builder) {
            $builder->where('type', cons("KATEGORI.SURAT.MASUK"));
        });
        static::creating(function ($query) {
            $query->type = cons("KATEGORI.SURAT.MASUK");
        });
    }
}
