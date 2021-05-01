<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\Region;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnonymousAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $users=User::whereIn('role_id',[6,7,8,9,10,11,12])->GetLatest();

        return view('headquarters.anonymouse.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        //editing admin users page
        $user=User::findOrFail($id);

        $locals=Locals::orderBy('name','asc')->pluck('name','id');

        $districts=District::orderBy('name','asc')->pluck('name','id');

        $areas=Area::orderBy('name','asc')->pluck('name','id');

        $regions=Region::orderBy('name','asc')->pluck('name','id');

        $roles = Role::orderBy('name','asc')->pluck('name','id');

        // Session::flash('deleted_user','Welcome to edit page');
        $languages=LanguagesInGhana::pluck('name','name')->all();
        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        return view('headquarters.anonymouse.edit',compact('user','locals','districts','areas','regions','roles','languages','regions','home_regions'));
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
        if (($request['password']=="")){

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

            $string="";
            foreach ($request->get('languagess') as $value){
                $string .= $value.',';
            }
            $input['languagess']=$string;
            $user->update($input);
            $audit=new AuditTrail();

            $audit->local_id=Auth::user()->local_id;
            $audit->category=$request['name'].' '. '/Updated';
            $audit->user_id=Auth::user()->id;
            $audit->save();

        }elseif ($request['password'] !=""){

            $input = $request->all();

            if ($file = $request->file('photo_id')){

                $name = time() . $file->getClientOriginalName();

                $file->move('images/', $name);

                $photo = Photo::create(['file' => $name]);

                $input['photo_id'] = $photo->id;
            }
            $input['password'] = bcrypt($request->password);

            $string="";
            foreach ($request->get('languagess') as $value){
                $string .= $value.',';


            }
            $input['languagess']=$string;
            $user->update($input);

            $audit=new AuditTrail();

            $audit->local_id=Auth::user()->local_id;
            $audit->category=$request['name'] .' '. '/Updated';
            $audit->user_id=Auth::user()->id;
            $audit->save();

        }

        return redirect()->route('Anonymous.index')->with(['success1'=>'Successfully Updated']);
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
