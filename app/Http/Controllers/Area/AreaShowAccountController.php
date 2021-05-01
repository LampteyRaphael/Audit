<?php

namespace App\Http\Controllers\Area;

use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Requests\DepositeRequest;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class AreaShowAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $id=Auth::user()->area_id;

        $district=District::where('area_id',$id)->pluck('name','id')->all();

        $d=District::where('area_id',$id)->pluck('id');

        $local=Locals::whereIn('district_id',$d)->pluck('name', 'id')->all();

        return view( 'area.churchaccount.show',compact(
            'district','local'
    ));

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

        $post = $request->all();
        //show monthly contributions

            $year = $post['year'];
            $id = $post['local_id'];

        $idd = Auth::user()->area_id;
        $d = District::where('area_id', $idd)->pluck('id');

        $local = Locals::whereIn('district_id', $d)->pluck('name', 'id')->all();

        $date = $year;
        $incomeCategory = incomeCategory::all()
            ->where("local_id", $id);

        $total = income::where("local_id", $id)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $expenditureCategory = ExpenditureCategory::all()->where("local_id", $id);

        $totalExpenditure = Expenditure::where("local_id", $id)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $totalTithe = PostTithe::where('local_id', $id)
            ->whereYear('created_at', $year)->pluck('amount')->sum();

        return view('area.churchaccount.years', compact(
            'year', 'date', 'local', 'incomeCategory', 'total', 'expenditureCategory', 'totalExpenditure', 'totalTithe'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        //show monthly contributions
        $id=Auth::user()->local_id;

        $year= Carbon::now()->year;
        $date=$year;
        $incomeCategory=incomeCategory::all()
            ->where("local_id",$id);

        $total=income::where("local_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::all()->where("local_id",$id);

        $totalExpenditure=Expenditure::where("local_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)
            ->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('area.churchaccount.years',compact(
            'year','date','incomeCategory','total','expenditureCategory', 'totalExpenditure','totalTithe'
        ));

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
