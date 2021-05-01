<?php

namespace App\Http\Controllers\National;

use App\Attendance;
use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Locals;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NationalLocalSearchController extends Controller
{
    //
    public function store(Request $request){
        //
        $id=$request['id'];
        $locals=Locals::findOrFail($id);

        $users=User::where('local_id','=',$locals->id)->where('name','LIKE','%'.$request['search'].'%')->where('is_active',1)
            ->orwhere('members_id','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('email','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('gender','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('birthDate','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('mobileNumber1','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('mobileNumber2','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('workNumber','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('whatsappNumber','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('position','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('languagess','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->orwhere('officeHeld','LIKE','%'.$request['search'].'%')->where('local_id','=',$locals->id)->where('is_active',1)
            ->where('is_active',1)
            ->GetLatest();


        $children=[];
        foreach ($users as $user){

            if (Carbon::parse($user->birthDate)->age <=15){

                $children[]=$user;
            }
        }

        $countUsers=User::where('local_id',$id)
            ->where('is_active',1)->count();

        $matchM=['local_id'=>$id,'is_active'=>1,'gender'=>'male'];
        $male=User::where($matchM)->count();

        $matchF=['local_id'=>$id,'is_active'=>1,'gender'=>'female'];
        $female=User::where($matchF)->count();

        $matchD=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'deacon'];
        $deacon=User::where($matchD)->count();

        $matchDN=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'deaconess'];
        $deaconess=User::where($matchDN)->count();

        $elder= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'elder'];
        $elder=User::where($elder)->count();

        $member= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'member'];
        $member=User::where($member)->count();

        Session(['localAdmin_id'=> $id]);
        return view('headquarters.local.show',compact('locals',

            'users','countUsers','male','female','deacon','deaconess','elder','member','children'
            ,'id'
        ));
    }

//    public function store2($id)
//    {
//        $locals = Locals::findOrFail($id);
//
//        $users = User::where('local_id', '=', $locals->id)->Latest();
//
//        $dateOfBirth = Carbon::now()->format('Y-m-d');
//
//        $children = [];
//        foreach ($users as $user) {
//
//            if ($dateOfBirth - $user->birthDate <= 15) {
//
//                $children[] = $user;
//            }
//        }
//
//        $countUsers = User::where('local_id', $id)
//            ->where('is_active', 1)->count();
//
//        $matchM = ['local_id' => $id, 'is_active' => 1, 'gender' => 'male'];
//        $male = User::where($matchM)->count();
//
//        $matchF = ['local_id' => $id, 'is_active' => 1, 'gender' => 'female'];
//        $female = User::where($matchF)->count();
//
//        $matchD = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'deacon'];
//        $deacon = User::where($matchD)->count();
//
//        $matchDN = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'deaconess'];
//        $deaconess = User::where($matchDN)->count();
//
//        $elder = $match = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'elder'];
//        $elder = User::where($elder)->count();
//
//        $member = $match = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'member'];
//        $member = User::where($member)->count();
//
//        Session(['localAdmin_id' => $id]);
//
//
//        return view('headquarters.local.show', compact('locals',
//
//            'users', 'countUsers', 'male', 'female', 'deacon', 'deaconess', 'elder', 'member', 'children'
//            , 'id'
//        ));
//    }

    public function index($id){
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

        return view('headquarters.region.attendance.index',compact('post','year','date','category','id'));
    }

    public function indexpost(Request $request){

        $month1=$request['from'];

        $month2=$request['to'];

        $category=$request['category'];

        $date1=Carbon::parse($month1)->format('jS F,Y');

        $date2=Carbon::parse($month2)->format('jS F,Y');

        $year=' From ' . ' ' . $date1.' ' . ' to '. $date2;

        $post=Attendance::where('local_id',$request['id'])->where('category',$category)

            ->whereBetween('created_at',[$month1 ,$month2])
            ->get();

        $date=[$month1.','.$month2];


        $localName=Locals::where('id',$request['id'])->pluck('name');

        $category=strtoupper($category);

        $id=$request['id'];
        return view('headquarters.region.attendance.index',compact('id','localName','post','year','date','category'));
    }

    public function audit($id){

        $users=AuditTrail::where('local_id',$id)->GetLatest();

        return view('headquarters.region.Audit-trail.index',compact('users','id'));
    }

    public function nationalaudit(){

      $users=AuditTrail::orderBy('created_at','desc')->whereYear('created_at',Carbon::now()->year)->paginate(50);

        return view('headquarters.region.Audit-trail.index2',compact('users'));
    }

    public  function empty(Request $request){

        $id=$request['id'];

        AuditTrail::where('local_id',$id)->delete();

        return redirect()->back()->with(['success'=>'Successfully Empty The Recycle Bin']);
    }

    public  function empty2(Request $request){

            AuditTrail::truncate();

        return redirect()->back()->with(['success'=>'Successfully Empty The Recycle Bin']);
    }
}
