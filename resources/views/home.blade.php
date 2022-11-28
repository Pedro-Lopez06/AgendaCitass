@extends('layouts.panel')

@section('content')
    <div class="row">

        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Citas Médicas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __(' Bienvenido!') }}
                </div>
            </div>
        </div>
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    La <strong>Salud</strong> es primero.
                </div>
                <div class="card-body ">
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <p>El ejercicio es clave para salud física y de la mente.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            político <cite title="Source Title">Nelson Mandela</cite>
                        </figcaption>
                    </figure>
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <p>Nuestros cuerpos son nuestros jardines; nuestras decisiones, nuestros jardineros.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            escritor <cite title="Source Title">William Shakespeare</cite>
                        </figcaption>
                    </figure>
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <p>Tu cuerpo es templo de la naturaleza y del espíritu divino. Consérvalo sano, respétalo,
                                estúdialo y concédele sus derechos.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            filósofo <cite title="Source Title">Henri Frédéric Amiel</cite>
                        </figcaption>
                    </figure>
                </div>
                
            </div>
        </div>
    </div>
    </div>
@endsection
