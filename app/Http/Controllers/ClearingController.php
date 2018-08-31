<?php

namespace App\Http\Controllers;

use App\Book;
use App\Clearing;
use App\Seller;
use App\TruckLoad;
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
        $book = DB::table('books')
            ->selectRaw('books.id, books.status, books.previous_money')
            ->whereRaw('books.seller_id = ? and books.status = ?', [$id, 0])
            ->orderByDesc('created_at')->first();
        $products_balance = 0;
        $money_balance = 0;
        if ($book == null) {
            $truck_loads = collect([]);
            $clearings = collect([]);
            $book_id = -1;
        } else {
            $truck_loads = TruckLoad::where('seller_id', '=', $id)
                ->where('status', '=', 0)
                ->where('book_id', '=', $book->id)->get();

            $clearings = Clearing::where('seller_id', '=', $id)
                ->where('book_id', '=', $book->id)->get();
            $book_id = $book->id;
            if ($clearings->isEmpty()) {
                $products_balance = 0;
                $money_balance = 0;
            } else {
                $products_balance = (float)$clearings[count($clearings) - 1]->left_in_products;
                $money_balance = (float)($clearings[count($clearings) - 1]->previous_credits_balance + $clearings[count($clearings) - 1]->income) - (float)($clearings[count($clearings) - 1]->payment + $clearings[count($clearings) - 1]->discount +
                    $clearings[count($clearings) - 1]->expense);
            }
        }

        return view('clearings.index')->with([
            'seller' => $seller,
            'clearings' => $clearings,
            'truck_loads' => $truck_loads,
            'products_balance' => $products_balance,
            'money_balance' => $money_balance,
            'book_id' => $book_id
        ]);
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
        $clearing = Clearing::find($id);
        $seller = Seller::find($clearing->seller_id);
        $expenses = DB::table('expenses')
            ->selectRaw('description, price')
            ->whereRaw('clearing_id = ?', [$id])->get();
        $payments = DB::table('payments')
            ->selectRaw('description, price')
            ->whereRaw('clearing_id = ?', [$id])->get();
        $discounts = DB::table('discounts')
            ->selectRaw('description, price')
            ->whereRaw('clearing_id = ?', [$id])->get();
        $credits = DB::table('credits')
            ->selectRaw('description, price')
            ->whereRaw('clearing_id = ?', [$id])->get();

        $money_delivered = DB::table('money_delivered')
            ->selectRaw('bill_100, bill_50, bill_20, bill_10, coin_5, coin_2, coin_1, cent_50, cent_20, cent_10')
            ->whereRaw('clearing_id = ?', [$id])->get();
        //dd($clearing);

        return view('clearings.show')->with(compact('clearing', 'expenses', 'payments', 'discounts', 'credits', 'money_delivered', 'seller'));
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
        dd($id);
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
        $book = DB::table('books')
            ->selectRaw('id, status, previous_money')
            ->whereRaw('seller_id = ? and status = ?', [$request->seller_id, 1])
            ->orderByDesc('created_at')->first();

        $new_book = DB::table('books')
            ->selectRaw('id, status, previous_money')
            ->whereRaw('seller_id = ? and status = ?', [$request->seller_id, 0])
            ->orderByDesc('created_at')->first();

        if ($new_book == null) {
            $book = new Book;
            $book->seller_id = $request->seller_id;
            $book->previous_money = 0;
            $book->save();
            $book_id = $book->id;

            $clearing = new Clearing;
            $clearing->seller_id = $request->seller_id;
            $clearing->previous_products_balance = 0;
            $clearing->previous_credits_balance = 0;
            $clearing->income = $request->income;
            $clearing->left_in_products = $request->left_in_products;
            $clearing->credit = $request->credit;
            $clearing->payment = $request->payment;
            $clearing->discount = $request->discount;
            $clearing->expense = $request->expense;
            $clearing->book_id = $book_id;
            $clearing->save();
            $clearing_id = $clearing->id;

        } else {
            if ($book == null) {
                $clearing = new Clearing;
                $clearing->seller_id = $request->seller_id;
                $clearing->previous_products_balance = 0;
                $clearing->previous_credits_balance = 0;
                $clearing->income = $request->income;
                $clearing->left_in_products = $request->left_in_products;
                $clearing->credit = $request->credit;
                $clearing->payment = $request->payment;
                $clearing->discount = $request->discount;
                $clearing->expense = $request->expense;
                $clearing->book_id = $new_book->id;
                $clearing->save();
                $clearing_id = $clearing->id;
            } else {
                if ($book->status == 1) {
                    $clearing = new Clearing;
                    $clearing->seller_id = $request->seller_id;
                    $clearing->previous_products_balance = 0;
                    $clearing->previous_credits_balance = $book->previous_money;
                    $clearing->income = $request->income;
                    $clearing->left_in_products = $request->left_in_products;
                    $clearing->credit = $request->credit;
                    $clearing->payment = $request->payment;
                    $clearing->discount = $request->discount;
                    $clearing->expense = $request->expense;
                    $clearing->book_id = $new_book->id;
                    $clearing->save();
                    $clearing_id = $clearing->id;
                } else {
                    $previous_balance = DB::table('clearings')
                        ->selectRaw('previous_credits_balance, income, payment, discount, expense, left_in_products')
                        ->whereRaw('seller_id = ? and book_id = ?', [$request->seller_id, $book->id])
                        ->orderByDesc('created_at')->first();

                    if ($previous_balance == null) {
                        $pb_p = 0;
                        $pb_c = 0;
                    } else {
                        //dd($previous_balance);
                        $pb_p = $previous_balance->left_in_products;
                        $pb_c = ((float)$previous_balance->previous_credits_balance + (float)$previous_balance->income) - ((float)$previous_balance->payment + (float)$previous_balance->discount + (float)$previous_balance->expense);
                    }

                    $clearing = new Clearing;
                    $clearing->seller_id = $request->seller_id;
                    $clearing->previous_products_balance = $pb_p;
                    $clearing->previous_credits_balance = $pb_c;
                    $clearing->income = $request->income;
                    $clearing->left_in_products = $request->left_in_products;
                    $clearing->credit = $request->credit;
                    $clearing->payment = $request->payment;
                    $clearing->discount = $request->discount;
                    $clearing->expense = $request->expense;
                    $clearing->book_id = $book->id;
                    $clearing->save();
                    $clearing_id = $clearing->id;
                }
            }
        }

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

            if (array_key_exists('left', $product)){
                DB::table('seller_product_bag')
                    ->whereRaw('seller_product_bag.seller_id = ? and seller_product_bag.product_id = ?', [$request->seller_id, $product['product_id']])
                    ->update([
                        'price' => $product['price'],
                        'amount' => $product['left']
                    ]);
            }
        }

        DB::table('money_delivered')->insert(
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
    }
}
