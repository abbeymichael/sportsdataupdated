<?php

namespace App\Exports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayerTechnicalExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch players with their related technical skills
        return Player::with('technical')
            ->get()
            ->map(function ($player) {
                // Format the data to include player ID, name, and technical skills
                return [
                    'Player ID' => $player->id,
                    'Player Name' => $player->name,
                    'Technique' => $player->technical->technique ?? 0,
                    'Dribbling' => $player->technical->dribbling ?? 0,
                    'Using Both Feet' => $player->technical->using_both_feet ?? 0,
                    'Ball Control' => $player->technical->ball_control ?? 0,
                    'Long Shots' => $player->technical->long_shots ?? 0,
                    'Pass Forward' => $player->technical->pass_forward ?? 0,
                    'Pass Sideways' => $player->technical->pass_sideways ?? 0,
                    'Pass Backwards' => $player->technical->pass_backwards ?? 0,
                    'Crossing' => $player->technical->crossing ?? 0,
                    'Long Throws' => $player->technical->long_throws ?? 0,
                    'Heading' => $player->technical->heading ?? 0,
                    'Finishing' => $player->technical->finishing ?? 0,
                    'Play Under Pressure' => $player->technical->play_under_pressure ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Player ID', 
            'Player Name', 
            'Technique', 
            'Dribbling', 
            'Using Both Feet', 
            'Ball Control', 
            'Long Shots', 
            'Pass Forward', 
            'Pass Sideways', 
            'Pass Backwards', 
            'Crossing', 
            'Long Throws', 
            'Heading', 
            'Finishing', 
            'Play Under Pressure'
        ];
    }
}
