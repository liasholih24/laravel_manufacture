<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class SupplierController extends Controller
{

protected function validator(Request $request)
{
/*dicustom*/
  return Validator::make($request->all(), [
    /*  'name' => 'required|max:35|min:2|string',*/
  ]);
}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $supplier = Supplier::all();

        return view('backEnd.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {


    if ($this->validator($request)->fails()) {
        return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
    }

        
      $model = Supplier::create($request->all());

      $attributes = $model->getOriginal();

      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Supplier '.$model->name.' is created successfully');

      Session::flash('alert-success', 'Supplier '.$model->name.' is created successfully');

        return redirect('supplier');
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
        $supplier = Supplier::findOrFail($id);

        return view('backEnd.supplier.show', compact('supplier'));
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
        $supplier = Supplier::findOrFail($id);

        return view('backEnd.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
    if ($this->validator($request)->fails()) {
        return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
    }
        
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        $attributes = $supplier->getOriginal();

        activity()->performedOn($supplier)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Supplier '.$supplier->name.' is updated successfully');

        Session::flash('alert-success', ' Supplier '.$supplier->name.' is updated successfully');

        return redirect('supplier');
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
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        $attributes = $supplier->getOriginal();

        activity()->performedOn($supplier)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Supplier '.$supplier->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Supplier '.$supplier->name.' is deleted successfully');

        return redirect('supplier');
    }

}
