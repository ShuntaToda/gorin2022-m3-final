<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();
        return response(view('items', compact('items')))->withHeaders(['Cache-Control' => 'no-store']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('items_create'))->withHeaders(['Cache-Control' => 'no-store']);
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
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'shop_id' => Auth::id()
        ]);

        $message = '商品情報が登録されました。';
        return response(view('items_create', compact('message')))->withHeaders(['Cache-Control' => 'no-store']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return response(view('items_edit', compact('item')))->withHeaders(['Cache-Control' => 'no-store']);
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $item = Item::find($id);

        $item->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);


        $message = '商品情報が更新されました。';
        return response(view('items_edit', compact('item', 'message')))->withHeaders(['Cache-Control' => 'no-store']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();
        }

        return redirect(route('home'));
    }
}
