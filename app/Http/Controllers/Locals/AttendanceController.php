<?php

namespace App\Http\Controllers\Locals;

use App\Attendance;
use App\Exports\Attendances;
use App\Exports\titheExportView;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index()
    {
        //displaying the attendance of a particular local

        $id=Auth::user()->local_id;

        $year=Carbon::now()->format('jS F,Y');

        $year1=Carbon::now();
        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $y=Carbon::now()->year;
        $date=$day.'-'.$month.'-'.$y;

       $post=Attendance::where('local_id',$id)->where('category','sunday')
           ->whereDay('created_at',$day)
           ->whereMonth('created_at',$month)
           ->whereYear('created_at',$y)
           ->get();

       $category='SUNDAY';
        $localName=Auth::user()->local->name;

        return view('attendance.index',compact('localName','post','id','year','year1','date','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::user()->local_id;

        return view('attendance.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //checking the attendance of people in a particular local
        Attendance::create($request->all());

        return redirect()->back()->with(['success'=>'Successfully Posted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return  Excel::download(new titheExportView(request('id')),     'the.xlsx');
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
