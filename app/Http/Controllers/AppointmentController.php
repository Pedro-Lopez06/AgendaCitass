<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(){
        $specialties = Speciality::all();
        return view('appointments.create', compact('specialties'));
    }
}
