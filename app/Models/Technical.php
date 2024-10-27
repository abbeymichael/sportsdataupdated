<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technical extends Model
{
    use HasFactory;
    protected $table = 'technical';
    protected $fillable = [
        'player_id',
        'technique',
        'dribbling',
        'using_both_feet',
        'ball_control',
        'long_shots',
        'pass_forward',
        'pass_sideways',
        'pass_backwards',
        'crossing',
        'long_throws',
        'heading',
        'finishing',
        'play_under_pressure',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
