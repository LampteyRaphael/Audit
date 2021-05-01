<?php

namespace App\Http\Controllers\District;

use App\District;
use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DistrictIncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->district_id;

        $year=Carbon::now()->year;
        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.incomeCategory.index',compact('incomeCategory','total'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('districts.incomeCategory.create');
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

        DistrictIncome::create($category);

        return redirect()->route('AccountInC.show',Session::get('accId'))->with(['success1'=>'Category successfully created']);
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
        $category=DistrictIncomeCategory::findOrFail($id);

        $ids=  Auth::user()->district_id;

        $year=Carbon::now()->year;

        Session(['accId'=>$id]);

        $categoryAll=DistrictIncome::where('district_income_categories_id',$category->id)->where('district_id','=',$ids)
            ->whereYear('created_at',$year)->get();

        $categoryAllTotal=DistrictIncome::where('district_income_categories_id',$category->id)->where('district_id','=',$ids)
            ->whereYear('created_at',$year)->pluck('amount')->sum();

        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        Session(['districtIncomePosted'=>$id]);

       }catch (ModelNotFoundException $exception){

        return back()->withError('Income Category Not Found By ID ' . $id)->withInput();
     }
        return view('districts.incomeCategory.show',compact('yearTotal','category','categoryAll','categoryAllTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        //editing district category
        $category=DistrictIncomeCategory::findOrFail($id);
       }catch (ModelNotFoundException $exception){
         return back()->withError('Income Category Not Found By ID ' . $id)->withInput();
      }
        return view('districts.incomeCategory.edit',compact('category'));
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
        try{
        $category1=$request->all();

        $category=DistrictIncomeCategory::findOrFail($id);

        $category->update($category1);

       }catch (ModelNotFoundException $exception){
         return back()->withError('Income Category Not Found By ID ' . $id)->withInput();
       }
        return redirect()->route('AccountInC.index')->with(['success1'=>'Category successfully updated']);
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
        $category=DistrictIncomeCategory::findOrFail($id);
        $category->delete();

         }catch (ModelNotFoundException $exception){
           return back()->withError('Income Category Not Found By ID ' . $id)->withInput();
            }

        return redirect()->route('AccountInC.index')->with(['success1'=>'Category successfully deleted']);
    }
}
