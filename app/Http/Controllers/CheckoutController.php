<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // check out page view
    public function checkOut()
    {
        // make cart array if not exists
        if (is_array(session('cart'))){
            $cart = session('cart');
        }else{
            return redirect(route('viewCart'));
        }

        // get all course of cart
        $total = Course::whereIn('id', $cart)->sum('fee');
        $discount = 0;

        $coupon = session('coupon');
        if ($coupon) {
            // check coupon for which course
            if ($this->checkCouponCourse($coupon)){
                if ($coupon->course_id == 'all') {
                    $discount = $total * $coupon->percentage / 100;
                } else {
                    $discount = Course::find($coupon->course_id)->fee * $coupon->percentage / 100;
                }
                $total -= $discount;
            }else{
                session()->forget('coupon');
            }
        }


        $total_bkash = $total + ($total * 2) / 100;
        $total_nagad = $total + ($total * 1) / 100;

        session(['total' => $total]);

        return view('frontend.pages.check_out', compact('total', 'total_bkash', 'total_nagad'));
    }


    // check coupon course validity
    public function checkCouponCourse($coupon)
    {
        // check coupon for which course
        if ($coupon->course_id != 'all'){
            $get_data = session('cart');
            if (is_array($get_data)){
                if (!array_key_exists($coupon->course_id, $get_data)){
                    return false;
                }
            }
        }
        // end if
        return true;
    }




    // check out form submit
    public function checkOutFormSubmit(Request $request)
    {
        $request->validate([
           'phone_number' => 'required',
           'transaction_id' => 'required',
        ], [
            'phone_number.required' => 'যে নাম্বার থেকে টাকা পাঠিয়েছেন সেটি দিন!',
            'transaction_id.required' => 'ট্রানজেকশন আইডি টি দিন!',
        ]);

        // make cart array if not exists
        if (is_array(session('cart'))){
            $cart = session('cart');
        }else{
            return redirect(route('viewCart'));
        }


        $transaction = new Transaction();
        if (session('coupon')){
            $coupon = session('coupon');
            $transaction->coupon = $coupon->code . '-' . $coupon->percentage . '%';
        }

        $transaction->user_id = Auth::id();
        $transaction->phone_number = $request->phone_number;
        $transaction->payment_method = $request->payment_method;
        $transaction->transaction_id = $request->transaction_id;
        $transaction->amount = session('total');
        $transaction->save();

        foreach ($cart as $single_cart){
            CourseTransaction::create([
                'transaction_id' => $transaction->id,
                'course_id' => $single_cart,
            ]);
        }

        session()->forget(['cart', 'coupon', 'total']);

        sendSms(Auth::user()->phone, "Thank you ". Auth::user()->name . ", Your payment has submitted to our team. Please wait for approve your payment.

LEGEND IT INSTITUTE");

        sendSms('01770496249', 'New Transaction: ' .$request->transaction_id.'

LEGEND IT INSTITUTE');

        return redirect(route('thanks', $transaction->id));
    }

    // thanks page
    public function thanks($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction->user_id != Auth::id()){
            return redirect(route('index'));
        }
        $total = $transaction->courses->sum('fee');
        return view('frontend.pages.thanks', compact('transaction', 'total'));
    }
}
