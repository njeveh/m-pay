<?php

namespace App\Http\Controllers;

use App\Models\Payee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddPayeeController extends Controller
{
    /**
     * Display the add payee page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('pages/add-payee');
    }

    /**
     * Handle an incoming add payee request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:60',
            'phone' => 'required|unique:payees,phone|min:10|max:13|regex:/254\d{9,10}/',
        ]);
        $payee = Payee::create($validatedData);
        return view('pages/add-payee', ['payee' => $payee]);
    }
}
