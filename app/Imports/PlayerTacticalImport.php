<?php

namespace App\Imports;

use App\Models\Player;
use App\Models\Tactical; // Import the Tactical model
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlayerTacticalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if the player exists
        $playerExists = Player::where('id', $row['player_id'])->exists();

        // If the player doesn't exist, skip this row
        if (!$playerExists) {
            return null; // Skip this row
        }


        // Proceed to update or create tactical data for existing players
        return Tactical::updateOrCreate(
            ['player_id' => $row['player_id']], // Match based on player_id

            [ // Update the tactical fields based on Excel input
                'vision' => $row['vision'] ?? 0, // Use null coalescing for safety
                'positioning' => $row['positioning'] ?? 0,
                'ability_to_loose_marker' => $row['ability_to_lose_marker'] ?? 0,
                'counter_attack' => $row['counter_attack'] ?? 0,
                'unpredictability' => $row['unpredictability'] ?? 0,
                'read_the_game' => $row['read_the_game'] ?? 0,
                'space_creation' => $row['space_creation'] ?? 0,
                'tactical_awareness' => $row['tactical_awareness'] ?? 0,
                'support_play' => $row['support_play'] ?? 0,
                'creativity' => $row['creativity'] ?? 0,
                'defensive_ability' => $row['defensive_ability'] ?? 0,
                'receive_ball_under_pressure' => $row['receive_ball_under_pressure'] ?? 0,
            ]
        );
    }
}
