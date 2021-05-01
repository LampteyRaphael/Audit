<?php

namespace App\Http\Controllers\Locals;

use App\Area;
use App\AreaCircular;
use App\AuditTrail;
use App\District;
use App\DistrictCircular;
use App\Http\Controllers\Controller;
use App\LocalCircular;
use App\Locals;
use App\PostExpenses;
use App\Postservices;
use App\PostSunday;
use App\PostTithe;
use App\Region;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Khill\Lavacharts\Lavacharts;
use Lava;
class DashboardForLocalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->local_id;

        $january=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',1)->whereYear('created_at',Carbon::now()->year)->count();

        $febuary=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',2)->whereYear('created_at',Carbon::now()->year)->count();

        $march=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',3)->whereYear('created_at',Carbon::now()->year)->count();

        $april=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',4)->whereYear('created_at',Carbon::now()->year)->count();

        $may=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',5)->whereYear('created_at',Carbon::now()->year)->count();

        $june=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',6)->whereYear('created_at',Carbon::now()->year)->count();

        $july=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',7)->whereYear('created_at',Carbon::now()->year)->count();

        $august=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',8)->whereYear('created_at',Carbon::now()->year)->count();

        $september=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',9)->whereYear('created_at',Carbon::now()->year)->count();

        $october=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',10)->whereYear('created_at',Carbon::now()->year)->count();

        $november=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',11)->whereYear('created_at',Carbon::now()->year)->count();

        $december=User::where('is_active',1)->where('local_id',$id)->whereMonth('created_at',12)->whereYear('created_at',Carbon::now()->year)->count();



        //displaying number of regions,area,district,locals,users
        $regions=Region::count();
        $areas=Area::count();
        $districts=District::count();
        $locals=Locals::count();

        //creating pie chart for the region,area,district and local count

        $levelsCount  =	 Charts::create('donut', 'highcharts')
            ->title('Levels chart')
            ->labels(['National','Area', 'District', 'Local'])
            ->values([$regions,$areas,$districts,$locals])
            ->dimensions(1000,500)
            ->responsive(true);


        $localsAdmins=User::where('role_id',4)->where('local_id',$id)
            ->where('is_active',1)->count();
        $members=User::where('role_id',4)
            ->where('is_active',1)->count();

        //counting the number of admin
        $admins=    Charts::create('donut', 'highcharts')
            ->title('Admin For Your Local')
            ->labels(['Local Admins'])
            ->values([$localsAdmins])
            ->dimensions(100,$localsAdmins)
            ->responsive(true);

     //   $female=User::where('is_active',1)->where('gender','female')->where('local_id',$id)->count();

    //    $male=User::where('is_active',1)->where('gender','male')->where('local_id',$id)->count();

     //   $maleOrFemale=User::where('is_active',1)->where('gender','male')->where('local_id',$id)->orwhere('gender','female')->count();


        $children=[];
        $maleAboves=[];
        $femaleAboves=[];
        $femaleBetweenAgesof15to60=[];
        $maleBetweenAgesof15to60=[];
        $youths=[];
        $members=[];
        $presiding=[];
        $newConvertTotals=[];
        $elders=[];
        $deacon=[];
        $deaconess=[];
        $apostles=[];
        $pastors=[];
        $female=[];
        $male=[];
        $users=User::where('is_active',1)->where('local_id',$id)->get(['birthDate','gender','officeHeld']);

        foreach ($users as $user){

            if (Carbon::parse($user->birthDate)->age <=15){
                $children[]=$user;
            }

            if (Carbon::parse($user->birthDate)->age >60 && $user->gender==='male'){
                $maleAboves[]=$user;
            }

            if (Carbon::parse($user->birthDate)->age >=60 && $user->gender==='female'){
                $femaleAboves[]=$user;
            }

            if (Carbon::parse($user->birthDate)->age >15 && Carbon::parse($user->birthDate)->age <=60  && $user->gender==='female'){

            $femaleBetweenAgesof15to60[]=$user;
            }

            if (Carbon::parse($user->birthDate)->age >15 && Carbon::parse($user->birthDate)->age <=60 && $user->gender==='male'){

                $maleBetweenAgesof15to60[]=$user;
            }

            if (Carbon::parse($user->birthDate)->age >=20 && Carbon::parse($user->birthDate)->age <=35 ){
                $youths[]=$user;
            }

            if ($user->gender==='female'){

                $female[]=$user;
            }

            if ($user->gender==='male'){

                $male[]=$user;
            }


            if ($user->officeHeld==='elder'){
                $elders[]=$user;
            }

            if ($user->officeHeld==='deacon'){
                $deacon[]=$user;
            }

            if ($user->officeHeld==='deaconess'){
                $deaconess[]=$user;
            }

            if ($user->officeHeld==='pastor'){
                $pastors[]=$user;
            }

            if ($user->officeHeld==='presiding elder'){

                $presiding[]=$user;
            }

            if ($user->officeHeld==='apostle'){

                $apostles[]=$user;
            }


            if ($user->officeHeld==='member'){

                $members[]=$user;
            }

            if ($user->officeHeld==='new convert'){
                $newConvertTotals[]=$user;
            }


        }

        $levelsBreakdown=   Charts::create('bar', 'highcharts')
            ->title('Members')
            ->elementLabel('Members')
            ->labels(['Male Above 60', 'Female Above 60', 'Children below 15 years','Male Between 15-60','Female Between 15-60','Elders', 'Deacon', 'Deaconess', 'Pastors', 'Presiding Elders','Apostle','Church Members','New Convert'])
            ->values([count($maleAboves),count($femaleAboves),count($children),count($maleBetweenAgesof15to60),
                count($femaleBetweenAgesof15to60),count($elders),count($deacon),count($deaconess),count($pastors),
                count($presiding),count($apostles),count($members),count($newConvertTotals) ])
            ->dimensions(1000,500)
            ->responsive(true);



        //monthly population registration
        $population=    Charts::multi('areaspline', 'highcharts')
            ->title('Monthly Registered Members')
            ->elementLabel('Members')
            ->colors(['#ff0000', '#ffffff'])
            ->labels(['January','February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'])
            ->dataset('Monthly', [$january,$febuary,$march, $april, $may, $june, $july,$august,$september,$october,$november,$december]);



        $loginCount=AuditTrail::where('category','LIKE','%'.'Login'.'%')->whereYear('created_at',Carbon::now()->year)->where('local_id',$id)->count();

        $update=AuditTrail::where('category','LIKE','%'.'Updated'.'%')->whereYear('created_at',Carbon::now()->year)->where('local_id',$id)->count();

        $delete=AuditTrail::where('category','LIKE','%'.'Deleted'.'%')->whereYear('created_at',Carbon::now()->year)->where('local_id',$id)->count();

        $totalMembers=User::where('is_active',1)->where('local_id',$id)->count();

        $total=$totalMembers;

        $nonactive=User::where('is_active',0)->where('local_id',$id)->count();

        $deceased=User::where('is_active',3)->where('local_id',$id)->count();

        //total Member in the system
        $totalMembers=    Charts::create('percentage', 'justgage')
            ->title('Membership')
            ->elementLabel('Total Number')
            ->values([$totalMembers,0,$totalMembers+$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        //total Member in the system
        $maleTotal=    Charts::create('percentage', 'justgage')
            ->title('Male')
            ->elementLabel('Total Number')
            ->values([count($male),0,($total)])
            ->responsive(true)
            ->height(300)
            ->width(0);


        $femaleTotal=    Charts::create('percentage', 'justgage')
            ->title('Female')
            ->elementLabel('Total Number')
            ->values([count($female),0,$total])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $totalYouth=    Charts::create('percentage', 'justgage')
            ->title('Youth')
            ->elementLabel('Total Number')
            ->values([count($youths),0,$total])
            ->responsive(true)
            ->height(300)
            ->width(0);



        $childrenTotal=    Charts::create('percentage', 'justgage')
            ->title('Children')
            ->elementLabel('Total Number')
            ->values([count($children),0,$total])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $newConvertTotal=    Charts::create('percentage', 'justgage')
            ->title('New Convert')
            ->elementLabel('Total Number')
            ->values([count($newConvertTotals),0,$total])
            ->responsive(true)
            ->height(300)
            ->width(0);


        //creating login information
        $loginCounts=    Charts::create('percentage', 'justgage')
            ->title('Login chart')
            ->elementLabel('Login')
            ->values([$loginCount,0,$loginCount+$loginCount])
            ->responsive(true)
            ->height(400)
            ->width(0);

        //update
        $update=    Charts::create('percentage', 'justgage')
            ->title('Update chart')
            ->elementLabel('Update')
            ->values([$update,0,$loginCount+$loginCount])
            ->responsive(true)
            ->height(300)
            ->width(0);

        //delete
        $delete=    Charts::create('percentage', 'justgage')
            ->title('Delete chart')
            ->elementLabel('Delete')
            ->values([$delete,0,$delete+$delete])
            ->responsive(true)
            ->height(300)
            ->width(0);


        //creating none active  information
        $nonactive=    Charts::create('percentage', 'justgage')
            ->title('Non Active')
            ->elementLabel('Total Number')
            ->values([$nonactive,0,$total])
            ->responsive(true)
            ->height(400)
            ->width(0);

        //creating deceased information
        $deceased=    Charts::create('percentage', 'justgage')
            ->title('Deceased')
            ->elementLabel('Total Number')
            ->values([$deceased,0,$total])
            ->responsive(true)
            ->height(400)
            ->width(0);

        $localName=Auth::user()->local->name;

        return view('members.edit',compact(

            'regions','areas','districts','locals','members',
            'female','loginCounts','update','delete','totalMembers','population','admins','levelsCount','levelsBreakdown',
            'male','nonactive','deceased','maleTotal','femaleTotal','childrenTotal','newConvertTotal',
            'localName','totalYouth',
            'children',
            'maleBetweenAgesof15to60',
            'femaleBetweenAgesof15to60',
            'user'

        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
