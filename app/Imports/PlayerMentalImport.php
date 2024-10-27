<?php

namespace App\Imports;

use App\Models\Player;
use App\Models\Mental; // Import the Mental model
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlayerMentalImport implements ToModel, WithHeadingRow
{
    /**
     * Define the model to be imported.
     *
     * @param array $row
     * @return Mental|null
     */
    public function model(array $row)
    {
        // Check if the player exists
        $playerExists = Player::where('id', $row['player_id'])->exists();

        // If the player doesn't exist, skip this row
        if (!$playerExists) {
            return null; // Skip this row
        }

        // Proceed to update or create mental data for existing players
        return Mental::updateOrCreate(
            ['player_id' => $row['player_id']], // Match based on player_id
            [ // Update the mental fields based on Excel input
                'leadership' => $row['leadership'] ?? 0, // Use null coalescing for safety
                'temperament' => $row['temperament'] ?? 0,
                'error_handling' => $row['error_handling'] ?? 0,
                'determination' => $row['determination'] ?? 0,
                'team_work' => $row['team_work'] ?? 0,
                'decision_making' => $row['decision_making'] ?? 0,
                'concentration' => $row['concentration'] ?? 0,
                'charisma' => $row['charisma'] ?? 0,
            ]
        );
    }
}