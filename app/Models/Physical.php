<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physical extends Model
{
    use HasFactory;
    protected $fillable = [
        'player_id',
        'aggression',
        'strength',
        'explosiveness',
        'power',
        'change_of_pace',
        'ball_protection',
        'jumping',
        'stamina',
        'aerobic_capacity',
        'speed',
        'agility',
        'balance',
        'acceleration',
        'repeated_sprint_ability',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}