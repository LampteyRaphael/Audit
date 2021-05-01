<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AreaExpenditure;
use App\AreaIncome;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaExpenditureRequest;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\Region;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaAreaPostController extends Controller
{
    //

    public function post(AreaExpenditureRequest $request){

        $post=$request->all();

        AreaExpenditure::create($post);

        return redirect()->back()->with(['success1'=>'Successfully Posted. Thank you']);
    }

    public function store(AreaExpenditureRequest $request){

        $post=$request->all();

        AreaIncome::create($post);

        return redirect()->back()->with(['success1'=>'Successfully Posted. Thank you']);
    }



    public function convert(){

        $area_id=Auth::user()->area_id;

        $district_id=District::where('area_id', $area_id  )->pluck('id');

        $id=Locals::whereIn('district_id',$district_id)->pluck('id');

        $users=User::whereIn('local_id',$id)->where('is_active',1)->where('officeHeld','new convert')->paginate(20);

        $areaName=Auth::user()->area->name;

        return view('area.local.newconvert',compact('users','areaName'));
    }



}
