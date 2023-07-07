<?php

namespace App\Http\Controllers\Dashboard;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('dashboard.dashboard');
    }
}
