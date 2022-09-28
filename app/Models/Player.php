<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'champion_id', 'team_id', 'cedula',
        'first_name', 'last_name', 'photo'
    ];
}
