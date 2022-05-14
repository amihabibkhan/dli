<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all transaction list except pending
        $transactions = Transaction::where('status', 1)->orderBy('id', 'desc')->paginate(30);
        return view('admin.transaction.list', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get all transaction list except pending
        $transactions = Transaction::where('status', 0)->paginate(30);
        return view('admin.transaction.pending_list', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        Toastr::success('Transaction Deleted', 'Success');
        return back();
    }

    // accept transaction
    public function acceptTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        // update transaction status
        $transaction->status = 1;
        $transaction->save();

        // find user
        $user = User::find($transaction->user_id);

        // attach courses to user
        foreach ($transaction->courses as $course){
            $user->courses()->syncWithoutDetaching([$course->id]);
        }

        // send sms
        sendSms($transaction->user->phone, "Your Payment has been approved by our office. Now you can start your course.

LEGEND IT INSTITUTE");

        Toastr::success('Transaction Accepted', 'Success');
        return back();
    }
}
