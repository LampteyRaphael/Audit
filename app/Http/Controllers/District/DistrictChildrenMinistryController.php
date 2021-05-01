<?php

namespace App\Http\Controllers\District;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictChildrenRegisteredRequest;
use App\Http\Requests\DistrictUpdateChildrenRequest;
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

class DistrictChildrenMinistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $id=Auth::user()->district_id;

            $locals_id=Locals::where('district_id',$id)->pluck('id');

            $data = User::whereIn('local_id', $locals_id)->whereIn('role_id',[1,2,3,4,5])
                ->where('is_active', 1)->where('officeHeld','children ministry')->get();
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
                    $toshow = route('DistCMinistry.edit', $data->id);
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
                    $toshow = route('DistCMinistry.edit', $data->id);
                    $btn = '<a onclick="return ConfirmUpdate()" class="btn btn-primary btn-xs" href="' . $toshow . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actionA', 'pictures', 'actionB', 'actionC', 'actionD', 'actionE', 'actionF', 'edit'])->make(true);
        }

        return view('districts.ministry.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $district_id=Auth::user()->district_id;

        $region_id=Auth::user()->region_id;

        $area_id=Auth::user()->area_id;

        $districts=District::where('id',$district_id)->pluck('name','id')->all();

        $locals=Locals::where('district_id',$district_id)->pluck('name','id')->all();

        $areas=Area::where('id',$area_id)->pluck('name','id')->all();

        $regions=Region::where('id',$region_id)->pluck('name','id')->all();

        $languages=LanguagesInGhana::orderBy('name','asc')->pluck('name','name')->all();

        $roles = Role::whereIn('id',[5])->pluck('name','id')->all();
        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        return  view('districts.ministry.create',compact('home_regions','languages','roles','locals','districts','regions','areas'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DistrictChildrenRegisteredRequest $request)
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

                $input['password']=bcrypt($request['local_id']);

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
        return redirect()->route('DistCMinistry.index')->with(['success1' => 'Successfully created']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {

            $id=Auth::user()->district_id;

            $locals_id=Locals::where('district_id',$id)->pluck('id');

            $data = User::whereIn('local_id', $locals_id)->whereIn('role_id',[1,2,3,4,5])
                ->where('is_active', 3)->where('officeHeld','=','children ministry')->get();
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
                    $toshow = route('DistCMinistry.edit', $data->id);
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
                    $toshow = route('DistCMinistry.edit', $data->id);
                    $btn = '<a onclick="return ConfirmUpdate()" class="btn btn-primary btn-xs" href="' . $toshow . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actionA', 'pictures', 'actionB', 'actionC', 'actionD', 'actionE', 'actionF', 'edit'])->make(true);
        }

        return view('districts.ministry.deceased');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
       $user=User::findOrFail($id);
            //$user=User::->where('id',$id)->where('officeHeld','children ministry')->first();

            $district_id=Auth::user()->district_id;

        $region_id=Auth::user()->region_id;

        $area_id=Auth::user()->area_id;

        $districts=District::where('id',$district_id)->pluck('name','id')->all();

//        $district_id2=District::where('area_id',$area_id)->pluck('id')->all();

        $locals=Locals::where('district_id',$district_id)->pluck('name','id')->all();

        $areas=Area::where('id',$area_id)->pluck('name','id')->all();

        $regions=Region::where('id',$region_id)->pluck('name','id')->all();

        $languages=LanguagesInGhana::orderBy('name','asc')->pluck('name','name')->all();

        $roles = Role::whereIn('id',[5])->pluck('name','id')->all();
        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();
    }catch (ModelNotFoundException $exception){

    return back()->withError('User not found by ID ' . $id)->withInput();
}

        return view('districts.ministry.edit',compact('user','districts','locals','regions','areas','languages','roles','home_regions'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictUpdateChildrenRequest $request, $id)
    {
        try{
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
        return redirect()->route('DistCMinistry.index')->with(['success1' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {

            $user=User::findOrFail($id);
            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;

            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');
            $roles = Role::where('id',$user->role_id)->pluck('name','id');

            $languages= LanguagesInGhana::GetLatest();

            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();
        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return redirect()->route('DistCMinistry.index')->with(['success1'=>'Successfully Deleted']);

    }
}
