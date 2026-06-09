<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    // Campos que permitimos llenar masivamente
    protected $fillable = ['titulo', 'ruta', 'album_id'];

    // Relación: Una foto pertenece a un álbum
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}