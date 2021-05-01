<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AreaCircular;
use App\AreaLevelCircular;
use App\AuditTrail;
use App\District;
use App\DistrictCircular;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\Region;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AreaUsersUpdatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index()
    {
        //circulating circular to the area level
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $post=AreaCircular::whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->get();
        return view('area.nationalCircular',compact('post','month','year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //calling announcement from the area level
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $post=AreaLevelCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->where('area_id',Auth::user()->area_id)->orderBy('created_at','desc')->get();
        return view('area.areaCircular',compact('post','month','year','month','year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $post=AreaCircular::orderBy('created_at','desc')
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->get();
        return view('area.nationalCircular',compact('post','month','year'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try{
        //selecting all the users
        $user=User::findOrFail($id);
        }catch (ModelNotFoundException $exception){

      return back()->withError('User not found by ID ' . $id)->withInput();
     }
        return view('area.local.members',compact('user'));
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
            $user=User::where('id',$id)->where('area_id',Auth::user()->area_id)->firstOrFail();

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

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','asc')->pluck('name','name')->all();

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }

        return view('area.local.update',compact('home_regions','user','languages','roles','locals','districts','regions','areas'));
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
            $user=User::where('id',$id)->where('area_id',Auth::user()->area_id)->firstOrFail();
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
        return redirect()->route('areamembers.index')->with(['success1'=>'Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
            $user = User::where('id',$id)->where('area_id',Auth::user()->area_id)->firstOrFail();
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


        return redirect()->route('areamembers.index')->with(['success1'=>'Successfully Deleted']);
    }
}
