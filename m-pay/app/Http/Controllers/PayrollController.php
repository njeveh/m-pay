<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display the payroll page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('pages/payroll');
    }
}
