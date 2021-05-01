<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisteredRequest;
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
use Yajra\DataTables\Facades\DataTables;

class AreaAdminsController extends Controller
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
//        area admins
        $area_id=Auth::user()->area_id;
        $areaName=Auth::user()->area->name;
        if (request()->ajax()) {
            return datatables()->collection(User::query()->where('role_id',2)->where('area_id',$area_id)->where('is_active',1)->get())

                ->addColumn('role_id', function($data){
                    $Mids=$data->role? strtoupper($data->role->name): '';
                    return $Mids;
                })

                ->addColumn('area_id',function ($data){
                    $district=$data->district? strtoupper($data->district->name):'';
                    return $district;
                })

                ->addColumn('district_id',function ($data){
                    $area=$data->district? strtoupper($data->area->name):'';
                    return $area;
                })

                ->addColumn('local_id',function ($data){
                    $local=$data->local? strtoupper($data->local->name):'';
                    return $local;
                })

                ->addColumn('is_active',function ($data){
                    $role=$data->is_active==1? strtoupper('Active'):strtoupper('Not Active');
                    return $role;
                })

                ->addColumn('datesOfBirth',function ($data){
                    $age= Carbon::parse(date("Y-m-d", strtotime($data->birthDate)))->age;
                    return $age;
                })

                ->addColumn('created_at', function($data){
                    $createdAt=$data->created_at->diffForHumans();
                    return $createdAt;
                })

                ->addColumn('photo_id', function ($data) {
                    $url=$data->photo? $data->photo->file :asset('images/placeholder.png');
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
                })

                ->addColumn('toShow', function($data){
                    $toshow=route('Admins.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('Admins.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $deletes;
                })
                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('area.local.areaAdmins',compact('areaName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        // district admin
        $area_id=Auth::user()->area_id;
        $areaName=Auth::user()->area->name;

        if (request()->ajax()) {
            $data=User::query()->where('role_id',3)->where('area_id',$area_id)->where('is_active',1);
            return DataTables::eloquent($data)

                ->addColumn('role_id', function($data){
                    $Mids=$data->role? strtoupper($data->role->name): '';
                    return $Mids;
                })

                ->addColumn('area_id',function ($data){
                    $district=$data->district? strtoupper($data->district->name):'';
                    return $district;
                })

                ->addColumn('district_id',function ($data){
                    $area=$data->district? strtoupper($data->area->name):'';
                    return $area;
                })

                ->addColumn('local_id',function ($data){
                    $local=$data->local? strtoupper($data->local->name):'';
                    return $local;
                })

                ->addColumn('is_active',function ($data){
                    $role=$data->is_active==1? strtoupper('Active'):strtoupper('Not Active');
                    return $role;
                })

                ->addColumn('datesOfBirth',function ($data){
                    $age= Carbon::parse(date("Y-m-d", strtotime($data->birthDate)))->age;
                    return $age;
                })

                ->addColumn('created_at', function($data){
                    $createdAt=$data->created_at->diffForHumans();
                    return $createdAt;
                })

                ->addColumn('photo_id', function ($data) {
                    $url=$data->photo? $data->photo->file :asset('images/placeholder.png');
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
                })

                ->addColumn('toShow', function($data){
                    $toshow=route('Admins.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('Admins.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $deletes;
                })
                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('area.local.districtAdmins',compact('areaName'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //local admins
        $area_id=Auth::user()->area_id;
        $areaName=Auth::user()->area->name;
        if (request()->ajax()) {
            return datatables()->collection(User::query()->where('role_id',4)->where('area_id',$area_id)->where('is_active',1)->get())

                ->addColumn('role_id', function($data){
                    $Mids=$data->role? strtoupper($data->role->name): '';
                    return $Mids;
                })

                ->addColumn('area_id',function ($data){
                    $district=$data->district? strtoupper($data->district->name):'';
                    return $district;
                })

                ->addColumn('district_id',function ($data){
                    $area=$data->district? strtoupper($data->area->name):'';
                    return $area;
                })

                ->addColumn('local_id',function ($data){
                    $local=$data->local? strtoupper($data->local->name):'';
                    return $local;
                })

                ->addColumn('is_active',function ($data){
                    $role=$data->is_active==1? strtoupper('Active'):strtoupper('Not Active');
                    return $role;
                })

                ->addColumn('datesOfBirth',function ($data){
                    $age= Carbon::parse(date("Y-m-d", strtotime($data->birthDate)))->age;
                    return $age;
                })

                ->addColumn('created_at', function($data){
                    $createdAt=$data->created_at->diffForHumans();
                    return $createdAt;
                })

                ->addColumn('photo_id', function ($data) {
                    $url=$data->photo? $data->photo->file :asset('images/placeholder.png');
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
                })

                ->addColumn('toShow', function($data){
                    $toshow=route('Admins.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('Admins.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $deletes;
                })
                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('area.local.localAdmins',compact('areaName'));

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

            $region_id=Auth::user()->region_id;


            $area_id=Auth::user()->area_id;

            $districts=District::where('area_id',$area_id)->pluck('name','id');

            $districtId=District::where('area_id',$area_id)->pluck('id');

            $locals=Locals::whereIn('district_id',$districtId)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();

            $regions=Region::where('id',$region_id)->pluck('name','id');

            $roles = Role::whereIn('id',[3,4,5])->pluck('name','id')->all();

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

            $Adminsroles=Role::pluck('name','id');

            $specialAdmins=Role::whereIn('id',[3,4,5,10,11,12])->pluck('name','id');

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();

        }

        return view('area.local.areaAdminShow',compact('specialAdmins','Adminsroles','user','locals','districts','areas','regions','roles','languages','home_regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRegisteredRequest $request, $id)
    {
        //updating Admins
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

        return redirect()->route('Admins.index')->with(['success1'=>'Successfully Updated']);
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
