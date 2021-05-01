<?php

namespace App\Http\Controllers\Locals;

use App\Area;
use App\District;
use App\Exports\ChildrenFromView;
use App\Exports\UsersFromView;
use App\Http\Controllers\Controller;
use App\LanguagesInGhana;
use App\Locals;
use App\Region;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LocalMembersSearchController extends Controller
{
    public function store(Request $request){

        $countUserss=[];
        $countUsers=null;
        $males=[];
        $females=[];
        $deacons=[];
        $deaconesss=[];
        $deacon=null;
        $deaconess=null;
        $female=null;
        $male=null;
        $elders=[];
        $elder=null;
        //showing a particular local members
        $id=Auth::user()->local_id;
        $search=$request['search'];

        $localName=Locals::findOrFail($id);
        $users=User::where('local_id',$id)->where('name','LIKE','%'.$request['search'].'%')->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('members_id','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('email','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('gender','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('birthDate','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('mobileNumber1','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('mobileNumber2','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('workNumber','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('whatsappNumber','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('position','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('languagess','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->orwhere('officeHeld','LIKE','%'.$request['search'].'%')->where('local_id',$id)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->GetLatest();

        Session(['search'=>$search]);

        $usersCount = User::where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
            ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')
            ->get(['id','gender','officeHeld']);

        foreach ($usersCount as $user){

            if ($user){
                $countUserss[]=$user->id;
                $countUsers=count($countUserss);
            }

            if($user->gender ==='male'){
                $males[]=$user->gender;
                $male=count($males);
            }

            if($user->gender ==='female'){
                $females[]=$user->gender;
                $female=count($females);
            }

            if($user->officeHeld ==='deacon'){
                $deacons[]=$user->gender;
                $deacon=count($deacons);
            }

            if($user->officeHeld ==='deaconess'){
                $deaconesss[]=$user->gender;
                $deaconess=count($deaconesss);
            }

            if($user->officeHeld ==='elder'){
                $elders[]=$user->gender;
                $elder=count($elders);
            }

        }

        try{
            //registering of church members
            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;


            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');

            $roles = Role::where('id',5)->pluck('name','id')->all();

            $membership=Locals::where('id',$local_id)->pluck('local_code');

            foreach ($membership as $membershipId) {
                $membershipId;
            }

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Sorry Local not found' .$local_id)->withInput();
        }


        return view('locals.index',compact(
            'localName','users', 'countUsers','male','female',
            'deacon','deaconess','elder',
            'home_regions','locals', 'districts','languages',
            'membershipId','areas','regions','region_id', 'areas','regions','roles','home_regions'
        ));
    }


    public function storeExcel()
    {
        return Excel::download(new UsersFromView,     'Members.xlsx');
    }

    public function childrenExcel(){

        return Excel::download(new ChildrenFromView,     'Members.xlsx');
    }

}
