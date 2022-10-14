<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\States\State;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    protected array $states;
    public function __construct()
    {
        $this->states = State::all()->toArray();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function generate_data(Request $request)
    {
        $users_data = collect();

        $users = (new UsersDashboard(
            $request->start_date,
            $request->end_date,
            $request->state_id
        ));
        if ($request->type === 'filter') {
            $request->validate([
                'state_id' => 'required'
            ]);
            $users_data = $users->filter_users();
        } else {
            $request->validate([
                'term' => 'required'
            ]);
            $users_data = $users->searchUser($request->term);
        }
        return view('users.index', [
            'users' => $users_data,
            'current_date' => date('Y-m-d'),
            'states' => $this->states
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request, User $users)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ],  [
            'name.require' => 'El campo nombre es obligatorio*',
            'email.require' => 'El campo email es obligatorio*'
        ]);

        $user = $users->where('email', '=', $request->email);
        if ($user->get()->isNotEmpty()) {
            $user->update($request->except(['_token']));
            return back()->with('message', "actualizado  $request->name con éxito");
        } else {
            return back()->with('message', "Error al intentar actualizar el usuario $request->email");
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function changeUserState(Request $request,  User $users)
    {
        $user = $users->where('id', '=', $request->id)->first();
        if (!is_null($user)) {
            $state_id = $user->state_id == 1 ? 3 : 1;
            $user->state_id = $state_id;
            $user->save();
            return back()->with('message', "Se cambió el estado del usuario");
        } else {
            return back()->with('message', "No existe el usuario buscado $request->email");
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_date = date('Y-m-d');
        return view('users.index', [
            'current_date' => $current_date,
            'states' => $this->states
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
