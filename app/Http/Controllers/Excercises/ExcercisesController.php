<?php

namespace App\Http\Controllers\Excercises;

use App\Http\Controllers\Controller;
use App\Models\Excercises\Excercises;
use App\Models\MuscleGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ExcercisesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function getAllExcercises(Excercises $excercises, MuscleGroup $muscleGroup)
    {
        $muscles_groups = $muscleGroup->all();
        $excercises = $excercises->paginate(10);
        return response()->json([
            'results' => $excercises->toArray(),
            'muscles_groups' =>  $muscles_groups->toArray()
        ], 200);
    }

    private function getExcercises(): array
    {
        $excercises = collect();
        $user = Auth::user();
        if ($user->role_id === 1) {
            $excercises = Excercises::all();
        } else {
            $excercises = Excercises::where('user_id', '=',  $user->role_id)->get();
        }
        return $excercises->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Excercises.index', [
            'excercises' => $this->getExcercises(),
        ]);
    }

    /**
     * Mostra vista para crear ejercicio
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $musclesGroups = MuscleGroup::all();
        return view('Excercises.create', [
            'muscleGroups'  =>  $musclesGroups->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Excercises $excercises)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required|min:10',
            'gif' => 'required',
            'muscle_groups_id' => 'required'
        ]);
        DB::transaction(function () use ($request, $excercises) {

            $excercises_data = $excercises->where('name', '=',  $request->name)->get();
            if (!$excercises_data->isEmpty()) {
                return response()->json(['error, ejecicio ya existe' => $request->all()], 200);
            }

            $path_name = str_replace(' ', '_',  $request->name);
            /** Proceso para guardar gif en disco s3 */
            $full_path = Storage::disk('s3')->put($path_name, $request->file('gif'), 'public');
            /** Url de acceso a imgs y valor para la prop images de BD*/
            $full_url = Storage::disk('s3')->url($full_path);

            $excercise_data =  $request->all();
            $excercise_data['gif'] = $full_url;
            $excercises::create($excercise_data);

            return view('Excercises.index', [
                'excercises' => $this->getExcercises()
            ]);
        });
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Excercises $excercises)
    {
        $excercise  = $excercises->where('id', '=', $request->id);
        if (!$excercise->get()->isEmpty()) {
            $excercise->update($request->all());
            return response()->json([
                "Se actualizó correctamente el ejecicio de  {$request->name}",
                "excercise" => $request->all()
            ], 200);
        } else {
            return response()->json('Error, no existe ejecicio para ser actualizado');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function update_excercise(Request $request, Excercises $excercises)
    {
        $excercise  = $excercises->where('id', '=', $request->id);
        if (!$excercise->get()->isEmpty()) {
            $excercise->update($request->all());
            return back()->with('message', 'Registro actualizado');
        } else {
            return back()->with('message', 'Error al momento de actualizar un registro');
        }
    }
    /**
     * Remove the specified resource from storage.
     * 
     * @return \Illuminate\Http\Response
     *  @param  \Illuminate\Http\Request  $request
     *  @param App\Models\Excercises\Excercises;
     */
    public function destroy(Request $request, Excercises $excercises)
    {
        $validated = $request->validate([
            'id' => 'required',
            'user_id' => 'required'
        ]);
        $excercise =  $excercises->where('id', '=', $request->id);
        $excercise_owner = $excercise->where('user_id', '=', $request->user_id);
        if ($excercise_owner->get()->isEmpty()) {
            return response()->json('Error, no puedes eliminar un ejecicio que no te pertenezca');
        }
        if (!$excercise->get()->isEmpty()) {
            //delete excercise
            $excercise->delete();
            return response()->json('Ejercicio eliminado con éxito ', 200);
        }
        return response()->json('No existe ejecicio para ser eliminado', 200);
    }

    public function get_excercises(Excercises $excercises)
    {
        $results = $excercises->all();
        return response()->json(
            [
                'total' => $results->count(),
                'excercises' => $results->toArray(),
            ],
            200
        );
    }
}
