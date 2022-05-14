<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Course;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // add to cart
    public function addToCart(Request $request, $id)
    {
        $get_data = session('cart');
        if (is_array($get_data)){
            if (array_key_exists($id, $get_data)){
                return back()->with('message', 'কোর্সটি কার্টে আগেই যোগ হয়েছে।');
            }else{
                $get_data[$id] = $id;
                session(['cart' => $get_data]);
            }
        }else{
            $cart = [];
            $cart[$id] = $id;
            session(['cart' => $cart]);
        }
        return back()->with('message', 'কোর্সটি কার্টে যোগ হয়েছে।');
    }

    // view cart page
    public function viewCart()
    {
        // make cart array if not exists
        $something_in_cart = false;
        if (is_array(session('cart'))){
            $cart = session('cart');
            if (count($cart) > 0) {
                $something_in_cart = true;
            }
        }else{
            $cart = [];
        }
        // get all course of cart
        $courses = Course::find($cart);
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

        return view('frontend.pages.cart', compact('courses', 'total', 'something_in_cart', 'discount'));
    }

    // remove from cart
    public function removeFromCart(Request $request, $id)
    {
        $get_data = session('cart');
        if (is_array($get_data) && array_key_exists($id, $get_data)){
            unset($get_data[$id]);
            session(['cart' => $get_data]);
            return back()->with('message', 'কার্ট থেকে ১টি কোর্স রিমুভ করা হয়েছে।');
        }else{
            return back()->with('message', "Not yet added to cart");
        }
    }

    // apply coupon
    public function applyCoupon(Request $request)
    {
        if (Coupon::whereRaw("BINARY `code` = ?", [$request->coupon])->exists()){
            $coupon = Coupon::whereRaw("BINARY `code` = ?", [$request->coupon])->first();

            // check date of coupon
            if ($coupon->expire < date('Y-m-d')){
                return back()->with('message', 'দুঃখিত! কুপন এর মেয়াদ শেষ!');
            }

            // check coupon for which course
            if (!$this->checkCouponCourse($coupon)){
                return back()->with('message', 'দুঃখিত, এই কুপনটি কার্টের কোন কোর্সের জন্য প্রযোজ্য নয়।');
            }

            // add coupon in session
            session(['coupon' => $coupon]);
            return back();
        }
        return back()->with('message', 'দুঃখিত! কুপন পাওয়া যায় নি!');
    }

    // remove coupon
    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');
        return back()->with('message', 'কুপন রিমুভ হয়েছে।');
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

}
