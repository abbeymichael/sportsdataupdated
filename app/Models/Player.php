<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'height',
        'weight',
        'position',
        'preferred_foot',
        'club_id',
        'image',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function tactical()
    {
        return $this->hasOne(Tactical::class);
    }

    public function technical()
    {
        return $this->hasOne(Technical::class);
    }

    public function physical()
    {
        return $this->hasOne(Physical::class);
    }

    public function mental()
    {
        return $this->hasOne(Mental::class);
    }
}