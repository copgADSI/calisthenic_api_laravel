@extends('layouts.app')
@extends('layouts.sidebar.index')
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Crear Ejecicio') }}</div>
                    <a href="{{ route('excercises.list') }}" id="btn_primary" class="btn btn-primary">Volver al
                        Listado</a>
                    {{ $errors }}
                    <div class="card-body">

                        <form action="{{route('excercises.store')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            <input type="text" name="name" placeholder="Ingrese nombre ejecicio*" class="form-control">
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                placeholder="Ingrese descripción ejecicio*"></textarea>
                            <select name="muscle_groups_id" id="muscle_groups_id" class="form-control">
                                <option value="">Seleccionar grupo muscular</option>
                                @foreach ($muscleGroups as $muscleGroup)
                                    <option value="{{ $muscleGroup['id'] }}" > {{$muscleGroup['muscle']}} </option>
                                @endforeach
                            </select>
                            <input type="file" name="gif" id="" class="form-control">
                            <button class="btn btn-success form-control" type="submit">Crear</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection