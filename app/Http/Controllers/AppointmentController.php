<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Models\Speciality;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

    public function index(){
        $confirmedAppointments = Appointment::all()
            ->where('status', 'Confirmada')
            ->where('patient_id', auth()->id());
        $pendingAppointments = Appointment::all()
            ->where('status', 'Reservada')
            ->where('patient_id', auth()->id());
        $oldAppointments = Appointment::all()
            ->whereIn('status', ['Atendida','Cancelada'])
            ->where('patient_id', auth()->id());
        return view('appointments.index', compact('confirmedAppointments', 'pendingAppointments', 'oldAppointments'));

    }

    public function create(HorarioServiceInterface $horarioServiceInterface){
        $specialties = Speciality::all();

        $specialtyId = old('specialty_id');
        if($specialtyId){
            $specialty = Speciality::find($specialtyId);
            $doctors = $specialty->users;
        } else{
            $doctors = collect();
        }

        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if($date && $doctorId){
            $intervals = $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
        }else{
            $intervals = null;
        }

        return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface){

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialities,id'

        ];

        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora para su cita',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Debe poner sus sintomas.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $horarioServiceInterface) {

            $date = $request->input('scheduled_date');
            $doctorId = $request-> input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');
            if($date && $doctorId && $scheduled_time){
                $start = new Carbon($scheduled_time);
            }else{
                return;
            }

            if (!$horarioServiceInterface->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

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

    public function cancel(Appointment $appointment, Request $request){
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }
        $appointment->status = 'Cancelada';
        $appointment->save();
        $notification = 'La cita se a cancelado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));

    }

    public function formCancel(Appointment $appointment){
        if ($appointment->status == 'Confirmada') {
            return view('appointments.cancel', compact('appointment'));
        }
        return redirect('/miscitas');
    }

    public function show(Appointment $appointment){
        return view('appointments.show', compact('appointment'));
    }
}
