<?php

namespace App\Http\Controllers;

use App\Book;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $books = Book::where('seller_id', '=', $id)
            ->where('status', '=', 1)->get();

        $seller = Seller::find($id);

        return view('books.index')->with(compact('books', 'seller'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $book = Book::find($id);
        $seller = Seller::find($book->seller_id);
        $truck_loads = DB::table('truck_loads')
            ->whereRaw('book_id = ?', [$id])
            ->orderBy('created_at')->get();
        $clearings = DB::table('clearings')
            ->whereRaw('book_id = ?', [$id])
            ->orderBy('created_at')->get();

        return view('books.show')->with(compact('book', 'seller', 'truck_loads', 'clearings'));
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
        $seller_bag = DB::table('seller_product_bag')
            ->whereRaw('seller_product_bag.seller_id = ?', [$request->seller['id']])->get();

        foreach ($seller_bag as $product) {
            $product_available = Product::find($product->product_id);

            DB::table('products')
                ->whereRaw('products.id = ?', [$product->product_id])
                ->update([
                    'stock' => ($product_available->stock + $product->amount)
                ]);
        }

        DB::table('seller_product_bag')
            ->whereRaw('seller_product_bag.seller_id = ?', [$request->seller['id']])
            ->delete();

        $book = Book::find($id);
        $book->status = 1;
        $book->previous_money = $request->money_balance;
        $book->save();
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
}
