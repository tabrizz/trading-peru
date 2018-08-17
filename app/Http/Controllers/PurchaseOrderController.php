<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('purchase_orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('purchase_orders.create');
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
        $purchase_order = DB::table('purchase_orders')
            ->selectRaw('distinct purchase_orders.id as purchase_order_id,  purchase_orders.description as purchase_order_description, 
                        purchase_orders.total_price, purchase_orders.purchase_date, products.name, products.description, 
                        purchase_order_product.price, purchase_order_product.amount')
            ->join('purchase_order_product', 'purchase_orders.id', '=', 'purchase_order_product.purchase_order_id')
            ->join('products', 'purchase_order_product.product_id', '=', 'products.id')
            ->whereRaw('purchase_orders.id >= ?', [$id])->get();

        return view('purchase_orders.show')->with('purchase_order', $purchase_order);
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

    public function storePurchaseOrder(Request $request) {
        $purchase_order = new PurchaseOrder;
        $purchase_order->description = $request->description;
        $purchase_order->purchase_date = $request->purchase_date;
        $purchase_order->total_price = $request->total_price;
        $purchase_order->save();
        $purchase_order_id = $purchase_order->id;

        foreach ($request->products as $product) {
            if (array_key_exists('amount', $product)) {
                $product_available = Product::find($product['id']);

                DB::table('purchase_order_product')->insert(
                    [
                        'product_id' => $product['id'],
                        'purchase_order_id' => $purchase_order_id,
                        'price' => $product['price'],
                        'amount' => $product['amount'],
                        'created_at' =>  \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );

                DB::table('products')
                    ->whereRaw('products.id = ?', [$product['id']])
                    ->update([
                        'stock' => ($product_available->stock + $product['amount'])
                    ]);
            }
        }
    }

    public function getPurchaseOrderByDate($from_date, $to_date) {
        $purchase_orders = DB::table('purchase_orders')
            ->selectRaw('distinct purchase_orders.id as purchase_order_id, 
                        purchase_orders.total_price, purchase_orders.purchase_date')
            ->join('purchase_order_product', 'purchase_orders.id', '=', 'purchase_order_product.purchase_order_id')
            ->whereRaw('purchase_orders.purchase_date >= ? and purchase_orders.purchase_date <= ?', [$from_date, $to_date])->get();

        return $purchase_orders;
    }
}
