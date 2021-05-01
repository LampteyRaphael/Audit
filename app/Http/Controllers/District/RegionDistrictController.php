<?php

namespace App\Http\Controllers\District;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRegisterMembersRequest;
use App\Http\Requests\LocalsRequest;
use App\Http\Requests\LocalsUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
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

class RegionDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //selecting district of a particular region
        $id=Auth::user()->area_id;
        $region=Auth::user()->region->name;
        $areaName=Auth::user()->area->name;
        $districts=District::where('area_id',$id)->orderBy('created_at','desc')->paginate(20);
        $districtCount=$districts->count();
        $districtCount2=District::count();
        return view('districts.index',compact('districts','districtCount2','districtCount','region','areaName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $district_id=Auth::user()->district_id;

        $region_id=Auth::user()->region_id;

        $area_id=Auth::user()->area_id;

        $districts=District::where('id',$district_id)->pluck('name','id')->all();

//        $district_id2=District::where('area_id',$area_id)->pluck('id')->all();

        $locals=Locals::where('district_id',$district_id)->pluck('name','id')->all();

        $areas=Area::where('id',$area_id)->pluck('name','id')->all();

        $regions=Region::where('id',$region_id)->pluck('name','id')->all();

        $languages=LanguagesInGhana::orderBy('name','asc')->pluck('name','name')->all();

        $roles = Role::whereIn('id',[4,5])->pluck('name','id')->all();
        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();


        return view('districts.create',compact('home_regions','languages','roles','locals','districts','regions','areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocalsRequest $request)
    {
        //locals creating at the district level
        //
        Locals::create($request->all());

        return redirect()->back()->with(['success' => 'Successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //at the district level showing individual locals
        try{
        $district=District::where('id',$id)->where('id',Auth::user()->district_id)->firstOrFail();

        $locals=Locals::where('district_id','=', $district->id)->GetLatest();

        $localsCount=Locals::GetLatest()->where('district_id','=', $district->id)->count();

        $countDistrict=$locals->count();

        Session(['anotherDistrict_id'=>$district->id]);

        }catch (ModelNotFoundException $exception){

            return back()->withError('District not found by ID ' . $id)->withInput();
        }
        return view('districts.show',compact('district','locals','countDistrict','localsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
     try{
        $district_id=Auth::user()->district_id;

        $region_id=Auth::user()->region_id;

        $area_id=Auth::user()->area_id;

        $user=User::where('id',$id)->where('district_id',$district_id)->firstOrFail();
        $locals=Locals::where('district_id',$district_id)->pluck('name','id');
        $districts=District::where('id',$district_id)->pluck('name','id');
        $areas=Area::where('id',$area_id)->pluck('name','id');
        $regions=Region::where('id',$region_id)->pluck('name','id');
        $roles = Role::whereIn('id',[3,4,5])->pluck('name','id');
        $languages= LanguagesInGhana::GetLatest();

        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        $Adminsroles=Role::pluck('name','id');

        $specialAdmins=Role::whereIn('id',[10,11,12])->pluck('name','id');

        }catch (ModelNotFoundException $exception){

         return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return view('districts.transfer',compact('specialAdmins','Adminsroles','user','roles','locals','districts','regions','areas','home_regions','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try{
            $district_id=Auth::user()->district_id;
        $user=User::where('id',$id)->where('district_id',$district_id)->firstOrFail();
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

            $user->update($input);

            $audit=new AuditTrail();

            $audit->local_id=Auth::user()->local_id;
            $audit->category=$request['name'] .' '. '/Updated';
            $audit->user_id=Auth::user()->id;
            $audit->save();
        }
        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return redirect()->route('addnew.index')->with(['success1'=>'successfully updated ' . ' '.' '. $request['name']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        $user = User::findOrFail($id);
        if (!empty($user->photo)) {
            if (file_exists($user->photo->file)) {
                unlink(public_path() . $user->photo->file);
            }
        }

        $user->delete();
        $audit=new AuditTrail();

        $audit->local_id=Auth::user()->local_id;
        $audit->category=$user->name.' '. '/Deleted';
        $audit->user_id=Auth::user()->id;
        $audit->save();

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return redirect()->route('addnew.index')->with(['success'=>'successfully deleted' . ' '.' '. $user->name]);

    }

}
