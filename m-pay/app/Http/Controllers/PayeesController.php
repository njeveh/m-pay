<?php

namespace App\Http\Controllers;

use App\Models\Payee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PayeesController extends Controller
{
    /**
     * Display the payees Dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function listPayees()
    {
        $payees = Payee::all();
        return view('pages/payees', ['payees' => $payees]);
    }
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
     * @return \Illuminate\View\View
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

    /**
     * Handle an incoming update payee request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $payee = Payee::find($request->input('id'));
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:60',
            'phone' => [
                'required',
                Rule::unique('payees')->ignore($payee->id),
                'min:10',
                'max:13',
                'regex:/254\d{9,10}/'
            ],
        ]);
        $payee->update($validatedData);
        return redirect('/payees');
    }

    /**
     * Handle an incoming delete payee request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     * @return \Illuminate\View\View
     */
    public function delete(Request $request)
    {

        Payee::destroy($request->input('id'));
        return redirect('/payees');
    }

    /**
     * Display the update payee page.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     * @return \Illuminate\View\View
     */
    public function showUpdateForm(Request $request)
    {
        $payee = Payee::find($request->input('id'));
        return view('pages/update-payee', ['payee' => $payee]);
    }
}
