<?php

namespace App\Http\Controllers;

use App\Product;
use App\Seller;
use App\SellerProductBag;
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
        if ($this->isAvailable($request->products)) {
            $truck_load = new TruckLoad;
            $truck_load->seller_id = $request->seller['id'];
            $truck_load->description = $request->description;
            $truck_load->load_date = $request->load_date;
            $truck_load->total_price = $request->total_price;
            $truck_load->save();
            $truck_load_id = $truck_load->id;

            foreach ($request->products as $product) {
                if (array_key_exists('amount', $product)) {
                    $seller_bag = DB::table('seller_product_bag')
                        ->whereRaw('seller_product_bag.seller_id = ? and seller_product_bag.product_id = ?', [$request->seller['id'], $product['id']])->get();
                    if ($seller_bag->isEmpty()) {
                        DB::table('seller_product_bag')->insert(
                            [
                                'seller_id' => $request->seller['id'],
                                'product_id' => $product['id'],
                                'price' => $product['price'],
                                'amount' => $product['amount'],
                                'created_at' =>  \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now(),
                            ]
                        );
                    } else {
                        DB::table('seller_product_bag')
                            ->whereRaw('seller_product_bag.seller_id = ? and seller_product_bag.product_id = ?', [$request->seller['id'], $product['id']])
                            ->update([
                                'price' => ($product['price']),
                                'amount' => ($seller_bag[0]->amount + $product['amount'])
                            ]);
                    }
                    $product_available = Product::find($product['id']);

                    DB::table('products')
                        ->whereRaw('products.id = ?', [$product['id']])
                        ->update([
                            'stock' => ($product_available->stock - $product['amount'])
                        ]);

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
            $seller = Seller::find($request->seller['id']);
            $seller->money = $seller->money + $request->total_price;
            $seller->save();
            return response()->json(['store' => 'success']);

        } else {
            return response()->json(['store' => 'failed']);
        }

    }

    public function isAvailable($products) {
        //
        foreach ($products as $product) {
            if (array_key_exists('amount', $product)) {
                $product_available = DB::table('products')
                    ->whereRaw('products.id = ?', [$product['id']])->get();

                if ($product_available->isEmpty()) {
                    return false;
                } else {
                    $amount = (int)$product['amount'];
                    $stock = (int)$product_available[0]->stock;

                    if ($amount > $stock) {
                        dd(true);
                        return false;
                    }
                }
            }
        }
        return true;
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
