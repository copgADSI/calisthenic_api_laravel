@extends('layouts.app')
@extends('layouts.sidebar.index')
@section('content')
<div class="container m-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inicio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Has iniciado sesión!') }}
                    <br>
                    {{ __('Sistema para administrar la API') }}
                </div>

            </div>
        </div>
        <div class="col-md-10 m-2">
            <div class="card">
                <div class="card-header">{{ __('EndPoint Ejecicios ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Has iniciado sesión!') }}
                    <br>
                    {{ __('Sistema para administrar la API') }}
                </div>

            </div>
        </div>

        <div class="col-md-10 m-2">
            <div class="card">
                <div class="card-header">{{ __('EndPoint Rutinas ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Has iniciado sesión!') }}
                    <br>
                    {{ __('Sistema para administrar la API') }}
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    const url = location.href; // blog.alejandrmolero.com
    console.log(url);
</script>
@endsection