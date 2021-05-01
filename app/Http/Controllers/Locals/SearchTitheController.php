<?php

namespace App\Http\Controllers\Locals;

use App\Http\Controllers\Controller;
use App\PostTithe;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchTitheController extends Controller
{
    public function search(Request $request)
    {
        try{
         $search=$request['search'];

        $local_code=Auth::user()->local->local_code.$search;

        $user = User::where('is_active',1)->where('local_id',Auth::user()->local_id)
            ->where('members_id', 'LIKE', '%' . $local_code. '%')
            ->orwhere('name', 'LIKE', '%' .$search . '%')->where('local_id',Auth::user()->local_id)->where('is_active',1)
            ->orwhere('email', 'LIKE', '%' . $search . '%')->where('local_id',Auth::user()->local_id)->where('is_active',1)
            ->pluck('name','id')->all();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Can\'t find ' . $request['search'])->withInput();
        }
        return view('members.create',compact('user'));
    }

}
