<?php
namespace App\Http\Controllers\Locals;
use App\Attendance;
use App\Exports\Attendances;
use App\Exports\DailyAttendanceExcel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PostAttendanceController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function attendExcel(){

        return  Excel::download(new Attendances,     'attendance.xlsx');
    }

    public function attendance(Request $request){
        $id=Auth::user()->local_id;

        $month1=$request['from'];

        $month2=$request['to'];

        $category=$request['category'];

        $date1=Carbon::parse($month1)->format('jS F,Y');

        $date2=Carbon::parse($month2)->format('jS F,Y');

        $year=' From ' . ' ' . $date1.' ' . ' to '. $date2;

        $post=Attendance::where('local_id',$id)->where('category',$category)

            ->whereBetween('created_at',[$month1 ,$month2])
            ->get();

        $date=[$month1.','.$month2];

        Session(['month1'=>$month1]);

        Session(['month2'=>$month2]);

        $localName=Auth::user()->local->name;
        $category=strtoupper($category);

        return view('attendance.index2',compact('category','localName','post','id','year','month1','month2','date'));
    }

    public function dailyAttendance(){
        $id=Auth::user()->local_id;
        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year1=Carbon::now()->year;
        $category='sunday';
        $post=Attendance::where('local_id',$id)->where('category',$category)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year1)
            ->get();

        $year=Carbon::now()->format('jS F,Y');
        $date=Carbon::now()->format('d-m-Y');
        return view('attendance.daily',compact('post','date','category','year'));

    }

    public function dailyAttendancePost(Request $request){
        $id=Auth::user()->local_id;
        $category=$request['category'];
        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year1=Carbon::parse($request['date'])->year;
        $post=Attendance::where('local_id',$id)->where('category',$category)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year1)
            ->get();
        $date=$day.'-'.$month.'-'.$year1;

        $year=Carbon::parse($request['date'])->format('jS F,Y');
        return view('attendance.daily',compact('post','date','category','year'));

    }

    public function dailyAttendanceExcel($id){

        return Excel::download(new DailyAttendanceExcel(request('id')),     'attendance.xlsx');
    }



}
