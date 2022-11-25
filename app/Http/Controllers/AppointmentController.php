<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Speciality;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(){
        $specialties = Speciality::all();

        $specialtyId = old('specialty_id');
        if($specialtyId){
            $specialty = Speciality::find($specialtyId);
            $doctors = $specialty->users;
        } else{
            $doctors = collect();
        }

        return view('appointments.create', compact('specialties', 'doctors'));
    }

    public function store(Request $request){

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialities,id'

        ];

        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora válida para su cita',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Debe poner sus sintomas.'
        ];
        $this->validate($request, $rules, $messages);

        $data = $request->only([
            'scheduled_date',
            'scheduled_time',
            'type',
            'description',
            'doctor_id',
            'specialty_id'
        ]);
        $data['patient_id'] = auth()->id();

        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        Appointment::create($data);

        $notification = 'La cita se ha realizado correctamente';
        return back()->with(compact('notification'));
    }
}
