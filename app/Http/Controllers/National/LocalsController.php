<?php

namespace App\Http\Controllers\National;

use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalsRequest;
use App\Http\Requests\LocalsUpdateRequest;
use App\Locals;
use App\Photo;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class LocalsController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
//        //calling all locals
//        $locals=Locals::GetLatest();
//        $countLocals=Locals::count();
        if ($request->ajax()) {
            return DataTables::eloquent(Locals::query())
                ->addIndexColumn()
                ->addColumn('actionA', function ($region) {
                    Session(['localAdmin_id'=>$region->id]);
                    $showId = route('locals.show', $region->id);
                    $regionNames = '<a class="btn-link" href="' .$showId .'">' . $region->name . '</a>';
                    return $regionNames;
                })

                ->addColumn('actionB', function ($region) {

                    return $male = User::where('local_id', $region->id)->where('is_active', 1)->where('gender', 'male')->count();

                })
                ->addColumn('actionC', function ($region) {

                    return $female = User::where('local_id', $region->id)->where('is_active', 1)->where('gender', 'female')->count();

                })
                ->addColumn('actionD', function ($region) {

                    return User::where('local_id', $region->id)->where('is_active', 1)->where('officeHeld', 'elder')->count();

                })
                ->addColumn('actionE', function ($region) {

                    return User::where('local_id', $region->id)->where('is_active', 1)->where('officeHeld', 'deacon')->count();

                })
                ->addColumn('actionF', function ($region) {

                    return User::where('local_id', $region->id)->where('is_active', 1)->where('officeHeld', 'deaconess')->count();

                })
                ->addColumn('actionGG', function ($region) {

                    return User::where('local_id', $region->id)->where('officeHeld', 'children ministry')->where('is_active', 1)->count();

                })
                ->addColumn('actionPastor', function ($region) {

                    return User::where('local_id', $region->id)->where('officeHeld', 'pastor')->where('is_active', 1)->count();

                })
                ->addColumn('actionPresidingElders', function ($region) {

                    return User::where('local_id', $region->id)->where('officeHeld', 'presiding elder')->where('is_active', 1)->count();

                })
                ->addColumn('actionApostle', function ($region) {

                    return User::where('local_id', $region->id)->where('officeHeld', 'apostle')->where('is_active', 1)->count();

                })
                ->addColumn('actionG', function ($region) {

                    return User::where('local_id', $region->id)->where('is_active', 0)->count();

                })
                ->addColumn('actionH', function ($region) {

                    return User::where('local_id', $region->id)->where('is_active', 1)->count();

                })
                ->addColumn('actionJ', function ($region) {
                    $showIdd = route('locals.edit', $region->id);
                    return '<a class="btn btn-primary btn-xs" href="' . $showIdd . '"><i class="fa fa-edit"></i></a>';
                })
                ->addColumn('delete', function ($region) {
                    $showIdd = route('locals.edit', $region->id);
                    return '<a class="btn btn-danger btn-xs" href="' . $showIdd . '"><i class="fa fa-edit"></i></a>';
                })

                ->rawColumns(['actionA', 'actionB', 'actionC', 'actionD', 'actionE', 'actionF', 'actionGG', 'actionG', 'actionPastor', 'actionPresidingElders', 'actionApostle', 'actionH', 'actionJ', 'delete'])
                ->make(true);
        }

        return view('headquarters.local.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('headquarters.local.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocalsRequest $request)
    {

            $input =$request->all();
        if ($file=$request->file('photo1_id')){

            $name=time().$file->getClientOriginalName();

            $file->move('buildingOne',$name);

//            $photo =Photo::create(['file'=>$name]);
//
           $input['photo1_id']=$name;
        }

        if ($files=$request->file('photo2_id')){

            $names=time().$files->getClientOriginalName();

            $file->move('buildingTwo',$names);
//
//            $photo =Photo::create(['file'=>$name]);
//
           $input['photo2_id']=$names;
        }

        if ($filess=$request->file('photo3_id')){

            $namess=time().$filess->getClientOriginalName();

            $file->move('buildingThree',$namess);

//            $photo =Photo::create(['file'=>$name]);
//
            $input['photo3_id']=$namess;
        }


        Locals::create($input);

        return redirect()->back()->with(['success1' => 'Successfully created']);

    }

    /**
     * Display the specified resource.
     * 3*
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show($id)
    {
        try{

        $locals=Locals::findOrFail($id);

        $users=User::where('local_id',$id)->GetLatest();

        $countUsers=User::where('local_id',$id)
            ->where('is_active',1)->count();

        $matchM=['local_id'=>$id,'is_active'=>1,'gender'=>'male'];
        $male=User::where($matchM)->count();

        $matchF=['local_id'=>$id,'is_active'=>1,'gender'=>'female'];
        $female=User::where($matchF)->count();

        $matchD=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'deacon'];
        $deacon=User::where($matchD)->count();

        $matchDN=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'deaconess'];
        $deaconess=User::where($matchDN)->count();

        $elder= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'elder'];
        $elder=User::where($elder)->count();

        $member= $match=['local_id'=>$id,'is_active'=>1,'officeHeld'=>'member'];
        $member=User::where($member)->count();

        Session(['localAdmin_id'=> $id]);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Locals not found by ID ' . $id)->withInput();
        }
        return view('headquarters.local.show',compact('locals',

            'users','countUsers','male','female','deacon','deaconess','elder','member'
             ,'id'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try{
        $local=Locals::findOrFail($id);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Locals not found by ID ' . $id)->withInput();
        }
        return view('headquarters.local.edit',compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalsUpdateRequest $request, $id)
    {
        //updating local of the apostolic church
        try{
        $user=Locals::findOrFail($id);

        $input=$request->all();

        $user->update($input);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }
        return redirect()->route('district.show',(Session::get('district_id')))->with(['success1'=>'successfully updated']);
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
        $local=Locals::findOrFail($id);
        $local->delete();
        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }
        return redirect()->route('district.show',(Session::get('district_id')))->with(['success1'=>'successfully deleted']);
    }

}