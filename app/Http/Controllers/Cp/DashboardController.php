<?php

namespace App\Http\Controllers\Cp;

use App\Dashboard;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Dashboard $dashboard)
    {
        return view('cp.index', [
        	'count' => $dashboard->getCountData()
        ]);
    }
}
