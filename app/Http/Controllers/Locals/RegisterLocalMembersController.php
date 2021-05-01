<?php

namespace App\Http\Controllers\Locals;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class RegisterLocalMembersController extends Controller
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

    public function index(Request $request)
    {
        $countUserss=[];
        $countUsers=null;
        $males=[];
        $females=[];
        $deacons=[];
        $deaconesss=[];
        $deacon=null;
        $deaconess=null;
        $female=null;
        $male=null;
        $elders=[];
        $elder=null;
        $id = Auth::user()->local_id;
        $localName = Locals::findOrFail($id);

        $users= User::where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
            ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')->orwhere('officeHeld',null)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
            ->GetLatest();


        $usersCount = User::where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
            ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')->orwhere('officeHeld',null) ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
            ->get(['id','gender','officeHeld']);

        foreach ($usersCount as $user){

            if ($user){
                $countUserss[]=$user->id;
                $countUsers=count($countUserss);
            }

            if($user->gender ==='male'){
                $males[]=$user->gender;
                $male=count($males);
            }

            if($user->gender ==='female'){
                $females[]=$user->gender;
                $female=count($females);
            }

            if($user->officeHeld ==='deacon'){
                $deacons[]=$user->gender;
                $deacon=count($deacons);
            }

            if($user->officeHeld ==='deaconess'){
                $deaconesss[]=$user->gender;
                $deaconess=count($deaconesss);
            }

            if($user->officeHeld ==='elder'){
                $elders[]=$user->gender;
                $elder=count($elders);
            }

        }

        try{
            //registering of church members
            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;


            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');

            $roles = Role::where('id',5)->pluck('name','id')->all();

            $membership=Locals::where('id',$local_id)->pluck('local_code');

            foreach ($membership as $membershipId) {
                $membershipId;
            }

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Sorry Local not found' .$local_id)->withInput();
        }

//        if ($request->ajax()) {
//
//            $data =User::query()->where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
//                ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
//                ->where('is_active', 1)->where('officeHeld','!=','children ministry')->orwhere('officeHeld',null) ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
//                ->where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
//                ->get();
//
//            return Datatables::of($data)
//
//                ->addColumn('actionA', function($data){
//
//                    $Mids= $data->members_id?$data->members_id:'';
//
//                    return $Mids;
//                })
//
//                ->addColumn('actionG',function ($data){
//
//                    $genders=strtoupper($data->gender? $data->gender:'');
//
//                    return $genders;
//                })
//
//
//                ->addColumn('names',function ($data){
//
//                    $toshow=route('registration.show',$data->id);
//                    $name='<a onclick="return ConfirmUpdate()" class="btn-link" href="'. $toshow.'">'.$data->name.'</a>';
//                    return $name;
//                })
//
//                ->editColumn('datejoinchurch',function ($data){
//
//                    $datejoinchurch=strtoupper(Carbon::now()->parse(str_replace('/','-',$data->datejoinchurch))->diff(Carbon::now())
//
//                        ->format('%y years,%m months,%d days'));
//
//                    return $datejoinchurch;
//                })
//
//
//
////                ->addColumn('action4',function ($data){
////
////                    $officeHelds=strtoupper($data->officeHeld);
////
////
////                    return $officeHelds;
////                })
//
//                ->editColumn('birthDate',function ($data){
//
//                    $dateofb=Carbon::parse($data->birthDate)->age;
//
//                    return $dateofb;
//                })
//
//                ->addColumn('action', function($data){
//
//                    $toshow=route('registration.show',$data->id);
//
//                    $btn= '<a class="btn btn-primary btn-xs" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
//
//                    return $btn;
//                })
//
//                ->addColumn('delete',function ($data){
//
//
//                    $dataDeletes=route('registration.destroy',$data->id);
//
//                    $deletes= '<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="fa fa-edit"></i></a>';
//
//                    return $deletes;
//
//                })
//
//                ->addColumn('pictures', function ($data) {
//                    $url=asset($data->photo? $data->photo->file:"");
//                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
//                })
//
////                ->addColumn('pictures', function ($data) {
////
////                    $url=$data->photo? $data->photo->file:"";
////                        return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
////                })
//
//
//                ->rawColumns(['actionA','pictures','names','action','delete','action3','action4','datesOfBirth','actionG'])
//
//                ->make(true);
//
//        }
        return view('locals.index',compact(
            'localName','users', 'countUsers','male','female',
            'deacon','deaconess','elder',
            'home_regions','locals', 'districts','languages',
            'membershipId','areas','regions','region_id', 'areas','regions','roles','home_regions'
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        try{
            //registering of church members
            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;


            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');

            $roles = Role::where('id',5)->pluck('name','id')->all();

            $membership=Locals::where('id',$local_id)->pluck('local_code');

            foreach ($membership as $membershipId) {
                $membershipId;
            }

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Sorry Local not found' .$local_id)->withInput();
        }
        return view('locals.create',compact('home_regions','locals', 'districts','languages',
            'membershipId','areas','regions','region_id', 'areas','regions','roles','home_regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request)
    {

        $id=trim(Auth::user()->local->local_code.$request['members_id']);

        $user=User::where('members_id',$id)->where('local_id',Auth::user()->local_id)->count();

        if ($user==null){
            $input = $request->all();

            if ($file = $request->file('photo_id')) {

                $name = time() . $file->getClientOriginalName();

                $file->move('images', $name);

                $photo = Photo::create(['file' => $name]);

                $input['photo_id'] = $photo->id;
            }

            $input['password'] = bcrypt($request->password);

            $input['members_id'] = Auth::user()->local->local_code . $request->members_id;

            User::create($input);
            $audit = new AuditTrail();
            $audit->local_id = Auth::user()->local_id;
            $audit->category = 'Registered' . '/' . $request['name'];
            $audit->user_id = Auth::user()->id;
            $audit->save();

        }else {
            return back()->withError('Member by ID ' . $id .' Already Exist')->withInput();
        }
        return redirect()->back()->with(['success1' => 'Successfully created']);
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

            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;

            $user=User::where('id',$id)->where('local_id',$local_id)->firstOrFail();

            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');
            $roles = Role::where('id',$user->role_id)->pluck('name','id');

            $languages= LanguagesInGhana::latest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();
        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }

        return view('locals.show',compact('user','home_regions','languages','roles','locals','districts','regions','areas'));
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
            $local_id=Auth::user()->local_id;

            $user=User::where('id',$id)->where('local_id',$local_id)->firstOrFail();

            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');
            $roles = Role::whereIn('id',[5])->pluck('name','id')->all();

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();
            $Adminsroles=Role::pluck('name','id');
            $specialAdmins=Role::whereIn('id',[10,11,12])->pluck('name','id');

        }catch (ModelNotFoundException $exception){
            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return view('locals.edit',compact('specialAdmins','user','Adminsroles','home_regions','languages','roles','locals','districts','regions','areas'));
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
            $id=$request['id'];
            $local_id=Auth::user()->local_id;
            $user=User::where('id',$id)->where('local_id',$local_id)->firstOrFail();

            $idd=trim(Auth::user()->local->local_code.$request['members_id']);

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

                $input['members_id']=$idd;

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
                $input['members_id']=$idd;
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
        return redirect()->back()->with(['success1' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $user=User::where('id',$id)->where('local_id',Auth::user()->local_id)->firstOrFail();
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

        return response()->json(['success1'=>'Successfully Deleted']);
    }
}
