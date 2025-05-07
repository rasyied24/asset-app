<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Ambil ID terakhir
            $lastId = static::max('id') ?? 0;
            $nextId = $lastId + 1;

            // Format kode seperti AST-0001
            $model->code = 'AST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }

    public static function generateNextCode(): string
    {
        $lastId = static::max('id') ?? 0;
        $nextId = $lastId + 1;
        return 'AST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }


}
