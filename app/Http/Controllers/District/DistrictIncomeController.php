<?php

namespace App\Http\Controllers\District;

use App\AuditTrail;
use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Http\Controllers\Controller;
use App\Locals;
use App\Transfer;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DistrictIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //checking to see the number of logins
        $id=Auth::user()->district_id;

        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $users=AuditTrail::whereIn('local_id',$locals_id)->GetLatest();

        return view('districts.audit.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $id=Auth::user()->district_id;

        $category=DistrictIncomeCategory::where('district_id',$id)->orwhere("district_id",0)->pluck('name','id')->all();

        return view('districts.income.create',compact('id','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $category=$request->all();

        DistrictIncomeCategory::create($category);

        return redirect()->route('AccountInC.index')->with(['success1'=>'Category successfully created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //calling for all transfers
      $id=Auth::user()->district_id;
      $locals_id=Locals::where('district_id',$id)->pluck('id');
      $users= Transfer::whereIn('to_local',[$locals_id])->getLatest();
       return view('districts.transfer.index',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try{
        //updating district income
        $post=$request->all();

        $income=DistrictIncome::findOrFail($id);

        $income->update($post);

       }catch (ModelNotFoundException $exception){

       return back()->withError('Income not found by ID ' . $id)->withInput();
        }
        return redirect()->route('AccountInC.show',Session::get('districtIncomePosted'))->with(['success1'=>'Successfully Change The Amount']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
        //remove wrongly posted amount
        $income=DistrictIncome::findOrFail($id);
        $income->delete();

       }catch (ModelNotFoundException $exception){

       return back()->withError('Income not found by ID ' . $id)->withInput();
         }
        return redirect()->back()->with(['success1'=>'Successfully Deleted']);

    }
}
