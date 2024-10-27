<?php

namespace App\Exports;

use App\Models\Player;
use App\Models\Physical;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlayerPhysicalExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of physical ratings.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch all physical records
        return Player::with('physical') // Assuming 'player' is the relationship defined in the Physical model
            ->get()
            ->map(function ($player) {
                // Format the data to include player details and physical ratings
           
                return [
                    'Player ID' => $player->id,
                    'Player Name' => $player->name ?? 'N/A', // Assuming player relationship exists
                    'Aggression' => $player->physical->aggression ?? 'N/A',
                    'Strength' => $player->physical->strength ?? 'N/A',
                    'Explosiveness' => $player->physical->explosiveness ?? 'N/A',
                    'Power' => $player->physical->power ?? 'N/A',
                    'Change of Pace' => $player->physical->change_of_pace ?? 'N/A',
                    'Ball Protection' => $player->physical->ball_protection ?? 'N/A',
                    'Jumping' => $player->physical->jumping ?? 'N/A',
                    'Stamina' => $player->physical->stamina ?? 'N/A',
                    'Aerobic Capacity' => $player->physical->aerobic_capacity ?? 'N/A',
                    'Speed' => $player->physical->speed ?? 'N/A',
                    'Agility' => $player->physical->agility ?? 'N/A',
                    'Balance' => $player->physical->balance ?? 'N/A',
                    'Acceleration' => $player->physical->acceleration ?? 'N/A',
                    'Repeated Sprint Ability' => $player->physical->repeated_sprint_ability ?? 'N/A',
                ];
            });
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Player ID',
            'Player Name',
            'Aggression',
            'Strength',
            'Explosiveness',
            'Power',
            'Change of Pace',
            'Ball Protection',
            'Jumping',
            'Stamina',
            'Aerobic Capacity',
            'Speed',
            'Agility',
            'Balance',
            'Acceleration',
            'Repeated Sprint Ability',
        ];
    }
}
