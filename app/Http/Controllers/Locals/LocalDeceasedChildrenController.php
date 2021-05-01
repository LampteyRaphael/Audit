<?php

namespace App\Http\Controllers\Locals;

use App\Http\Controllers\Controller;
use App\Locals;
use App\Transfer;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalDeceasedChildrenController extends Controller
{
    //finding deceased children at the local level
    public function index(){


            //showing non active users
            $id=Auth::user()->local_id;

            $users=User::where('local_id',$id)->where('is_active',3)
                ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
                ->where('officeHeld','=','children ministry')->GetLatest();


        return view('locals.children.nonactive.create',compact('users'));
    }

    public function index2(){
        //showing non active users
        $id=Auth::user()->local_id;

        $users = User::where('local_id', $id)->where('members_id','NOT LIKE','%'.Auth::user()->local->local_code.'%')->whereIn('role_id',[1,2,3,4,5])
            ->where('is_active', 1)->GetLatest();

        return view('locals.transfer.index',compact('users'));
    }

    public function index3(){

        $users=Transfer::where('to_local',Auth::user()->local_id)->GetLatest();

        return view('locals.transfer.release',compact('users'));
    }

}
