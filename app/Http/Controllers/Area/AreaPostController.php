<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AreaPost;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictUpdateRequest;
use App\Http\Requests\UsersRequest;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\Region;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AreaPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // showing district at the area level
        $id=Auth::user()->area_id;

        $areaName=Auth::user()->area->name;

        $districts=District::where('area_id',$id)->GetLatest();

        $countArea=$districts->count();

        Session(['area_id'=>$id]);

        return view('area.index',compact('areaName','districts','countArea','id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        try{
            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;

            $districtsId=District::where('area_id',$area_id)->pluck('id');
            $locals=Locals::whereIn('district_id',$districtsId)->pluck('name','id');
            $districts=District::where('area_id',$area_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');

            $roles = Role::whereIn('id',[3,4,5])->pluck('name','id')->all();


            $membership=Locals::where('id',$local_id)->pluck('local_code');

            foreach ($membership as $membershipId) {
                $membershipId;
            }

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();
            $membershipId="";
            $user="";

        }catch (ModelNotFoundException $exception){

            return back()->withError('Sorry Local not found' .$local_id)->withInput();
        }

        return view('area.create',compact('membershipId','languages','roles','locals','areas','regions','home_regions',

            'locals','districts','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request)
    {
        //storing of users information

        $localCode=Locals::where('id',$request['local_id'])->pluck('local_code');

        foreach ($localCode as $localCodes){

          $id= trim($localCodes.$request['members_id']);

        }

        $user=User::where('members_id',$id)->where('local_id',$request['local_id'])->count();

        if ($user==null){

        $input =$request->all();

        if ($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo =Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;
        }

        $input['password']=bcrypt($request->password);

        $membershipp=Locals::where('id',$request->local_id)->get(['local_code']);

        foreach ($membershipp as $membershipIdd) {

            $membershipId = $membershipIdd->local_code;
        }

        $input['members_id']=$membershipId.$request->members_id;

        User::create($input);

        $audit=new AuditTrail();

        $audit->local_id=Auth::user()->local_id;

        $audit->category='Registered'. '/'.$request['name'];

        $audit->user_id=Auth::user()->id;

        $audit->save();

        }else {
            return back()->withError('Member by ID ' . $id .' Already Exist')->withInput();
        }

        return redirect()->route('areamembers.index')->with(['success1'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AreaPost  $areaPost
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try{

        $district=District::where('id',$id)->where('area_id',Auth::user()->area_id)->firstOrFail();

        $locals=Locals::where('district_id',$district->id)->GetLatest();

        $countDistrict=$locals->count();

        Session(['district_id'=>$district->id]);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }
        return view('area.show',compact('district','locals','countDistrict'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AreaPost  $areaPost
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //updating the district level
        try{
        $district=District::findOrFail($id);

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }

        return  view('area.edit',compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AreaPost  $areaPost
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictUpdateRequest $request, $id)
    {
        //
   try{
        $user=District::findOrFail($id);

        $input=$request->all();

        $user->update($input);

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return redirect()->route('level.index')->with(['success1'=>'successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AreaPost  $areaPost
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        try{

        $district=District::findOrFail($id);

        $district->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }

        return redirect()->route('level.index')->with(['success1'=>'successfully deleted']);
    }
}
