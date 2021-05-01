<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AreaExpenditure;
use App\AreaExpenditureCategory;
use App\AreaIncome;
use App\AreaIncomeCategory;
use App\District;
use App\Http\Controllers\Controller;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Adapter\Local;

class AreaTitheChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // showing district at the area level
        $id=Auth::user()->area_id;
        $year=Carbon::now()->year;

        $area=Area::findOrFail($id);

        $districts=District::Latest()->where('area_id','=',$area->id)->get();

        $district_id=District::where('area_id',$area->id)->pluck('id')->all();


        $countArea=$districts->count();

        Session(['area_id'=>$area->id]);

        return view('area.chart.year',compact('area','year','districts','countArea'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // showing district at the area level
        $id=Auth::user()->area_id;
        $year=Carbon::now()->year;

        $month=Carbon::now()->month;
        $area=Area::findOrFail($id);

        $districts=District::Latest()->where('area_id','=',$area->id)->get();

        $district_id=District::where('area_id',$area->id)->pluck('id')->all();


        $countArea=$districts->count();

        Session(['area_id'=>$area->id]);

        view('area.chart.month',compact('month','area','year','districts','countArea'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // showing district at the area level
        $id=Auth::user()->area_id;

        $year=$request['year'];

        $area=Area::findOrFail($id);

        $districts=District::Latest()->where('area_id','=',$area->id)->get();

        $district_id=District::where('area_id',$area->id)->pluck('id')->all();


        $countArea=$districts->count();

        Session(['area_id'=>$area->id]);

        return view('area.chart.year',compact('area','year','districts','countArea'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $locals=Locals::where('district_id',$id)->get();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $area_tithe=PostTithe::whereIn("local_id",$locals_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('area.reports.dailyBreakDown',compact('locals','year','month','day','area_tithe'));

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
        //
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
}
