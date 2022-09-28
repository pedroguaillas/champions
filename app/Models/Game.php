<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id', 'team2_id', 'progress_id',
        'captain1_id', 'captain2_id', 'date',
        'time', 'team1_goal', 'team2_goal'
    ];
}
