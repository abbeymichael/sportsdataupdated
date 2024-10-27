<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tactical extends Model
{
    
    use HasFactory;

    protected $table = 'tactical';
   
    protected $fillable = [
        'player_id',
        'vision',
        'positioning',
        'ability_to_loose_marker',
        'counter_attack',
        'unpredictability',
        'read_the_game',
        'space_creation',
        'tactical_awareness',
        'support_play',
        'creativity',
        'defensive_ability',
        'receive_ball_under_pressure',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}