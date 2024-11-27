<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'game_type',
        'release_date',
        'price',
        'image',
        'age_fk'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchases::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'purchases', 'game_id', 'user_id');
}


    protected $primaryKey = 'game_id'; // Esto asegura que se use game_id como clave primaria

    public function casts()
    {
        return [
            'release_date' => 'datetime',
            'price' => 'integer',
        ];
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_fk', 'age_id');
    }
}
