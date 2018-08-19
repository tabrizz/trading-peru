<?php

namespace App\Http\Controllers;

use App\Clearing;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClearingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $seller = Seller::find($id);
        $clearings = Clearing::paginate(20);

        return view('clearings.index')->with(['seller' => $seller, 'clearings' => $clearings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $seller_product_bag = DB::table('seller_product_bag')
            ->selectRaw('seller_product_bag.id as seller_product_bag_id, sellers.first_name, sellers.last_name, sellers.id as seller_id,
                        sellers.dni, products.id as product_id, products.name, products.description, seller_product_bag.amount, seller_product_bag.price')
            ->join('products', 'seller_product_bag.product_id', '=', 'products.id')
            ->join('sellers', 'seller_product_bag.seller_id', '=', 'sellers.id')
            ->whereRaw('seller_product_bag.seller_id = ?', [$id])->get();

        return view('clearings.create')->with('seller_product_bag', $seller_product_bag);
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
        return view('clearings.show');
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

    public function getSellerBag($id) {
        $seller_product_bag = DB::table('seller_product_bag')
            ->selectRaw('seller_product_bag.id as seller_product_bag_id, sellers.first_name, sellers.last_name,
                        sellers.dni, products.name, products.description, seller_product_bag.amount, seller_product_bag.price')
            ->join('products', 'seller_product_bag.product_id', '=', 'products.id')
            ->join('sellers', 'seller_product_bag.seller_id', '=', 'sellers.id')
            ->whereRaw('seller_product_bag.seller_id = ?', [$id])->get();

        return view('sellers.inventory')->with('seller_product_bag', $seller_product_bag);
    }

    public function storeClearing(Request $request) {
        $clearing = new Clearing;
        $clearing->seller_id = $request->seller_id;
        $clearing->income = $request->income;
        $clearing->balance = $request->balance;
        $clearing->expense = $request->expense;
        $clearing->discount = $request->discount;
        $clearing->credit = $request->credit;
        $clearing->payment = $request->payment;
        $clearing->save();
        $clearing_id = $clearing->id;

        if(!empty($request->expenses)) {
            foreach ($request->expenses as $expense) {
                DB::table('expenses')->insert(
                    [
                        'description' => $expense['description'],
                        'price' => $expense['price'],
                        'clearing_id' => $clearing_id,
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );
            }
        }
        if(!empty($request->payments)) {
            foreach ($request->payments as $payment) {
                DB::table('payments')->insert(
                    [
                        'description' => $payment['description'],
                        'price' => $payment['price'],
                        'clearing_id' => $clearing_id,
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );
            }
        }
        if(!empty($request->discounts)) {
            foreach ($request->discounts as $discount) {
                DB::table('discounts')->insert(
                    [
                        'description' => $discount['description'],
                        'price' => $discount['price'],
                        'clearing_id' => $clearing_id,
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );
            }
        }
        if(!empty($request->credits)) {
            foreach ($request->credits as $credit) {
                DB::table('credits')->insert(
                    [
                        'description' => $credit['description'],
                        'price' => $credit['price'],
                        'clearing_id' => $clearing_id,
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );
            }
        }
        foreach ($request->products as $product) {

            if (array_key_exists('sold', $product)){
                $seller_bag = DB::table('seller_product_bag')
                    ->whereRaw('seller_product_bag.seller_id = ? and seller_product_bag.product_id = ?', [$request->seller_id, $product['product_id']])->get();
                DB::table('seller_product_bag')
                    ->whereRaw('seller_product_bag.seller_id = ? and seller_product_bag.product_id = ?', [$request->seller_id, $product['product_id']])
                    ->update([
                        'price' => ($product['price']),
                        'amount' => ($seller_bag[0]->amount - $product['sold'])
                    ]);
            }
        }

        DB::table('incomes')->insert(
            [
                'bill_100' => $request->bill_100,
                'bill_50' => $request->bill_50,
                'bill_20' => $request->bill_20,
                'bill_10' => $request->bill_10,
                'coin_5' => $request->coin_5,
                'coin_2' => $request->coin_2,
                'coin_1' => $request->coin_1,
                'cent_50' => $request->cent_50,
                'cent_20' => $request->cent_20,
                'cent_10' => $request->cent_10,
                'clearing_id' => $clearing_id,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        );


        $total = $request->income + $request->expense + $request->discount + $request->credit - $request->payment - $request->balance;

        $seller = Seller::find($request->seller_id);
        $seller->money = $seller->money - $total;
        $seller->save();
    }
}
