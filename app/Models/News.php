<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $primaryKey = 'news_id';

    protected $fillable = [
        'title',
        'image',
        'journalist',
        'synopsis',
        'release_date',
    ];

    protected $keyType = 'int';

    public function casts () {
        return[
            'release_date' => 'datetime',  
        ];
    }

    protected $dates = ['release_date'];
}

