<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function doctors(Speciality $specialty){
        return $specialty->users()->get([
            'users.id',
            'users.name'
        ]);
    }
}
