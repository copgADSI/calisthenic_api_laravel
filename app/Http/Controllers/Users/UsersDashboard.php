<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\States\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsersDashboard extends Controller
{
    protected string $start_date, $end_date;
    protected string | int | array $state;


    public function __construct(string $start_date = null, string $end_date = null, string $state = null)
    {
        if (is_null($start_date) && is_null($end_date)) {
            $this->start_date = now()->toDateString();
            $this->end_date = now()->toDateString();
        } else {
            $this->start_date = $start_date;
            $this->end_date = $end_date;
        }

        if (!is_null($state) && $state === 'ALL') {
            $this->state = State::all()->pluck('id')->values()->toArray();
        } else {
            $this->state = [$state];
        }
    }

    public function filter_users(): Collection
    {
        return DB::table('users')
            ->whereBetween('created_at', [
                $this->start_date, $this->end_date
            ])
            ->whereIn('state_id', $this->state)->get();
    }

    public function searchUser(string $term): Collection
    {
        return DB::table('users')
            ->where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('email', 'LIKE', '%' . $term . '%')
            ->get();
    }

    public function getUsersNotLoggedThreeDays(): Collection
    {
        $d = DB::table('users')
            ->whereDate('last_login', '<=', Carbon::now()->subDays(3)->format('Y-m-d'))
            ->where('state_id', '<>', 2);
        return $d->get();
    }
}
