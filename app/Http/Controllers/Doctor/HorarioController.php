<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horarios;

class HorarioController extends Controller
{
    public function edit(){
        $days =[
            'Lunes', 'Martes', 'Miércoles', 'Jueves',
            'Viernes', 'Sabado', 'Domingo'

        ];
        return view('horario', compact('days'));
    }
    public function store(Request $request){
        $active = $request ->input('active') ?:[];
        $morning_start = $request -> input('morning_start');
        $morning_end = $request -> input('morning_end');
        $afternoon_start = $request -> input('afternoon_start');
        $afternoon_end = $request -> input('afternoon_end');

        for($i=0; $i<7; ++$i)
            Horarios::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->id()
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $morning_start[$i],
                    'morning_end'=> $morning_end[$i],
                    'afternoon_start'=> $afternoon_start[$i],
                    'afternoon_end'=> $afternoon_end[$i],
                ]
            );
            return back();
    }
}
