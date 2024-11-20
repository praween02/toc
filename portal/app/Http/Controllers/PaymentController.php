<?php

namespace App\Http\Controllers;

use App\Models\{Payment};
use Illuminate\Http\Request;
use App\DataTables\PaymentsDataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaymentsDataTable $dataTable)
    {
        //abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        return $dataTable->render('pages.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        return view('pages.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate([
                                'utr_no' => 'required||max:128|unique:payments',
                                'transaction_date' => 'required',
                                'amount' => 'required|integer',
                          ]);
        try {
            Payment::create(['user_id' => current_user_id(), 'utr_no' => $request->utr_no, 'transaction_date' => $request->transaction_date, 'amount' => $request->amount]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }
        return redirect()->route('payments.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        return view('pages.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
        //abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate([
                                'utr_no' => 'required|unique:payments,utr_no,' . $payment->id . '|max:255',
                                'transaction_date' => 'required',
                                'amount' => 'required|integer'
                          ]);
        try {
            $payment->update(['utr_no' => $request->utr_no, 'transaction_date' => $request->transaction_date, 'amount' => $request->amount]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('payments.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $payment)
    {
        //
        abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
    }

}
