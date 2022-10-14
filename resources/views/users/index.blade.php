@extends('layouts.app')
@extends('layouts.sidebar.index')
@section('content')
<section>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Listado de Usuarios') }}</div>
                    {{-- <a href="{{ route('users.create') }}" id="btn_primary" class="btn btn-primary">Crear
                        Ejecicio</a> --}}
                    <form action="{{ route('users.generate_data')}} " method="get">
                        <div class="form-group" style="display: flex">
                            <input type="hidden" class="form-control" name="type" value="filter">
                            <input type="date" class="form-control" name="start_date" value="{{ $current_date  }}">
                            <input type="date" class="form-control" name="end_date" value="{{ $current_date  }}">
                            <select name="state_id" id="state" class="form-control">
                                <option value="">Seleccionar Estado</option>
                                @foreach ($states as $state)
                                <option value=" {{ $state['id'] }} "> {{ $state['state'] }} </option>
                                @endforeach
                                <option value="ALL">Todos</option>
                            </select>
                            <button type="submit" class="btn btn-primary" id="btn_primary">Consultar</button>
                        </div>
                    </form>
                    <form action="{{ route('users.generate_data') }}" method="get">
                        <div class="form-group" style="display: flex">
                            <input type="hidden" class="form-control" name="type" value="search">
                            <input type="text" placeholder="Buscar usuario" class="form-control" name="term">
                            <button type="submit" class="btn btn-secondary" id="btn_primary">Buscar</button>
                        </div>
                    </form>
                    @if(isset($message))
                    <span> {{ $message }} </span>
                    @endif
                    @if(isset($users) && !is_null($users) & count($users) > 0)
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left" scope="col">Nombre </th>
                                    <th class="text-left" scope="col">Email</th>
                                    <th class="text-left" scope="col">Fecha Registro</th>
                                    <th class="text-left" scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-left"> {{ $user->name }} </td>
                                    <td class="text-left"> {{ $user->email }} </td>
                                    <td class="text-left"> {{ $user->created_at }} </td>
                                    <td class="text-left">
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modal_update_{{$user->id}}">Modificar</button>
                                        <a href="{{ route('users.stateChange', ['id' => $user->id   ] ) }}"
                                            class="btn btn-dark"> {{ $user->state_id === 1 ? 'Deshabilitar' : 'Activar'
                                            }} </a>

                                        <a href="{{ route('users.destroy', ['id' => $user->id   ] ) }}"
                                            class="btn btn-danger">Eliminar</a>
                                    </td>

                                    <!-- Modal update data -->
                                    <div class="modal fade" id="modal_update_{{$user->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post" action="{{route('users.update_data')}}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel2">Formulario de
                                                            Edición</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{$user->email }}" placeholder="Ingresar email*">
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{$user->name }}" placeholder="Ingresar nombre*">

                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{$user->phone }}" placeholder="Ingresar teléfono">
                                                        <div class="form-group" style="display: flex">
                                                            <input type="password" name="password" class="form-control"
                                                                disabled value="{{$user->password }}">
                                                            <button class="btn btn-primary"
                                                                id="btn_primary">Generar</button>
                                                        </div>
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
                    @else
                    <span>No se encontraron registros </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>



@endsection