<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $players = Player::all();

        return view('welcome', compact('players'));
    }

    public function player($id)
    {
        $player = Player::with(['club', 'technical', 'tactical', 'physical', 'mental'])->findOrFail($id);
        
        // Fetch teammates in the same club, excluding the current player
        $teammates = Player::where('club_id', $player->club_id)
                            ->where('id', '!=', $player->id)
                            ->get();
    
        // Prepare chart data for Technical skills
        $technicalData = [
            'labels' => ['Technique', 'Dribbling', 'Using Both Feet', 'Ball Control', 'Long Shots', 
                         'Pass Forward', 'Pass Sideways', 'Pass Backwards', 'Crossing', 
                         'Long Throws', 'Heading', 'Finishing', 'Play Under Pressure'],
            'data' => [
                $player->technical->technique,
                $player->technical->dribbling,
                $player->technical->using_both_feet,
                $player->technical->ball_control,
                $player->technical->long_shots,
                $player->technical->pass_forward,
                $player->technical->pass_sideways,
                $player->technical->pass_backwards,
                $player->technical->crossing,
                $player->technical->long_throws,
                $player->technical->heading,
                $player->technical->finishing,
                $player->technical->play_under_pressure,
            ]
        ];
    
        // Prepare chart data for Tactical skills
        $tacticalData = [
            'labels' => ['Vision', 'Positioning', 'Ability to Lose Marker', 'Counter Attack', 
                         'Unpredictability', 'Read the Game', 'Space Creation', 
                         'Tactical Awareness', 'Support Play', 'Creativity', 
                         'Defensive Ability', 'Receive Ball Under Pressure'],
            'data' => [
                $player->tactical->vision,
                $player->tactical->positioning,
                $player->tactical->ability_to_loose_marker,
                $player->tactical->counter_attack,
                $player->tactical->unpredictability,
                $player->tactical->read_the_game,
                $player->tactical->space_creation,
                $player->tactical->tactical_awareness,
                $player->tactical->support_play,
                $player->tactical->creativity,
                $player->tactical->defensive_ability,
                $player->tactical->receive_ball_under_pressure,
            ]
        ];
    
        // Prepare chart data for Physical skills
        $physicalData = [
            'labels' => ['Aggression', 'Strength', 'Explosiveness', 'Power', 'Change of Pace', 
                         'Ball Protection', 'Jumping', 'Stamina', 'Aerobic Capacity', 
                         'Speed', 'Agility', 'Balance', 'Acceleration', 'Repeated Sprint Ability'],
            'data' => [
                $player->physical->aggression,
                $player->physical->strength,
                $player->physical->explosiveness,
                $player->physical->power,
                $player->physical->change_of_pace,
                $player->physical->ball_protection,
                $player->physical->jumping,
                $player->physical->stamina,
                $player->physical->aerobic_capacity,
                $player->physical->speed,
                $player->physical->agility,
                $player->physical->balance,
                $player->physical->acceleration,
                $player->physical->repeated_sprint_ability,
            ]
        ];


        $mentalData = [
            'labels' => [
                'Leadership',
                'Temperament',
                'Error Handling',
                'Determination',
                'Team Work',
                'Decision Making',
                'Concentration',
                'Charisma'
            ],
            'data' => [
                $player->mental->leadership,
                $player->mental->temperament,
                $player->mental->error_handling,
                $player->mental->determination,
                $player->mental->team_work,
                $player->mental->decision_making,
                $player->mental->concentration,
                $player->mental->charisma,
            ]
        ];
    


       

       
        // You can also prepare mental data here...
    
        return view('player', compact('player', 'teammates', 'technicalData', 'tacticalData', 'physicalData', 'mentalData'));
    }
    
    
    
}
