<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;

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

        //dd($request->all());
        $this->validate($request, [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'dni'=>'nullable|numeric',
            'phone_number'=>'nullable|string',
            'address'=>'nullable|string',
        ]);
        Seller::create($request->all());
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
}
