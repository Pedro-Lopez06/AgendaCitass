<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Speciality;

use function Ramsey\Uuid\v1;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(3);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = Speciality::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre del medico es obligatorio',
            'name.min' => 'El nombre del medico debe tener mas de 3 caracters',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Ingresa un correo valido',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.digits' => 'La cedula tiene que tener minimo 10 digitos',
            'address.min' => 'La direccion debe tener al menos 6 caracteres',
            'phone.required' => 'El numero del telefono es obligatorio',
        ];
        $this->validate($request, $rules, $messages);

        $user = User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role' => 'doctor' ,
                'password' => bcrypt($request->input('password'))
            ]
        );
        $user -> specialties()->attach($request->input('specialties'));

        $notification = "El medico se a registrado correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Speciality::all();
        $specialty_ids = $doctor->specialties()->pluck('specialities.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre del medico es obligatorio',
            'name.min' => 'El nombre del medico debe tener mas de 3 caracters',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Ingresa un correo valido',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.digits' => 'La cedula tiene que tener minimo 10 digitos',
            'address.min' => 'La direccion debe tener al menos 6 caracteres',
            'phone.required' => 'El numero del telefono es obligatorio',
        ];
        $this->validate($request, $rules, $messages);
        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name','email','cedula','address','phone');
        $password = $request->input('password');

        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
        $user->specialties()->sync($request->input('specialties'));

        $notification = "La informacion de medico se a actualizado correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::doctors()->findOrFail($id);
        $doctorName = $user->name;
        $user -> delete();

        $notification = "El medico $doctorName se elimino correctamente";

        return redirect('/medicos')->with(compact('notification'));
    }
}
