<?php

namespace App\Http\Controllers\Locals;

use App\Exports\RangeChartView;
use App\Exports\titheChatsView;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class TitheChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching tithe posted every weeks and days
        $local_id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $postTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',01)->whereYear('created_at',$year)->pluck('amount')->sum();
        $fpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',02)->whereYear('created_at',$year)->pluck('amount')->sum();
        $mfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',03)->whereYear('created_at',$year)->pluck('amount')->sum();
        $afpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',04)->whereYear('created_at',$year)->pluck('amount')->sum();
        $myfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',05)->whereYear('created_at',$year)->pluck('amount')->sum();
        $jfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',06)->whereYear('created_at',$year)->pluck('amount')->sum();
        $jyfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',07)->whereYear('created_at',$year)->pluck('amount')->sum();
        $aufpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',8)->whereYear('created_at',$year)->pluck('amount')->sum();
        $sefpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',9)->whereYear('created_at',$year)->pluck('amount')->sum();
        $ocfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',10)->whereYear('created_at',$year)->pluck('amount')->sum();
        $novfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',11)->whereYear('created_at',$year)->pluck('amount')->sum();
        $decfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',12)->whereYear('created_at',$year)->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $thanksgiving1=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',01)->whereYear('created_at',$year)->pluck('amount')->sum();
        $thanksgiving2=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',02)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving3=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',03)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving4=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',04)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving5=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',05)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving6=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',06)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving7=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',07)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving8=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',8)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving9=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',9)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving10=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',10)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving11=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',11)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving12=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',12)->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('members.tithe.chart.index',compact('postTithe','fpostTithe','mfpostTithe','afpostTithe','year',
            'myfpostTithe','jfpostTithe','jyfpostTithe','aufpostTithe','sefpostTithe','sefpostTithe','ocfpostTithe','novfpostTithe','decfpostTithe',
            'thanksgiving1',
            'thanksgiving2',
            'thanksgiving3',
            'thanksgiving4',
            'thanksgiving5',
            'thanksgiving6',
            'thanksgiving7',
            'thanksgiving8',
            'thanksgiving9',
            'thanksgiving10',
            'thanksgiving11',
            'thanksgiving12'
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //fetching tithe posted every weeks and days
        $local_id=Auth::user()->local_id;
        $date1=Carbon::now()->previousWeekendDay();
        $date2=Carbon::now();
        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');
        $postTithe=PostTithe::where('local_id',$local_id)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $taksIdRange=income::where('local_id',$local_id)->where('category_id',$taksId)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        return view('members.tithe.chart.range',compact('date','date1','date2','postTithe','taksIdRange'));
    }

    public function store2(Request $request){
        $date1=$request['date1'];
        $date2=$request['date2'];
        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');
        $local_id=Auth::user()->local_id;
        $postTithe=PostTithe::where('local_id',$local_id)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $taksIdRange=income::where('local_id',$local_id)->where('category_id',$taksId)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        return view('members.tithe.chart.range',compact('postTithe','date','date1','date2','taksIdRange'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //fetching tithe posted every weeks and days
        $local_id=Auth::user()->local_id;
        $year=$request['year'];
        $postTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',01)->whereYear('created_at',$year)->pluck('amount')->sum();
        $fpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',02)->whereYear('created_at',$year)->pluck('amount')->sum();
        $mfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',03)->whereYear('created_at',$year)->pluck('amount')->sum();
        $afpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',04)->whereYear('created_at',$year)->pluck('amount')->sum();
        $myfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',05)->whereYear('created_at',$year)->pluck('amount')->sum();
        $jfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',06)->whereYear('created_at',$year)->pluck('amount')->sum();
        $jyfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',07)->whereYear('created_at',$year)->pluck('amount')->sum();
        $aufpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',8)->whereYear('created_at',$year)->pluck('amount')->sum();
        $sefpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',9)->whereYear('created_at',$year)->pluck('amount')->sum();
        $ocfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',10)->whereYear('created_at',$year)->pluck('amount')->sum();
        $novfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',11)->whereYear('created_at',$year)->pluck('amount')->sum();
        $decfpostTithe=PostTithe::where('local_id',$local_id)->whereMonth('created_at',12)->whereYear('created_at',$year)->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $thanksgiving1=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',01)->whereYear('created_at',$year)->pluck('amount')->sum();
        $thanksgiving2=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',02)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving3=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',03)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving4=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',04)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving5=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',05)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving6=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',06)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving7=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',07)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving8=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',8)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving9=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',9)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving10=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',10)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving11=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',11)->whereYear('created_at',$year)->pluck('amount')->sum();

        $thanksgiving12=income::where('local_id',$local_id)->where('category_id',$taksId)->whereMonth('created_at',12)->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('members.tithe.chart.index',compact('postTithe','fpostTithe','mfpostTithe','afpostTithe','year',
            'myfpostTithe','jfpostTithe','jyfpostTithe',
            'aufpostTithe',
            'sefpostTithe',
            'sefpostTithe',
            'ocfpostTithe',
            'novfpostTithe',
            'decfpostTithe',
            'thanksgiving1',
            'thanksgiving2',
            'thanksgiving3',
            'thanksgiving4',
            'thanksgiving5',
            'thanksgiving6',
            'thanksgiving7',
            'thanksgiving8',
            'thanksgiving9',
            'thanksgiving10',
            'thanksgiving11',
            'thanksgiving12'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($id)
    {
        //
        $date1=Session::get('date1');
        $date2=Session::get('date2');
        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');
        $local_id=Auth::user()->local_id;
        $postTithe=PostTithe::where('local_id',$local_id)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $taksIdRange=income::where('local_id',$local_id)->where('category_id',$taksId)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        $pdf=PDF::Loadview('members.tithe.chart.pdfrange',compact('postTithe','date','date1','date2','taksIdRange'));

        return $pdf->stream('Range.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function edit($id)
    {
        //exporting tithe chat to excel
        return Excel::download(new titheChatsView(),     'TitheChat.xlsx');
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

    }
}
