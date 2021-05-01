<?php

namespace App\Http\Controllers\Individuals;

use App\Area;
use App\District;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\PostTithe;
use App\Region;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class IndividualDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //displaying the user name
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $tithe=PostTithe::where('local_id',Auth::user()->local_id)
            ->where('user_id',Auth::user()->id)
            ->whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        return view('individual.dashboard',compact('tithe','month','year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //editing admin users page
        $id=Auth::user()->id;
        $user=User::where('id',$id)->where('local_id',Auth::user()->local_id)->firstOrFail();

        $locals=Locals::orderBy('name','asc')->pluck('name','id');

        $districts=District::orderBy('name','asc')->pluck('name','id');

        $areas=Area::orderBy('name','asc')->pluck('name','id');

        $regions=Region::orderBy('name','asc')->pluck('name','id');

        $roles = Role::orderBy('name','asc')->pluck('name','id');

        // Session::flash('deleted_user','Welcome to edit page');
        $languages=LanguagesInGhana::pluck('name','name')->all();
        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        return view('individual.tithe',compact('user','locals','districts','areas','regions','roles','languages','home_regions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //displaying the user name
           $year=$request['year'];
           $month=$request['month'];
           $year=Carbon::now()->year;
           $tithe=PostTithe::where('local_id',Auth::user()->local_id)
               ->where('user_id',Auth::user()->id)
               ->whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
           return view('individual.dashboard',compact('tithe','month','year'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

   

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $user=User::findOrFail($id);

        if ((trim($request['password'])=="")){

            if (trim($request->password) ==null){

                $input = $request->except('password');

            }else {
                $input = $request->all();
            }
            if ($file = $request->file('photo_id')) {

                $name = time() . $file->getClientOriginalName();

                $file->move('images/', $name);

                $photo = Photo::create(['file' => $name]);

                $input['photo_id'] = $photo->id;

            }
            // $input['password'] = bcrypt($request->password);

            $user->update($input);

        }elseif ($request['password'] !=""){

            $input = $request->all();

            if ($file = $request->file('photo_id')){

                $name = time() . $file->getClientOriginalName();

                $file->move('images/', $name);

                $photo = Photo::create(['file' => $name]);

                $input['photo_id'] = $photo->id;
            }
            $input['password'] = bcrypt($request->password);

            $user->update($input);

        }

        return redirect()->route('IndividualProfile')->with(['success' => 'successfully Updated']);
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
