<?php

namespace App\Exports;

use App\Models\Player;
use App\Models\Mental;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlayerMentalExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of mental ratings.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch all mental records
        return Player::with('mental') // Assuming 'mental' is the relationship defined in the Player model
            ->get()
            ->map(function ($player) {
                // Format the data to include player details and mental ratings
                return [
                    'Player ID' => $player->id,
                    'Player Name' => $player->name ?? 'N/A',
                    'Leadership' => $player->mental->leadership ?? 'N/A',
                    'Temperament' => $player->mental->temperament ?? 'N/A',
                    'Error Handling' => $player->mental->error_handling ?? 'N/A',
                    'Determination' => $player->mental->determination ?? 'N/A',
                    'Team Work' => $player->mental->team_work ?? 'N/A',
                    'Decision Making' => $player->mental->decision_making ?? 'N/A',
                    'Concentration' => $player->mental->concentration ?? 'N/A',
                    'Charisma' => $player->mental->charisma ?? 'N/A',
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
            'Leadership',
            'Temperament',
            'Error Handling',
            'Determination',
            'Team Work',
            'Decision Making',
            'Concentration',
            'Charisma',
        ];
    }
}