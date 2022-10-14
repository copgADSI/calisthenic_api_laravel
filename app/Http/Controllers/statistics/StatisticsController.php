<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $statisticsDashboard = (new StatisticsDashboard());
        $users = $statisticsDashboard->getUsersTotal();
        $labels = $users->keys();
        $data = $users->values();

        $excercises = $statisticsDashboard->getExercisesTotal();
        $excercises_labels = $excercises->keys();
        $excercises_data = $excercises->values();
        
        return view('Stats.index', compact('data', 'labels'));
    }
}
