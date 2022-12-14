<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = ['champion_id', 'description', 'active', 'date'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
