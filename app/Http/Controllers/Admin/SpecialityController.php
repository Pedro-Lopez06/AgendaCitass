<?php

namespace App\Http\Controllers\Admin;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;

class SpecialityController extends Controller
{
    public function index(){
        $specialities = Speciality::all();
        return view('specialities.index', compact('specialities'));
    }

    public function create(){
        return view('specialities.create');
    }

    public function sendData(Request $request){
        $rules = [
            'name'=>'required|min:3'
        ];
        $messages = [
            'name.required'=>'El nombre de la especialidad es obligatorio',
            'name.min'=>'El nombre tiene que tener mas de 3 caracteres'
        ];
        $this->validate($request, $rules, $messages);

        $speciality = new Speciality();
        $speciality->name = $request->input('name');
        $speciality->description = $request->input('description');
        $speciality->save();
        $notification = 'La especialidad se ha Creado Correctamente';

        return redirect('/especialidades')->with(compact('notification'));

    }

    public function edit(Speciality $speciality){
        return view('specialities.edit', compact('speciality'));
    }

    public function update(Request $request, Speciality $speciality){
        $rules = [
            'name'=>'required|min:3'
        ];
        $messages = [
            'name.required'=>'El nombre de la especialidad es obligatorio',
            'name.min'=>'El nombre tiene que tener mas de 3 caracteres'
        ];
        $this->validate($request, $rules, $messages);

        $speciality->name = $request->input('name');
        $speciality->description = $request->input('description');
        $speciality->save();
        $notification = 'La especialidad se a actualizado correctamente';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy(Speciality $speciality){
        $deletName = $speciality->name;
        $notification = 'La especialidad '.$deletName.'se a eliminado correctamente!!';
        $speciality->delete();
        return redirect('/especialidades')->with(compact('notification'));
    }


}
