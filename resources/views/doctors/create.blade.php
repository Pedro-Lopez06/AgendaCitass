@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Nuevo Medico</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/medicos') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-chevron-left"></i>
                            Regresar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Por favor!!</strong> {{ $error }}
                </div>
                @endforeach
            @endif

                <form action="{{ url('/medicos') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre del Medico</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cedula</label>
                        <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono / Movil</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Crear Medico</button>
                </form>
            </div>
        </div>

@endsection
