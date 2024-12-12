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

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservedByUsers()
    {
        return $this->belongsToMany(User::class, 'reservations', 'game_id', 'user_id')
                    ->withPivot('reservation_date', 'status')
                    ->withTimestamps();
    }


    public function purchasedByUsers()
    {
        return $this->belongsToMany(User::class, 'purchases', 'game_id', 'user_id');
    }


    protected $primaryKey = 'id';

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

    public function getImage()
    {
        return $this->image;
    }
}
