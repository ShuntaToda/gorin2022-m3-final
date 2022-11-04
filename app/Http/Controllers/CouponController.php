<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class CouponController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::get();
        return response(view('coupons', compact('coupons')))->withHeaders(['Cache-Control' => 'no-store']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('coupons_create'))->withHeaders(['Cache-Control' => 'no-store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required',
            'discount_price' => 'required|numeric',
        ]);

        Coupon::create([
            'coupon_code' => $request->coupon_code,
            'discount_price' => $request->discount_price,
            'shop_id' => Auth::id()
        ]);

        $message = 'クーポン情報が登録されました。';
        return response(view('coupons_create', compact('message')))->withHeaders(['Cache-Control' => 'no-store']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon) {
            $coupon->delete();
        }

        return redirect(route('coupons_list'));
    }
}
