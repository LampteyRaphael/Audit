<?php
namespace App\Http\Controllers\National;
use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\Region;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AdminUsersController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->eloquent(User::query()->where('role_id',1))

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
                    $toshow=route('users.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('users.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="fa fa-trash"></i></a>';
                    return $deletes;
                })

                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('headquarters.admin.users.index');
    }

    public function create()
    {
        $roles=Role::pluck('name','id')->all();

        $locals=Locals::pluck('name','id')->all();

        $districts=District::pluck('name','id')->all();

        $areas=Area::pluck('name','id')->all();

        $regions=Region::pluck('name','id')->all();
        $membershipId="";
        $languages=LanguagesInGhana::pluck('name','name')->all();

        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        $user="";

        return view('headquarters.admin.users.create',compact(
            'user','home_regions','membershipId','languages','roles','locals','districts','areas','regions'));
    }

    public function store(UsersRequest $request)
    {
        //storing of users information

        $localCode=Locals::where('id',$request['local_id'])->pluck('local_code')->first();

        $id= trim($localCode.$request['members_id']);

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

            $input['members_id']=$localCode.$request->members_id;

            User::create($input);

            $audit=new AuditTrail();

            $audit->local_id=Auth::user()->local_id;

            $audit->category='Registered'. '/'.$request['name'];

            $audit->user_id=Auth::user()->id;

            $audit->save();

        }else {
            return back()->withError('Member by ID ' . $id .' Already Exist')->withInput();
        }

        return redirect('admin/users/')->with(['success'=>'Successfully Created']);
    }


    public function show($id)
    {
        return view('headquarters.admin.users.show');
    }


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
        $membershipId="";

        return view('headquarters.admin.users.edit',compact(
            'membershipId','home_regions','user','languages','roles','locals','districts','regions','areas'));
    }

    public function update(Request $request, $id)
    {
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

        return redirect('admin/users/')->with(['success1'=>'Successfully Updated']);
    }

    public function destroy($id)
    {
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

        return redirect()->back()->with(['success1'=>'Successfully Deleted']);
    }
}
