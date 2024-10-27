<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mental extends Model
{
    use HasFactory;
    protected $fillable = [
        'player_id',
        'leadership',
        'temperament',
        'error_handling',
        'determination',
        'team_work',
        'decision_making',
        'concentration',
        'charisma',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}