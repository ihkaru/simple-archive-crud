<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
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
        static::addGlobalScope('surat-keluar', function (Builder $builder) {
            $builder->where('type', cons("KATEGORI.SURAT.KELUAR"));
        });
        static::creating(function ($query) {
            $query->type = cons("KATEGORI.SURAT.KELUAR");
        });
    }
}
