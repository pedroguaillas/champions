<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'category_id', 'group_id', 'paid'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
