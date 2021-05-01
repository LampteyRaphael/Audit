<?php

namespace App\Http\Controllers\Area;

use App\AreaExpenditure;
use App\AreaExpenditureCategory;
use App\AreaIncomeCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaIncomeRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AreaExpenditureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->area_id;

        $year=Carbon::now()->year;
        $incomeCategory=AreaExpenditureCategory::where("area_id",$id)->orwhere('area_id',0)->get();

        $total=AreaExpenditure::where("area_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('area.expenditureCategory.index',compact('incomeCategory','total','year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id=Auth::user()->area_id;

        $category=AreaExpenditureCategory::where('area_id',$id)->pluck('name','id')->all();

        return view('area.expenditure.create',compact('id','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaIncomeRequest $request)
    {
        //
        $category=$request->all();

        AreaExpenditure::create($category);

        return redirect()->route('AccountECArea.show',Session::get('EEaccId'))->with(['success1'=>'Category successfully created']);
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
        $category=AreaExpenditureCategory::findOrFail($id);

        $ids=  Auth::user()->area_id;

        $year=Carbon::now()->year;

        Session(['EEaccId'=>$id]);

        $categoryAll=AreaExpenditure::Latest()->where('area_income_categories_id','=',$category->id)->where('area_id','=',$ids)
            ->whereYear('created_at',$year)->get();

        $categoryAllTotal=AreaExpenditure::where('area_income_categories_id','=',$category->id)->where('area_id','=',$ids)
            ->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('area.expenditureCategory.show',compact('category','categoryAll','categoryAllTotal'));
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
        //editing district category
        $category=AreaExpenditureCategory::findOrFail($id);

        return view('area.expenditureCategory.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaIncomeRequest $request, $id)
    {
        //

         $category1=$request->all();

        $category=AreaExpenditureCategory::findOrFail($id);

        $category->update($category1);
        return redirect()->route('AccountECArea.index')->with(['success1'=>'Category successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=AreaExpenditureCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('AccountECArea.index')->with(['success1'=>'Category successfully deleted']);
    }
}
