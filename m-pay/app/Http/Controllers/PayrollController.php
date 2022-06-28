<?php

namespace App\Http\Controllers;

use App\Models\Payee;
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
        $payees = Payee::all();
        return view('pages/create-payroll', ['payees' => $payees]);
    }

    /**
     * Display the payroll page.
     *
     * @return \Illuminate\View\View
     */
    public function showPayroll()
    {
        return view('pages/payroll');
    }

    /**
     * Handle an incoming add to payroll request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     */
    public function addToPayroll(Request $request)
    {
        $id = $request->id;
        $payee = Payee::findOrFail($id);
        $amount = $request->amount;

        $payroll = session()->get('payroll', []);

        if (isset($payroll[$id])) {
            $payroll[$id]['amount']++;
        } else {
            $payroll[$id] = [
                "name" => $payee->name,
                "amount" => $amount,
                "phone" => $payee->phone,
            ];
        }

        session()->put('payroll', $payroll);
        session()->flash('op-feedback', 'Payee added to payroll successfully!');
    }

    /**
     * Handle an incoming update payroll request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     */
    public function update(Request $request)
    {
        if ($request->id && $request->amount) {
            $payroll = session()->get('payroll');
            $payroll[$request->id]["amount"] = $request->amount;
            session()->put('payroll', $payroll);
            session()->flash('op-feedback', 'Payroll updated successfully');
        }
    }

    /**
     * Handle an incoming update payroll request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $payroll = session()->get('payroll');
            if (isset($payroll[$request->id])) {
                unset($payroll[$request->id]);
                session()->put('payroll', $payroll);
            }
            session()->flash('op-feedback', 'Payee removed successfully');
        }
    }

    /**
     * Handle an incoming checkout request.
     *
     * @param  \App\Http\Requests\Auth\Request  $request
     */
    public function checkout(Request $request)
    {

        $payroll = session()->get('payroll', []);

        if (isset($payroll)) {
            foreach ($payroll as $payee) {
                session()->flash('op-feedback', 'Payee added to payroll successfully!' . $payee['amount']);
            }
        } else {
            session()->flash('There is nothing in the payroll to process yet!');
        }
    }
}
