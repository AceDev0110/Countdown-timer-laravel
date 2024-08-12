<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Example dynamic value for 'signin'
        $data = ['signin' => '0'];

        return view('dashboard', $data);
    }
}
