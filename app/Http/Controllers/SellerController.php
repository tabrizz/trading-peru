<?php

namespace App\Http\Controllers;

use App\Seller;
use App\SellerProductBag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sellers = Seller::all();

        return view('sellers.index')->with('sellers', $sellers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sellers.create');
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

        $this->validate($request, [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'dni'=>'nullable|numeric',
            'phone_number'=>'nullable|string',
            'address'=>'nullable|string',
        ]);
        Seller::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dni' => $request->dni,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'money' => ($request->money == null ? 0 : $request->money)
        ]);
        return redirect()->route('sellers.index')->with('success','Vendedor creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $seller = Seller::find($id);

        return view('sellers.edit')->with('seller', $seller);
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
        $this->validate($request, [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'dni'=>'nullable|numeric',
            'phone_number'=>'nullable|string',
            'address'=>'nullable|string',
        ]);
        $seller = Seller::find($id);
        $seller->update($request->all());

        return redirect()->route('sellers.index')->with('updated','Vendedor actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSellers() {
        $sellers = Seller::all();

        return $sellers;
    }

    public function getSellerBag($id) {
        $seller_product_bag = DB::table('seller_product_bag')
            ->selectRaw('seller_product_bag.id as seller_product_bag_id, sellers.first_name, sellers.last_name,
                        sellers.dni, products.name, products.description, seller_product_bag.amount, seller_product_bag.price')
            ->join('products', 'seller_product_bag.product_id', '=', 'products.id')
            ->join('sellers', 'seller_product_bag.seller_id', '=', 'sellers.id')
            ->whereRaw('seller_product_bag.seller_id = ?', [$id])->get();

        return view('sellers.inventory')->with('seller_product_bag', $seller_product_bag);
    }

    public function storeSellerClearing() {

    }
}
