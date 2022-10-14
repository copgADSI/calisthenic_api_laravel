<?php

namespace App\Console\Commands\users;

use App\Http\Controllers\Users\UsersDashboard;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InactivateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:InactivateUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando usado para buscar usuarios de la BD que lleven 3 días 
                             sin iniciar sesión y les cambie el estado a inactivos ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(User $user)
    {

        $users_data = (new UsersDashboard())
            ->getUsersNotLoggedThreeDays();
        if ($users_data->isNotEmpty() && $users_data->count() > 0) {
            Log::info('__Proceso de actualización iniciado__');
            foreach ($users_data->toArray() as $current_user) {
                $user->where('id', '=', $current_user->id)
                    ->update(['state_id' => 2]); //Inactivo
                Log::info("Se actualizó usuario con email: {$current_user->email} ");
            }
            Log::info("__Proceso finalizado. Se encontraron {$users_data->count()} usuarios__");
        } else {
            Log::info('__Proceso finalizado. No se encontraron usuarios inactivos de hace 3 días__');
        }
    }
}
