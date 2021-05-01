<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\nationalUpdateRequest;
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

class AdminEditUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //calling all the non active members across the country
        if ($request->ajax()) {
            $data =User::where('is_active',0)->get();
            return Datatables::of($data)

                ->EditColumn('name', function($data){
                    $name=strtoupper( $data->name? $data->name:'');
                    return $name;
                })

                ->addColumn('actionA', function($data){
                    $Mids=strtoupper( $data->role? $data->role->name: 'User has no role');
                    return $Mids;
                })

                ->addColumn('actionG',function ($data){
                    $district=strtoupper($data->district? $data->district->name:'');
                    return $district;
                })

                ->addColumn('action3',function ($data){
                    $local=strtoupper($data->local? $data->local->name:'');
                    return $local;
                })

                ->addColumn('action4',function ($data){
                    $role=strtoupper($data->is_active==1? 'Active':'Not Active');
                    return $role;
                })

                ->addColumn('datesOfBirth',function ($data){
                    $age=Carbon::parse($data->birthDate)->age;
                    return $age;
                })

                ->addColumn('action', function($data){
                    $createdAt=$data->created_at->diffForHumans();
                    return $createdAt;
                })


                ->addColumn('pictures', function ($data) {
                    $url=asset($data->photo? $data->photo->file:"");
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';

                })

                ->addColumn('toShow', function($data){
                    $toshow=route('users.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('users.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="fa fa-edit"></i></a>';
                    return $deletes;
                })

                ->rawColumns(['actionA','pictures','action','delete','action3','action4','datesOfBirth','actionG','toShow'])

                ->make(true);

        }


        return view('headquarters.searchUsers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //searching for a missing member
        $users="";
        return view('headquarters.searchUsers.create',compact('users'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $user=User::findOrFail($id);

        return view('headquarters.local.users.show',compact('user'));

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
        $roles = Role::pluck('name','id');
        // Session::flash('deleted_user','Welcome to edit page');
        $languages=LanguagesInGhana::pluck('name','name')->all();

        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

        Session(['id'=> $id]);
        return view('headquarters.local.users.edit',compact('home_regions','languages','user','locals','districts','areas','regions','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(nationalUpdateRequest $request, $id)
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

        }elseif ($request['password'] !="") {

            $input = $request->all();

            if ($file = $request->file('photo_id')) {

                $name = time() . $file->getClientOriginalName();

                $file->move('images/', $name);

                $photo = Photo::create(['file' => $name]);

                $input['photo_id'] = $photo->id;
            }
            $input['password'] = bcrypt($request->password);

            $user->update($input);

            $audit = new AuditTrail();

            $audit->local_id = Auth::user()->local_id;
            $audit->category = $request['name'] . ' ' . '/Updated';
            $audit->user_id = Auth::user()->id;
            $audit->save();
        }

        return redirect()->route('locals.show',(Session::get('localAdmin_id')))->with(['success' => 'successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
        return redirect()->route('locals.show',Session::get('localAdmin_id'))->with(['success1' => 'successfully Deleted']);

    }
}
