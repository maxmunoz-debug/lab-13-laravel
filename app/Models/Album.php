<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    // Campos que permitimos llenar masivamente
    protected $fillable = ['nombre', 'descripcion', 'user_id'];

    // Relación: Un álbum pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un álbum contiene muchas fotos
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}