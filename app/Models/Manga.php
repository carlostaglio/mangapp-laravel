<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    /** @use HasFactory<\Database\Factories\MangaFactory> */
    use HasFactory;

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
}
