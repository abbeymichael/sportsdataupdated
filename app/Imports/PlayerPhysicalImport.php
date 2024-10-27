<?php

namespace App\Imports;

use App\Models\Player;
use App\Models\Physical; // Import the Physical model
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlayerPhysicalImport implements ToModel, WithHeadingRow
{
    /**
     * Define the model to be imported.
     *
     * @param array $row
     * @return Physical|null
     */
    public function model(array $row)
    {
        // Check if the player exists
        $playerExists = Player::where('id', $row['player_id'])->exists();

        // If the player doesn't exist, skip this row
        if (!$playerExists) {
            return null; // Skip this row
        }

        // Proceed to update or create physical data for existing players
        return Physical::updateOrCreate(
            ['player_id' => $row['player_id']], // Match based on player_id
            [ // Update the physical fields based on Excel input
                'aggression' => $row['aggression'] ?? 0, // Use null coalescing for safety
                'strength' => $row['strength'] ?? 0,
                'explosiveness' => $row['explosiveness'] ?? 0,
                'power' => $row['power'] ?? 0,
                'change_of_pace' => $row['change_of_pace'] ?? 0,
                'ball_protection' => $row['ball_protection'] ?? 0,
                'jumping' => $row['jumping'] ?? 0,
                'stamina' => $row['stamina'] ?? 0,
                'aerobic_capacity' => $row['aerobic_capacity'] ?? 0,
                'speed' => $row['speed'] ?? 0,
                'agility' => $row['agility'] ?? 0,
                'balance' => $row['balance'] ?? 0,
                'acceleration' => $row['acceleration'] ?? 0,
                'repeated_sprint_ability' => $row['repeated_sprint_ability'] ?? 0,
            ]
        );
    }
}
