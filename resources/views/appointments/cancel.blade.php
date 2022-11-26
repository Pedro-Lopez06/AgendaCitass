@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Cancelar Cita</h3>
                    </div>

                    <div class="col text-right">
                        <a href="{{ url('/miscitas') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-chevron-left"></i>
                            Regresar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}!
                </div>
                @endif

                <p>Se cancelara tu cita reservada con el medico <b>{{ $appointment->doctor->name }}</b>
                    (especialidad) <b>{{ $appointment->specialty->name }}</b>
                    para el dia <b>{{ $appointment->scheduled_date }}</b> </p>

                    <form action="{{ url('/miscitas/'.$appointment->id.'/cancel') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="justification">Ponga los motivos de la cancelacion</label>
                            <textarea name="justification" id="justification" rows="3" class="form-control" required></textarea>
                        </div>

                        <button class="btn btn-danger" type="submit">Cancelar Cita</button>
                    </form>

        </div>

@endsection
