<?php

namespace App\Http\Controllers\District;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRegisterMembersRequest;
use App\Locals;
use App\Photo;
use App\Region;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DistrictUpCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $district_id=Auth::user()->district_id;
            $local_id=Locals::where('district_id',$district_id)->pluck('id');

            $data = User::whereIn('local_id', $local_id)->whereIn('role_id',[1,2,3,4,5])->where('officeHeld','!=','children ministry')->where('is_active', 1)->get();

            return Datatables::of($data)
                ->addColumn('actionA', function($data){
                    $Mids= $data->members_id? $data->members_id:'';
                    return $Mids;
                })

                ->addColumn('pictures', function ($data) {
                    $url=asset($data->photo? $data->photo->file: "");
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
                })

                ->addColumn('actionB',function ($data){
                    $toshow=route('nonedit',$data->id);
                    $name='<a onclick="return ConfirmUpdate()" class="btn-link" href="'. $toshow.'">'.$data->name.'</a>';
                    return $name;
                })

                ->addColumn('actionC',function ($data){
                    $genders=strtoupper($data->gender? $data->gender:'');
                    return $genders;
                })

                ->addColumn('actionD',function ($data){
                    $datejoinchurch=strtoupper(Carbon::now()->parse(str_replace('/','-',$data->datejoinchurch))->diff(Carbon::now())
                        ->format('%y years,%m months,%d days'));
                    return $datejoinchurch;
                })

                ->addColumn('actionE',function ($data){
                    $officeHelds=strtoupper($data->officeHeld ? $data->officeHeld:'');
                    return $officeHelds;
                })

                ->editColumn('actionF',function ($data){
                    $dateofb=Carbon::parse($data->birthDate)->age;
                    return $dateofb;
                })

                ->addColumn('edit', function($data){
                    $toshow=route('nonedit',$data->id);
                    $btn= '<a onclick="return ConfirmUpdate()" class="btn btn-primary btn-xs" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

//                ->addColumn('delete',
//                    function ($data) {
//                        $dataDeletes = route('addnew.destroy', $data->id);
//
//                        $deletes = '<form  method="DELETE" action="' . $dataDeletes . '">
//                           echo csrf_field()
//                      <button onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="fa fa-edit"></i></button>
//
//                    </form>>
//                    ';
//                        return $deletes;
//                    })

                ->rawColumns(['actionA','pictures', 'actionB', 'actionC', 'actionD','actionE','actionF','edit'])->make(true);
        }

        return view('districts.allmembers');
//        $children = [];
//        foreach ($users as $user) {
//
//            if (Carbon::parse($user->birthDate)->age <= 15) {
//
//                $children[] = $user;
//            }
//        }
//
//        $countUsers = User::where('is_active',1)->whereIn('local_id',$local_id)->whereIn('role_id',[1,2,3,4,5])->count();
//
//        $male = User::where('is_active',1)->whereIn('local_id',$local_id)->whereIn('role_id',[1,2,3,4,5])->where('gender','male')->count();
//
//        $female =User::where('is_active',1)->whereIn('local_id',$local_id)->whereIn('role_id',[1,2,3,4,5])->where('gender','female')->count();
//
//        $member =User::where('is_active',1)->whereIn('local_id',$local_id)->whereIn('role_id',[1,2,3,4,5])->count();
//        //summary of all the levels
//        $elder=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','elder')->whereIn('role_id',[1,2,3,4,5])->count();
//        $deacon=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','deacon')->whereIn('role_id',[1,2,3,4,5])->count();
//        $deaconess=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','deaconess')->whereIn('role_id',[1,2,3,4,5])->count();
//        $pastors=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','pastor')->whereIn('role_id',[1,2,3,4,5])->count();
//        $presiding=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','presiding elder')->whereIn('role_id',[1,2,3,4,5])->count();
//        $apostles=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','apostle')->whereIn('role_id',[1,2,3,4,5])->count();
//        $newConvertTotals=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','new convert')->whereIn('role_id',[1,2,3,4,5])->count();

//        Session(['locals_back_ids' => $id]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //creating all church members
        // $roles=Role::pluck('name','id')->all();
        $locals=Locals::pluck('name','id')->all();
        $districts=District::pluck('name','id')->all();
        $areas=Area::pluck('name','id')->all();
        $regions=Region::pluck('name','id')->all();

        return view('districts.create',compact('roles','locals','districts','areas','regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DistrictRegisterMembersRequest $request)
    {
      try{
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

         $local_id= $input['local_id'];

        $membershipp=Locals::where('id',$local_id)->get(['local_code']);

        foreach ($membershipp as $membershipIdd) {

            $membershipId = $membershipIdd->local_code;
        }

       $input['members_id']=trim($membershipId.$request->members_id);

        User::create($input);
    }else {
        return back()->withError('Member by ID ' . $id .' Already Exist')->withInput();
    }

  }catch (ModelNotFoundException $exception){

    return back()->withError('Sorry Local not found' .$input)->withInput();
  }
        return redirect()->route('addnew.index')->with(['success1' => 'Successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $district_id = Auth::user()->district_id;
            $local_id = Locals::where('district_id', $district_id)->pluck('id');
            $data = User::whereIn('local_id', $local_id)->whereIn('role_id',[1,2,3,4,5])->where('officeHeld','!=','children ministry')->where('is_active', 0)->get();
            return Datatables::of($data)
                ->addColumn('actionA', function ($data) {
                    $Mids = $data->members_id ? $data->members_id : '';
                    return $Mids;
                })
                ->addColumn('pictures', function ($data) {
                    $url = asset($data->photo ? $data->photo->file : "");
                    return '<img class="img-rounded" height="50" width="50" src="' . $url . '" alt="">';
                })
                ->addColumn('actionB', function ($data) {
                    $toshow = route('nonedit', $data->id);
                    $name = '<a onclick="return ConfirmUpdate()" class="btn-link" href="' . $toshow . '">' . $data->name . '</a>';
                    return $name;
                })
                ->addColumn('actionC', function ($data) {
                    $genders = strtoupper($data->gender ? $data->gender : '');
                    return $genders;
                })
                ->addColumn('actionD', function ($data) {
                    $datejoinchurch = strtoupper(Carbon::now()->parse(str_replace('/', '-', $data->datejoinchurch))->diff(Carbon::now())
                        ->format('%y years,%m months,%d days'));
                    return $datejoinchurch;
                })
                ->addColumn('actionE', function ($data) {
                    $officeHelds = strtoupper($data->officeHeld ? $data->officeHeld : '');
                    return $officeHelds;
                })
                ->editColumn('actionF', function ($data) {
                    $dateofb = Carbon::parse($data->birthDate)->age;
                    return $dateofb;
                })
                ->addColumn('edit', function ($data) {
                    $toshow = route('nonedit', $data->id);
                    $btn = '<a onclick="return ConfirmUpdate()" class="btn btn-primary btn-xs" href="' . $toshow . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actionA', 'pictures', 'actionB', 'actionC', 'actionD', 'actionE', 'actionF', 'edit'])->make(true);
        }

        return view('districts.noneactive');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $district_id = Auth::user()->district_id;
            $local_id = Locals::where('district_id', $district_id)->pluck('id');
            $data = User::whereIn('local_id', $local_id)->whereIn('role_id',[1,2,3,4,5])->where('officeHeld','!=','children ministry')->where('is_active',3)->get();
            return Datatables::of($data)
                ->addColumn('actionA', function ($data) {
                    $Mids = $data->members_id ? $data->members_id : '';
                    return $Mids;
                })
                ->addColumn('pictures', function ($data) {
                    $url = asset($data->photo ? $data->photo->file : "");
                    return '<img class="img-rounded" height="50" width="50" src="' . $url . '" alt="">';
                })
                ->addColumn('actionB', function ($data) {
                    $toshow = route('nonedit', $data->id);
                    $name = '<a onclick="return ConfirmUpdate()" class="btn-link" href="' . $toshow . '">' . $data->name . '</a>';
                    return $name;
                })
                ->addColumn('actionC', function ($data) {
                    $genders = strtoupper($data->gender ? $data->gender : '');
                    return $genders;
                })
                ->addColumn('actionD', function ($data) {
                    $datejoinchurch = strtoupper(Carbon::now()->parse(str_replace('/', '-', $data->datejoinchurch))->diff(Carbon::now())
                        ->format('%y years,%m months,%d days'));
                    return $datejoinchurch;
                })
                ->addColumn('actionE', function ($data) {
                    $officeHelds = strtoupper($data->officeHeld ? $data->officeHeld : '');
                    return $officeHelds;
                })
                ->editColumn('actionF', function ($data) {
                    $dateofb = Carbon::parse($data->birthDate)->age;
                    return $dateofb;
                })
                ->addColumn('edit', function ($data) {
                    $toshow = route('nonedit', $data->id);
                    $btn = '<a onclick="return ConfirmUpdate()" class="btn btn-primary btn-xs" href="' . $toshow . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actionA', 'pictures', 'actionB', 'actionC', 'actionD', 'actionE', 'actionF', 'edit'])->make(true);
        }

        return view('districts.deceasedmembers');
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

        return redirect()->back()->with(['success1'=>'Successfully Deleted']);

    }
}
