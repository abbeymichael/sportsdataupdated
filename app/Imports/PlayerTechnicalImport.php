<?php
namespace App\Imports;

use App\Models\Player;
use App\Models\Technical;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlayerTechnicalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if the player exists
        $playerExists = Player::where('id', $row['player_id'])->exists();

        // If the player doesn't exist, skip this row
        if (!$playerExists) {
            return null; // Skip this row
        }

        // Proceed to update or create technical data for existing players
        return Technical::updateOrCreate(
            ['player_id' => $row['player_id']], // Match based on player_id
            [ // Update the technical fields based on Excel input
                'technique' => $row['technique'] ?? 0, // Use null coalescing for safety
                'dribbling' => $row['dribbling'] ?? 0,
                'using_both_feet' => $row['using_both_feet'] ?? 0,
                'ball_control' => $row['ball_control'] ?? 0,
                'long_shots' => $row['long_shots'] ?? 0,
                'pass_forward' => $row['pass_forward'] ?? 0,
                'pass_sideways' => $row['pass_sideways'] ?? 0,
                'pass_backwards' => $row['pass_backwards'] ?? 0,
                'crossing' => $row['crossing'] ?? 0,
                'long_throws' => $row['long_throws'] ?? 0,
                'heading' => $row['heading'] ?? 0,
                'finishing' => $row['finishing'] ?? 0,
                'play_under_pressure' => $row['play_under_pressure'] ?? 0,
            ]
        );
    }
}