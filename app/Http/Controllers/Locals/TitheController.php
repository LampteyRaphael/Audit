<?php

namespace App\Http\Controllers\Locals;
use App\Exports\JanuaryFebView;
use App\Exports\JulyAugustView;
use App\Exports\MarchAprilView;
use App\Exports\MayJunelView;
use App\Exports\NovemberDecemberView;
use App\Exports\SeptemberOctoberView;
use App\Exports\UsersFromView;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TitheController extends Controller
{
    //exporting data in excel to database
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function data(Request $request){

//         Excel::import(new UsersImport,request()->file('select_file'),'users.xlsx');

//        $this->validate($request,[
//            'select_file'=>'required|mimes:xls,xlxs'
//        ]);

        $path=$request->file('select_file')->getRealPath();

        $data=Excel::load($path)->get();

        if ($data->count()>0){
            foreach ($data->toArray() as $key=>$value){
                foreach ($value as $row){
                    $insert_data[]=array(
                        'local_id'=>$row['local_id'],
                        'district_id'=>$row['district_id'],
                        'area_id'=>$row['area_id'],
                        'region_id'=>$row['region_id'],
                        'name'=> $row['name'],
                        'gender'   =>$row['gender'],
                        'birthDate'=>$row['birthDate'],
                        'placeOfBirth'=>$row['placeOfBirth'],
                        'hometown'=>$row['hometown'],
                        'hometown_region'=>$row['hometown_region'],
                        'nationality'=>$row['nationality'],
                        'languagess'=>$row['languagess'],
                    );
                }
            }

            if (!empty($insert_data)){

                User::insert($insert_data);

            }
        }
        return redirect()->route('registration.index')->with(['success1'=>'Successfully Imported']);

    }

    public function store(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $date=Carbon::now()->format('jS F, Y');

        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return view('members.tithe.daily',compact('tithe','date','year','month','day'));
    }

    public function storepost(Request $request){

        $date=$request['date'];
        $year=Carbon::parse($date)->year;
        $month=Carbon::parse($date)->month;
        $day=Carbon::parse($date)->day;

        $date=Carbon::now()->format('jS F, Y');

        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return view('members.tithe.daily',compact('tithe','date','year','month','day'));
    }

    public function month(){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=03;
        $b=04;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.monthly',compact('a','b','id','year','month','users'));
    }

    public function excelMApost(Request $request){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=$request['year'];
        $month=Carbon::now()->month;
        $a=03;
        $b=04;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->get(['id','members_id']);

        return view('members.tithe.monthly',compact('a','b','id','year','month','users'));
    }

    public function JF(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=01;
        $b=02;

        $id=Auth::user()->local_id;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.year',compact('year','month','users','id','a','b'));

    }

    public function JanuaryPost(Request $request){

        $year=$request['year'];
        $month=Carbon::now()->month;
        $a=01;
        $b=02;

        $id=Auth::user()->local_id;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.year',compact('year','month','date','users','id','a','b'));

    }

    public function mayjune(){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=05;
        $b=06;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.mayjune',compact('a','b','id','year','month','users'));
    }

    public function excelMJpost(Request $request){

        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=$request['year'];
        $month=Carbon::now()->month;
        $a=05;
        $b=06;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.mayjune',compact('a','b','id','year','month','users'));
    }

    public function excel($id){

        return Excel::download(new JanuaryFebView(request('id')),     'January-February.xlsx');
    }

    public function excelMA($id){

       return Excel::download(new MarchAprilView(request('id')),     'March-April.xlsx');
    }

    public function excelMJ($id){

        return Excel::download(new MayJunelView(request('id')),     'May-June.xlsx');
    }

    public function excelJA($id){

        return Excel::download(new JulyAugustView(request('id')),     'July-August.xlsx');
    }

    public function excelSO($id){

        return Excel::download(new SeptemberOctoberView(request('id')),     'September-October.xlsx');
    }

    public function excelND($id){

        return Excel::download(new NovemberDecemberView(\request('id')),     'November-December.xlsx');
    }

    public function julyAugust(){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=07;
        $b=8;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.julyAugust',compact('a','b','id','year','month','users'));
    }

    public function julyAugustPost(Request $request){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=$request['year'];
        $month=Carbon::now()->month;
        $a=07;
        $b=8;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.julyAugust',compact('a','b','id','year','month','users'));
    }

    public function septOctober(){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=9;
        $b=10;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.septOctober',compact('a','b','id','year','month','users'));
    }

    public function septOctoberPost(Request $request){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=$request['year'];
        $month=Carbon::now()->month;
        $a=9;
        $b=10;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.septOctober',compact('a','b','id','year','month','users'));
    }

    public function novDecember(){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=11;
        $b=12;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.novDecember',compact('a','b','id','year','month','users'));
    }

    public function novDecemberPost(Request $request){
        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=$request['year'];
        $month=Carbon::now()->month;
        $a=11;
        $b=12;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.novDecember',compact('a','b','id','year','month','users'));
    }

    public function monthpost(Request $request){

        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->GetLatest();

        return view('members.tithe.monthly',compact('id','year','month','users'));
    }

    public function midyear(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;


        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return view('members.tithe.midyear',compact('tithe','date','year','month'));
    }

    public function yearpost(Request $request){

        $year=$request['year'];
        $month=$request['month'];

        $date=$year;
        $a=$month;
        $b=$month+1;

        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return redirect()->back()->with(compact('date','b','a','year','month','date','tithe'));
    }





}
