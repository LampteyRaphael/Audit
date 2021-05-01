<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\Locals;
use App\Region;
use App\User;
use Illuminate\Http\Request;

class localSearchNationalController extends Controller
{
    //
    public function local(Request $request){

        $locals=Locals::where('name','LIKE','%'.$request['name'].'%')->Getlatest();

        $countLocals=Locals::count();
        return view('headquarters.local.index',compact('locals','countLocals'));
    }
    public function area(Request $request){

        $area=Area::where('name','LIKE','%'.$request['name'].'%')->Getlatest();

        $areaCount=count($area);

        $areaCount2=Area::count();
        return view('headquarters.area.index',compact('area','areaCount','areaCount2'));
    }

    public function district(Request $request){

        $districts=District::where('name','LIKE','%'.$request['name'].'%')->Getlatest();

        $districtCount=count($districts);

        $districtCount2=District::count();
        return view('headquarters.district.index',compact('districts','districtCount','districtCount2'));
    }

    public function national(Request $request){

        $regions=Region::where('name','LIKE','%'.$request['name'].'%')->Getlatest();

        $countRegion=Region::count();

        return view('headquarters.region.index',compact('regions','countRegion'));
    }


    public function admins(Request $request){

        $users=User::where('name','LIKE','%'.$request['name'].'%')->WhereIn('role_id',[1,2,3,4])->where('is_active',1)
            ->orwhere('members_id', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('email', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('gender', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('birthDate', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('mobileNumber1', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('mobileNumber2', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('workNumber', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('whatsappNumber', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('position', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('languagess', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->orwhere('officeHeld', 'LIKE', '%' . $request['name'] . '%')->where('is_active', 1)->WhereIn('role_id',[1,2,3,4])
            ->where('is_active', 1)
            ->Getlatest();
        $countUsers=User::whereIn('role_id',[1,2,3,4])->count();
        return view('headquarters.admin.users.index',compact('users','countUsers'));

    }



    public function missing(Request $request){
        if ($request==""){
            return back()->withErrors('The input cannot be empty');
        }else {
            $users = User::where('name', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('members_id', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('email', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('gender', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('birthDate', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('mobileNumber1', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('mobileNumber2', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('workNumber', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('whatsappNumber', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('position', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('languagess', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->orwhere('officeHeld', 'LIKE', '%' . $request['search'] . '%')->where('is_active', 1)
                ->where('is_active', 1)
                ->GetLatest();
        }
        return view('headquarters.searchUsers.create',compact('users'));
    }







}
