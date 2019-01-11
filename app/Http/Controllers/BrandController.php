<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Activity;

class BrandController extends Controller
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
        $brand = Brand::all();

        return view('backEnd.brand.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.brand.create');
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

        
      $model = Brand::create($request->all());

      $attributes = $model->getOriginal();

      activity()->performedOn($model)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Brand '.$model->name.' is created successfully');

      Session::flash('alert-success', 'Brand '.$model->name.' is created successfully');

        return redirect('brand');
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
        $brand = Brand::findOrFail($id);

        return view('backEnd.brand.show', compact('brand'));
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
        $brand = Brand::findOrFail($id);

        return view('backEnd.brand.edit', compact('brand'));
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
        
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        $attributes = $brand->getOriginal();

        activity()->performedOn($brand)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Brand '.$brand->name.' is updated successfully');

        Session::flash('alert-success', ' Brand '.$brand->name.' is updated successfully');

        return redirect('brand');
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
        $brand = Brand::findOrFail($id);

        $brand->delete();

        $attributes = $brand->getOriginal();

        activity()->performedOn($brand)->causedBy(Sentinel::getUser()->id)->withProperties($attributes)->log('Brand '.$brand->name.' is deleted successfully');

        Session::flash('alert-warnig', ' Brand '.$brand->name.' is deleted successfully');

        return redirect('brand');
    }

}
