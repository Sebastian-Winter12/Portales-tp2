<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    use HasFactory;

    protected $primaryKey = 'age_id';

    public function games()
{
    return $this->hasMany(Game::class, 'age_fk', 'age_id');
}

}
