<?php

namespace App\Http\Controllers\District;

use App\District;
use App\DistrictExpenditure;
use App\DistrictExpenditureCategory;
use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DistrictExpenditureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id=Auth::user()->district_id;

        $year=Carbon::now()->year;
        $incomeCategory=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictExpenditure::where("district_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.expenditureCategory.index',compact('incomeCategory','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $id=Auth::user()->district_id;

        $category=DistrictExpenditureCategory::where('district_id',$id)->orwhere("district_id",0)->pluck('name','id')->all();

        return view('districts.expenditure.create',compact('id','category'));
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

        DistrictExpenditure::create($category);

        return redirect()->route('AccountEC.show',Session::get('EaccId'))->with(['success1'=>'Category successfully created']);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        try{
        $category=DistrictExpenditureCategory::findOrFail($id);

        $ids=  Auth::user()->district_id;

        $year=Carbon::now()->year;

        Session(['EaccId'=>$id]);

        $categoryAll=DistrictExpenditure::Latest()->where('district_income_categories_id','=',$category->id)->where('district_id','=',$ids)
            ->whereYear('created_at',$year)->get();

        $categoryAllTotal=DistrictExpenditure::where('district_income_categories_id','=',$category->id)->where('district_id','=',$ids)
            ->whereYear('created_at',$year)->pluck('amount')->sum();

         }catch (ModelNotFoundException $exception){
          return back()->withError('Expenditure Category Not Found By ID ' . $id)->withInput();
        }

        return view('districts.expenditureCategory.show',compact('category','categoryAll','categoryAllTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        //editing district category
        $category=DistrictExpenditureCategory::findOrFail($id);

        return view('districts.expenditureCategory.edit',compact('category'));
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
        //
        $category=DistrictExpenditureCategory::findOrFail($id);

        $category->update($request->all());

        return redirect()->route('AccountEC.index')->with(['success1'=>'Category successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $category=DistrictExpenditureCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('AccountEC.index')->with(['success1'=>'Category successfully deleted']);
    }
}