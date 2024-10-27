<?php

namespace App\Exports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlayersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Player::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Club ID',
            'Name',
            'Date of Birth',
            'Height',
            'Weight',
            'Position',
            'Preferred Foot',
        ];
    }
}