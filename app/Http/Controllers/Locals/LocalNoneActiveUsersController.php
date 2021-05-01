<?php

namespace App\Http\Controllers\Locals;

use App\AuditTrail;
use App\DonationAndPledge;
use App\ErrorLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\BulkPostRequest;
use App\Http\Requests\PostTitheRegisterRequest;
use App\Locals;
use App\LocalSMS;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Yajra\DataTables\Facades\DataTables;
use const Exception;

class LocalNoneActiveUsersController extends Controller
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
        //showing non active users
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
        try{
        $id=Auth::user()->local_id;

        $users=User::where('local_id','=',$id)
            ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('officeHeld','!=','children ministry')
            ->where('is_active',0)->GetLatest();

          $usersCount= User::where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
                ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
                ->where('is_active', 0)->where('officeHeld','!=','children ministry')
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

        Session(['locals_back_id'=>$id]);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }





//        if ($request->ajax()) {
//            $data =User::where('local_id','=',$id)->where('is_active',0)
//                ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
//                ->where('officeHeld','!=','children ministry')
//                ->where('is_active',0)->get();
//
//            return Datatables::of($data)
//
//                ->addColumn('actionA', function($data){
//
//                    $Mids= $data->members_id;
//
//                    return $Mids;
//                })
//
//                ->addColumn('actionG',function ($data){
//
//                    $genders=strtoupper($data->gender);
//
//                    return $genders;
//                })
//
//                ->addColumn('action3',function ($data){
//
//                    $datejoinchurch=strtoupper(Carbon::now()->parse(str_replace('/','-',$data->datejoinchurch))->diff(Carbon::now())
//
//                        ->format('%y years,%m months,%d days'));
//
//                    return $datejoinchurch;
//                })
//
//                ->addColumn('action4',function ($data){
//
//                    $officeHelds=strtoupper($data->officeHeld);
//
//
//                    return $officeHelds;
//                })
//
//                ->addColumn('datesOfBirth',function ($data){
//
//                    $dateofb=Carbon::parse($data->birthDate)->age;
//
//                    return $dateofb;
//                })
//
//                ->addColumn('action', function($data){
//
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
//
//                ->addColumn('pictures', function ($data) {
//
//                    $url=asset($data->photo_id);
//                    $imagess= '<img class="img-rounded" height="50" width="50" src='.$url.'>';
//
//                    return $imagess;
//                })
//
//
//                ->rawColumns(['actionA','pictures','action','delete','action3','action4','datesOfBirth','actionG'])
//
//                ->make(true);
//
//        }




        return view('locals.nonactive.index',compact('users','countUsers','male','female','deacon','deaconess','elder'
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $id=Auth::user()->local_id;

        $users=User::where('local_id','=',$id)
            ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->where('officeHeld','!=','children ministry')
            ->where('is_active',3)->GetLatest();


       $usersCount = User::where('local_id', $id)->whereIn('role_id',[1,2,3,4,5])
                ->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
                ->where('is_active',3)->where('officeHeld','!=','children ministry')
                ->get();

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

    Session(['locals_back_id'=>$id]);

        return view('locals.nonactive.create',compact('users','countUsers','male','female','deacon','deaconess','elder'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BulkPostRequest $request)
    {

            if ($request->amount == [null]) {

                return back()->withError('Amount Field is Required')->withInput();
            } else {
                for ($i = 0; $i < count($request->amount); $i++) {

                    $post = new PostTithe();

                    $post->amount = $request->amount[$i];

                    $id = Auth::user()->local->local_code . $request->user_id[$i];

                    $user = User::where('local_id', Auth::user()->local_id)->where('members_id', $id)->pluck('id')->first();


                    if (empty($user)) {

                        $post->user_id = '9999';

                    } else {
                        $post->user_id = $user;

                    }

                    $post->modeOfPayment = 1;

                    $post->local_id = Auth::user()->local_id;
                    $post->save();

                }
            }
            return redirect()->back()->with(['success1'=>'Successfully Posted Bulk Tithe']);
}







    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //showing new convert
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
        try{
        $id=Auth::user()->local_id;

        $localName=Locals::findOrFail($id);

        $users=User::where('local_id',$id)->where('officeHeld','new convert')->where('officeHeld','!=','children ministry')
            ->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
            ->GetLatest();

        $usersCount= User::where('local_id',$id)->where('officeHeld','new convert')->where('officeHeld','!=','children ministry')
            ->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
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

         }catch (ModelNotFoundException $exception){

                 return back()->withError('User not found by ID ' .$id)->withInput();
          }


//
//        if ($request->ajax()) {
//            $data =User::where('local_id',$id)->where('officeHeld','new convert')->where('officeHeld','!=','children ministry')
//            ->where('is_active',1)->where('members_id','LIKE','%'.Auth::user()->local->local_code.'%')
//            ->get();
//
//            return Datatables::of($data)
//
//                ->addColumn('actionA', function($data){
//
//                    $Mids= $data->members_id;
//
//                    return $Mids;
//                })
//
//                ->addColumn('actionG',function ($data){
//
//                    $genders=strtoupper($data->gender);
//
//                    return $genders;
//                })
//
//                ->addColumn('action3',function ($data){
//
//                    $datejoinchurch=strtoupper(Carbon::now()->parse(str_replace('/','-',$data->datejoinchurch))->diff(Carbon::now())
//
//                        ->format('%y years,%m months,%d days'));
//
//                    return $datejoinchurch;
//                })
//
//                ->addColumn('action4',function ($data){
//
//                    $officeHelds=strtoupper($data->officeHeld);
//
//
//                    return $officeHelds;
//                })
//
//                ->addColumn('datesOfBirth',function ($data){
//
//                    $dateofb=Carbon::parse($data->birthDate)->age;
//
//                    return $dateofb;
//                })
//
//                ->addColumn('action', function($data){
//
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
//
//                ->addColumn('pictures', function ($data) {
//
//                    $url=asset($data->photo_id);
//                    $imagess= '<img class="img-rounded" height="50" width="50" src='.$url.'>';
//
//                    return $imagess;
//                })
//
//
//                ->rawColumns(['actionA','pictures','action','delete','action3','action4','datesOfBirth','actionG'])
//
//                ->make(true);
//
//        }


        return view('locals.nonactive.show',compact('users','localName','countUsers','male','female','deacon',
            'deaconess','elder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{

        $users=DonationAndPledge::where('id',$id)->where('local_id',Auth::user()->local_id)->first();

        if (!$users){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return view('members.tithe.onlyDEdit',compact('users'));
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
        try {
            if ($request['detail'] == "") {
                return back()->withError('Reason cannot be empty')->withInput();
            } else
                $post = DonationAndPledge::findorFail($id);

            $log = new ErrorLog();
            $authName = Auth::user()->name;

            $local_id = Auth::user()->local_id;

            $log->local_id = $local_id;

            $log->name = $authName;

            if ($request['modeOfPayment'] == 1) {

                $modeOfPayment= 'Cash';

            } else if ($request['modeOfPayment'] == 2){

                $modeOfPayment = 'E-payment';

            } else if ($request['modeOfPayment'] == 3) {

                $modeOfPayment = 'cheque';
            }

            $log->details='From Donation Posted/'.' '. $modeOfPayment . "/ " . $request['detail'];

            $log->save();

            $post->update($request->all());

        }catch (ModelNotFoundException $exception){

            return back()->withError('Reason cannot be empty' . $id)->withInput();
        }

        return redirect()->route('onlyDonation')->with(['success1'=>'Successfully corrected']);

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
