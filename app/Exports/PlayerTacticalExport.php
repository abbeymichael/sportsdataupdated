<?php

namespace App\Exports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayerTacticalExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch players with their related tactical skills
        return Player::with('tactical')
            ->get()
            ->map(function ($player) {
                // Format the data to include player ID, name, and tactical skills
                return [
                    'Player ID' => $player->id,
                    'Player Name' => $player->name,
                    'Vision' => $player->tactical->vision ?? 0,
                    'Positioning' => $player->tactical->positioning ?? 0,
                    'Ability to Lose Marker' => $player->tactical->ability_to_loose_marker ?? 0,
                    'Counter Attack' => $player->tactical->counter_attack ?? 0,
                    'Unpredictability' => $player->tactical->unpredictability ?? 0,
                    'Read the Game' => $player->tactical->read_the_game ?? 0,
                    'Space Creation' => $player->tactical->space_creation ?? 0,
                    'Tactical Awareness' => $player->tactical->tactical_awareness ?? 0,
                    'Support Play' => $player->tactical->support_play ?? 0,
                    'Creativity' => $player->tactical->creativity ?? 0,
                    'Defensive Ability' => $player->tactical->defensive_ability ?? 0,
                    'Receive Ball Under Pressure' => $player->tactical->receive_ball_under_pressure ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Player ID', 
            'Player Name', 
            'Vision', 
            'Positioning', 
            'Ability to Lose Marker', 
            'Counter Attack', 
            'Unpredictability', 
            'Read the Game', 
            'Space Creation', 
            'Tactical Awareness', 
            'Support Play', 
            'Creativity', 
            'Defensive Ability', 
            'Receive Ball Under Pressure'
        ];
    }
}
