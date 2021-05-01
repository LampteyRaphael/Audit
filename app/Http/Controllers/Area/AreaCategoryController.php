<?php

namespace App\Http\Controllers\Area;

use App\AreaIncome;
use App\AreaIncomeCategory;
use App\District;
use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaIncomeRequest;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AreaCategoryController extends Controller
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

        $incomeCategory=AreaIncomeCategory::where("area_id",$id)->orwhere('area_id',0)->get();

//        $t=incomeCategory::where("name",'Thanksgiving Offering')->where("local_id",0)->pluck('id');

//        $thanks=income::whereIn("local_id",$locals_id)->where('category_id',$t)->pluck('amount')->sum()*0.1;

        $total=AreaIncome::where("area_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $district_id2=District::where('area_id',$id)->pluck('id')->all();

         $locals_id=Locals::whereIn('district_id',$district_id2)->pluck('id')->all();


         $tithe=PostTithe::whereIn("local_id",$locals_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $t=incomeCategory::where("name",'Thanksgiving Offering')->where("local_id",0)->pluck('id');

        $thanks=income::whereIn("local_id",$locals_id)->where('category_id',$t)

                ->whereYear('created_at',$year)
                ->pluck('amount')->sum()*0.05;
        return view('area.incomeCategory.index',compact('incomeCategory','total','tithe','thanks','year'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('area.incomeCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=$request->all();

        AreaIncome::create($category);

        return redirect()->route('AccountInCArea.show',Session::get('aaccId'))->with(['success1'=>'Category successfully created']);
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
        $category=AreaIncomeCategory::findOrFail($id);

        $ids=  Auth::user()->area_id;

        $year=Carbon::now()->year;

        Session(['aaccId'=>$id]);

        $categoryAll=AreaIncome::where('area_income_categories_id',$category->id)->where('area_id',$ids)
            ->whereYear('created_at',$year)->get();

        $categoryAllTotal=AreaIncome::where('area_income_categories_id',$category->id)->where('area_id',$ids)
            ->whereYear('created_at',$year)->pluck('amount')->sum();

        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('area.incomeCategory.show',compact('yearTotal','category','categoryAll','categoryAllTotal','ids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //editing district category
        $category=AreaIncomeCategory::findOrFail($id);

        return view('area.incomeCategory.edit',compact('category'));
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

        $category=AreaIncomeCategory::findOrFail($id);

        $category->update($category1);

        return redirect()->route('AccountInCArea.index')->with(['success1'=>'Category successfully updated']);
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
        $category=AreaIncomeCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('AccountInCArea.index')->with(['success1'=>'Category successfully deleted']);
    }
}
