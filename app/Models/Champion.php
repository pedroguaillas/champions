<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'organizer'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
