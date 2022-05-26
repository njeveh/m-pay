<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayeesController extends Controller
{
    /**
     * Display the payees Dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('pages/payees');
    }
}
