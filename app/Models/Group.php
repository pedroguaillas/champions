<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
