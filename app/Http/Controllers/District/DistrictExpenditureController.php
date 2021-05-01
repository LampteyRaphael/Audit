<?php

namespace App\Http\Controllers\District;

use App\DistrictExpenditure;
use App\DistrictExpenditureCategory;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DistrictExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $category=$request->all();

        DistrictExpenditureCategory::create($category);

        return redirect()->route('AccountEC.index')->with(['success1'=>'Category successfully created']);
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

        try{
           $districtId=Auth::user()->district_id;
            $income=DistrictExpenditure::findOrFail($id);
            $categoryName=DistrictExpenditureCategory::
            where('district_id',$districtId)->where('id',$income->district_income_categories_id)->get('name')->first();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Income not found by ID ' . $id)->withInput();
        }
        return view('districts.expensesErrors.index',compact('income','categoryName'));

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
        try{
            //updating district income
            $post=$request->all();

            $income=DistrictExpenditure::findOrFail($id);

            $income->update($post);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Income not found by ID ' . $id)->withInput();
        }
        return redirect()->route('AccountEC.show',Session::get('EaccId'))->with(['success1'=>'Successfully Change The Amount']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            //remove wrongly posted amount
            $income=DistrictExpenditure::findOrFail($id);
            $income->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Income not found by ID ' . $id)->withInput();
        }
        return redirect()->back()->with(['success1'=>'Successfully Deleted']);

    }
}
