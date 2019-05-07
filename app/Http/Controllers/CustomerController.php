<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Activity;
use DB;

class CustomerController extends Controller
{

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), []);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $customer = Customer::all();
        return view('backEnd.customer.index', ['customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()
    {
        return view('backEnd.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->contact = $request->contact;
        $customer->desc = $request->desc;
        $customer->pajak = $request->pajak;
        $customer->save();
        Session::flash('alert-success', 'Customer berhasil dibuat.');
        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        
    }

    public function print($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backEnd.customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer = Customer::findOrFail($customer->id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->contact = $request->contact;
        $customer->desc = $request->desc;
        $customer->pajak = $request->pajak;
        $customer->save();
        Session::flash('alert-success', 'Customer berhasil diubah.');
        return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect('customer');
    }

}
