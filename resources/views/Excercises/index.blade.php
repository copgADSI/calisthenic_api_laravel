@extends('layouts.app')
@extends('layouts.sidebar.index')
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Listado de Ejercicios') }}</div>
                    <a href="{{ route('excercises.create') }}" id="btn_primary" class="btn btn-primary">Crear
                        Ejecicio</a>
                    @if(isset($message))
                    <span> {{ $message }} </span>
                    @endif

                    @if (count($excercises) > 0)
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre Ejecicio</th>
                                    <th scope="col">Descripción</th>
                                    <th class="text-center" scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($excercises as $excercise)
                                <tr>
                                    <td> {{ $excercise['name'] }} </td>
                                    <td> {{ $excercise['description'] }} </td>
                                    <td class="text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal_id_{{$excercise['id']}}">
                                            Ver Demo
                                        </button>
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modal_update_{{$excercise['id']}}">Modificar</button>
                                        <a href="{{ route('excercises.destroy', ['id' => $excercise['id'], 'user_id' => Auth::User()->id   ] ) }}"
                                            class="btn btn-danger">Eliminar</button>
                                    </td>
                                    <!-- Modal video demo -->
                                    <div class="modal fade" id="modal_id_{{$excercise['id']}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">{{
                                                        $excercise['name']
                                                        }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body" style="justify-content: center; display: flex;" >
                                                    <img src="{{$excercise['gif'] }}" alt="" width="300" height="300"><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" id="btn_primary">Cerrar</button>
                                                    {{-- <button type="button" class="btn btn-primary">Save
                                                        changes</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal update data -->
                                    <div class="modal fade" id="modal_update_{{$excercise['id']}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form
                                                    action="{{route('excercises.update', ['id' => $excercise['id'] ] )}}"
                                                    method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel2">Formulario de
                                                            Edición</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{$excercise['name'] }}">
                                                        <textarea name="description" id="" cols="30" rows="10"
                                                            class="form-control">
                                                        {{ $excercise['description'] }}
                                                    </textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" id="btn_primary">Cerrar</button>
                                                        <button type="submit"
                                                            class="btn btn-success">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>



@endsection