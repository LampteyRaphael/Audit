<?php

namespace App\Http\Controllers\Area;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalsUpdateRequest;
use App\Locals;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AreaLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $area_id=Auth::user()->area_id;

        $users=User::where('area_id',$area_id)->where('is_active',0)->where('officeHeld','!=','children ministry')->whereIn('role_id',[1,2,3,4,5])
            ->orwhere('area_id',$area_id)->where('is_active',0)->where('officeHeld','')->whereIn('role_id',[1,2,3,4,5])
            ->GetLatest();

        $areaName=Auth::user()->area->name;

        return view('area.churchaccount.edit',compact('users','areaName'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //counting of none active members in an area
        $area_id=Auth::user()->area_id;

        $users=User::where('area_id',$area_id)->where('is_active',3)->where('officeHeld','!=','children ministry')->whereIn('role_id',[1,2,3,4,5])
            ->orwhere('area_id',$area_id)->where('is_active',3)->where('officeHeld','')->whereIn('role_id',[1,2,3,4,5])
            ->GetLatest();
        $areaName=Auth::user()->area->name;
        return view('area.churchaccount.create',compact('users','areaName'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
        $area_id=Auth::user()->area_id;

        $district_id=District::where('area_id',$area_id)->pluck('id');

        $locals=Locals::where('id',$id)->whereIn('district_id',$district_id)->firstOrFail();

        $users=User::where('area_id',$area_id)->where('local_id',$id)->where('officeHeld','!=','children ministry')->whereIn('role_id',[1,2,3,4,5])->where('is_active',1)
            ->orwhere('local_id',$id)->where('officeHeld','')->whereIn('role_id',[1,2,3,4,5])->where('is_active',1)->GetLatest();

        $children=User::where('area_id',$area_id)->where('local_id',$id)->where('officeHeld','children ministry')->whereIn('role_id',[1,2,3,4,5])->where('is_active',1)->count();

        $countUsers=User::where('area_id',$area_id)->where('local_id',$locals->id)->where('officeHeld','!=','children ministry')->whereIn('role_id',[1,2,3,4,5])->where('is_active',1)->count();
        $male= $match=['local_id'=>$id,'is_active'=>1,'gender'=>'male'];
        $male=User::where('area_id',$area_id)->where($male)->whereIn('role_id',[1,2,3,4,5])->count();

        $female= $match=['local_id'=>$id,'is_active'=>1,'gender'=>'female'];
        $female=User::where('area_id',$area_id)->where($female)->whereIn('role_id',[1,2,3,4,5])->count();


        $deacon= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'deacon'];
        $deacon=User::where('area_id',$area_id)->where($deacon)->whereIn('role_id',[1,2,3,4,5])->count();

        $deaconess= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'deaconess'];
        $deaconess=User::where('area_id',$area_id)->where($deaconess)->whereIn('role_id',[1,2,3,4,5])->count();

        $elder= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'elder'];
        $elder=User::where('area_id',$area_id)->where($elder)->whereIn('role_id',[1,2,3,4,5])->count();

        $member= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'member'];
        $member=User::where('area_id',$area_id)->where($member)->whereIn('role_id',[1,2,3,4,5])->count();

        $pastor= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'pastor'];
        $pastors=User::where('area_id',$area_id)->where($pastor)->whereIn('role_id',[1,2,3,4,5])->count();

        $presiding= $pastor= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'pastor'];
        $presiding=User::where('area_id',$area_id)->where($presiding)->whereIn('role_id',[1,2,3,4,5])->count();

        Session(['localAdminId'=> $id]);

        }catch (ModelNotFoundException $exception){

           return back()->withError('User not found by ID ' . $id)->withInput();
        }


return view('area.local.show',compact('locals','pastors', 'presiding', 'users','countUsers','male','female','deacon','deaconess','elder','member','children'));

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
        $local=Locals::findOrFail($id);

        return view('area.local.edit',compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalsUpdateRequest $request, $id)
    {
        //
        $user=Locals::findOrFail($id);

        $input=$request->all();

        $user->update($input);

        return redirect()->route('level.show',(Session::get('district_id')))->with(['success1'=>'successfully updated']);
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
        $local=Locals::findOrFail($id);

        $local->delete();
        return redirect()->route('level.show',(Session::get('district_id')))->with(['success1'=>'successfully deleted']);
    }
}
