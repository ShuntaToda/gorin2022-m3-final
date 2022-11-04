<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ApiController extends Controller
{
    public function items(Request $request)
    {
        $query = Item::query();

        if (isset($request->shop_id)) {
            $query->where('shop_id', $request->shop_id);
        }
        if (isset($request->price)) {
            $query->where('price', $request->price);
        }
        if (isset($request->title)) {
            $query->where('name', 'LIKE', '%' . $request->title . '%');
        }

        $items = $query->get();
        if ($items) {
            return response()->json($items, HttpFoundationResponse::HTTP_OK);
        } else {
            return response()->json('', HttpFoundationResponse::HTTP_NOT_FOUND);
        }
    }

    public function order(Request $request)
    {
        if (isset($request->item_id) && isset($request->address)) {
            $item = Item::find($request->item_id);
            if (isset($item)) {
                if (isset($request->coupon_code)) {
                    $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
                    $payment = $item->price - $coupon->discount_price;

                    Order::create([
                        'item_id' => $request->item_id,
                        'address' => $request->address,
                        'coupon_code' => $request->coupon_code,
                        'payment' => $payment < 0 ? 0 : $payment,
                    ]);
                } else {
                    Order::create([
                        'item_id' => $request->item_id,
                        'address' => $request->address,
                        'coupon_code' => null,
                        'payment' => $item->price
                    ]);
                }
            } else {

                return response()->json('', HttpFoundationResponse::HTTP_NOT_FOUND);
            }


            return response()->json('', HttpFoundationResponse::HTTP_OK);
        } else {
            return response()->json('', HttpFoundationResponse::HTTP_NOT_FOUND);
        }
    }
}
