<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
