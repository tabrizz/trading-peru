<?php

namespace App\Http\Controllers;

use App\TruckLoad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TruckLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('truck_loads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('truck_loads.create');
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
        //
        $truck_load = DB::table('truck_loads')
            ->selectRaw('distinct truck_loads.id as truck_load_id,  truck_loads.description as truck_load_description, 
                        sellers.first_name, sellers.last_name, truck_loads.total_price, truck_loads.load_date, products.name, 
                        products.description, product_truck_load.price, product_truck_load.amount')
            ->join('product_truck_load', 'truck_loads.id', '=', 'product_truck_load.truck_load_id')
            ->join('products', 'product_truck_load.product_id', '=', 'products.id')
            ->join('sellers', 'truck_loads.seller_id', '=', 'sellers.id')
            ->whereRaw('truck_loads.id >= ?', [$id])->get();

        return view('truck_loads.show')->with('truck_load', $truck_load);
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
        //
    }

    public function storeTruckLoadProducts(Request $request) {
        //
        $truck_load = new TruckLoad;
        $truck_load->seller_id = $request->seller['id'];
        $truck_load->description = $request->description;
        $truck_load->load_date = $request->load_date;
        $truck_load->total_price = $request->total_price;
        $truck_load->save();
        $truck_load_id = $truck_load->id;

        foreach ($request->products as $product) {
            if (array_key_exists('amount', $product)) {
                DB::table('product_truck_load')->insert(
                    [
                        'product_id' => $product['id'],
                        'truck_load_id' => $truck_load_id,
                        'price' => $product['price'],
                        'amount' => $product['amount'],
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );
            }
        }
    }

    public function getTruckLoadByDate($from_date, $to_date) {
        $truck_loads = DB::table('truck_loads')
            ->selectRaw('distinct truck_loads.id as truck_load_id, sellers.first_name, sellers.last_name, truck_loads.total_price, truck_loads.load_date')
            ->join('product_truck_load', 'truck_loads.id', '=', 'product_truck_load.truck_load_id')
            ->join('sellers', 'truck_loads.seller_id', '=', 'sellers.id')
            ->whereRaw('truck_loads.load_date >= ? and truck_loads.load_date <= ?', [$from_date, $to_date])->get();

        return $truck_loads;
    }
}
