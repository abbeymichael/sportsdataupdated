<?php
namespace App\Imports;

namespace App\Imports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnEmptyRow;

class PlayersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if the player already exists by ID
        $player = Player::find($row['id']);

        if ($player) {
            // If the player exists, update the existing record
            $player->update([
                'club_id' => $row['club_id'],
                'name' => $row['name'],
                'dob' => $row['date_of_birth'],
                'height' => $row['height'],
                'weight' => $row['weight'],
                'position' => $row['position'],
                'preferred_foot' => $row['preferred_foot'],
            ]);
            return $player; // Return the updated player instance
        } else {
            // If the player does not exist, create a new record
            return new Player([
                'club_id' => $row['club_id'],
                'name' => $row['name'],
                'dob' => $row['date_of_birth'],
                'height' => $row['height'],
                'weight' => $row['weight'],
                'position' => $row['position'],
                'preferred_foot' => $row['preferred_foot'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'club_id' => 'required|exists:clubs,id',
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'position' => 'required|string|max:50',
            'preferred_foot' => 'required|in:left,right',
        ];
    }

    public function headingRow(): int
    {
        return 1; // The row number of the headings in your Excel file
    }
}
