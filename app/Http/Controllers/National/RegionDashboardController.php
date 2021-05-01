<?php
namespace App\Http\Controllers\National;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Locals;
use App\Region;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;

class RegionDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $user=[];

        $january=User::where('is_active',1)->whereMonth('created_at',1)->whereYear('created_at',Carbon::now()->year)->count();

        $febuary=User::where('is_active',1)->whereMonth('created_at',2)->whereYear('created_at',Carbon::now()->year)->count();

        $march=User::where('is_active',1)->whereMonth('created_at',3)->whereYear('created_at',Carbon::now()->year)->count();

        $april=User::where('is_active',1)->whereMonth('created_at',4)->whereYear('created_at',Carbon::now()->year)->count();

        $may=User::where('is_active',1)->whereMonth('created_at',5)->whereYear('created_at',Carbon::now()->year)->count();

        $june=User::where('is_active',1)->whereMonth('created_at',6)->whereYear('created_at',Carbon::now()->year)->count();

        $july=User::where('is_active',1)->whereMonth('created_at',7)->whereYear('created_at',Carbon::now()->year)->count();

        $august=User::where('is_active',1)->whereMonth('created_at',8)->whereYear('created_at',Carbon::now()->year)->count();

        $september=User::where('is_active',1)->whereMonth('created_at',9)->whereYear('created_at',Carbon::now()->year)->count();

        $october=User::where('is_active',1)->whereMonth('created_at',10)->whereYear('created_at',Carbon::now()->year)->count();

        $november=User::where('is_active',1)->whereMonth('created_at',11)->whereYear('created_at',Carbon::now()->year)->count();

        $december=User::where('is_active',1)->whereMonth('created_at',12)->whereYear('created_at',Carbon::now()->year)->count();

        //displaying number of regions,area,district,locals,users
        $regions=Region::pluck('id')->count();
        $areas=Area::pluck('id')->count();
        $districts=District::pluck('id')->count();
        $locals=Locals::pluck('id')->count();

        //creating pie chart for the region,area,district and local count

        $levelsCount  =	 Charts::create('donut', 'highcharts')
            ->title('Levels chart')
            ->labels(['National','Area', 'District', 'Local'])
            ->values([$regions,$areas,$districts,$locals])
            ->dimensions(1000,500)
            ->responsive(true);

        $regionAdmin=User::where('role_id',1)
            ->where('is_active',1)->count();

        $areaAdmins=User::where('role_id',2)
            ->where('is_active',1)->count();
        $districtsAdmins=User::where('role_id',3)
            ->where('is_active',1)->count();
        $localsAdmins=User::where('role_id',4)
            ->where('is_active',1)->count();
        $members=User::where('role_id',4)
            ->where('is_active',1)->count();

        //counting the number of admin
        $admins=    Charts::create('donut', 'highcharts')->title('Admins chart')
            ->labels(['National Admin','Area Admin','District Admins','Local Admins'])
            ->values([$regionAdmin,$areaAdmins,$districtsAdmins,$localsAdmins])
            ->dimensions(100,$regionAdmin+$areaAdmins+$districtsAdmins+$localsAdmins)
            ->responsive(true);

        $female=User::where('is_active',1)
        ->where('gender','female')->count();

        $male=User::where('is_active',1)
            ->where('gender','male')->count();

        $maleOrFemale=User::where('is_active',1)
            ->where('gender','male')
            ->orwhere('gender','female')->count();

        $users=User::where('is_active',1)->get(['birthDate']);


        $children=[];

        foreach ($users as $user){

            if (Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age <15){

                $children[]=$user;
            }
        }


        $usersmale=User::where('is_active',1)

            ->where('gender','male')
            ->get(['birthDate']);

        $maleBetweenAgesof15to60=[];
        foreach ($usersmale as $user){

            if (Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age >=15 && Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age <=60){

                $maleBetweenAgesof15to60[]=$user;
            }
        }


        $usersfemale=User::where('is_active',1)
            ->where('gender','female')
                ->get(['birthDate']);

        $femaleBetweenAgesof15to60=[];
        foreach ($usersfemale as $user){

            if (Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age >=15 && Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age <=60 ){

                $femaleBetweenAgesof15to60[]=$user;
            }
        }


        $youths=[];
        $maleAboves=[];
        $femaleAboves=[];
        //youth between the ages of 20 to 35 years
        $youth=User::where('is_active',1)->get(['birthDate']);

        $maleAbove=User::where('is_active',1)->where('gender','male')->get(['birthDate']);

        $femaleAbove=User::where('is_active',1)->where('gender','female')->get(['birthDate']);


        foreach ($youth as $user){

            if (Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age >=20 && Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age <=35 ){

                $youths[]=$user;
            }

        }

        foreach ($maleAbove as $user){

        if (Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age >=60){

            $maleAboves[]=$user;
        }
    }

        foreach ($femaleAbove as $user){

            if (Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age >=60){

                $femaleAboves[]=$user;
            }
        }



        //summey of male,female,below 15 and above 15years of age

        $elders=User::where('is_active',1)->where('officeHeld','elder')->count();
        $deacon=User::where('is_active',1)->where('officeHeld','deacon')->count();
        $deaconess=User::where('is_active',1)->where('officeHeld','deaconess')->count();
        $pastors=User::where('is_active',1)->where('officeHeld','pastor')->count();
        $presiding=User::where('is_active',1)->where('officeHeld','presiding elder')->count();
        $apostles=User::where('is_active',1)->where('officeHeld','apostle')->count();
        $members=User::where('is_active',1)->where('officeHeld','member')->count();
        $newConvertTotals=User::where('is_active',1)->where('officeHeld','new convert')->count();

        $levelsBreakdown=   Charts::create('bar', 'highcharts')
            ->title('Members')
            ->elementLabel('Members')
            ->labels(['Male Above 60', 'Female Above 60', 'Children below 15 years','Male Between 15-60','Female Between 15-60','Elders', 'Deacon', 'Deaconess', 'Pastors', 'Presiding Elders','Apostle','Church Members'])
            ->values([count($maleAboves),count($femaleAboves),count($children),count($maleBetweenAgesof15to60),count($femaleBetweenAgesof15to60),$elders,$deacon,$deaconess,$pastors,$presiding,$apostles,$members])
            ->dimensions(1000,500)
            ->responsive(true);



        //monthly population registration
        $population=    Charts::multi('areaspline', 'highcharts')
            ->title('Monthly Registered Members')
            ->elementLabel('Members')
            ->colors(['#ff0000', '#ffffff'])
            ->labels(['January','February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'])
            ->dataset('Monthly', [$january,$febuary, $march, $april, $may, $june, $july,$august,$september,$october,$november,$december]);



        $loginCount=AuditTrail::where('category','LIKE','%'.'Login'.'%')->whereYear('created_at',Carbon::now()->year)->count();

        $update=AuditTrail::where('category','LIKE','%'.'Updated'.'%')->whereYear('created_at',Carbon::now()->year)->count();

        $delete=AuditTrail::where('category','LIKE','%'.'Deleted'.'%')->whereYear('created_at',Carbon::now()->year)->count();

        $totalMembers=User::where('is_active',1)->count();

        $total=$totalMembers;

        $nonactive=User::where('is_active',0)->count();

        $deceased=User::where('is_active',3)->count();

        //total Member in the system
        $totalMembers=    Charts::create('percentage', 'justgage')
            ->title('Membership')
            ->elementLabel('Total Number')
            ->values([$totalMembers,0,$totalMembers+$totalMembers])
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


        //total Member in the system
        $maleTotal=    Charts::create('percentage', 'justgage')
            ->title('Male')
            ->elementLabel('Total Number')
            ->values([$male,0,($total)])
            ->responsive(true)
            ->height(300)
            ->width(0);


        $femaleTotal=    Charts::create('percentage', 'justgage')
            ->title('Female')
            ->elementLabel('Total Number')
            ->values([$female,0,$total])
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
            ->values([$newConvertTotals,0,$total])
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
            ->title('None Active chart')
            ->elementLabel('None Active')
            ->values([$nonactive,0,$total])
            ->responsive(true)
            ->height(400)
            ->width(0);

        //creating deceased information
        $deceased=Charts::create('percentage', 'justgage')
            ->title('Deceased chart')
            ->elementLabel('Deceased')
            ->values([$deceased,0,$total])
            ->responsive(true)
            ->height(400)
            ->width(0);

        $region_numbers=Charts::create('percentage', 'justgage')
            ->title('Regions chart')
            ->elementLabel('Delete')
            ->values([$regions,0,$locals])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $areas_numbers=Charts::create('percentage', 'justgage')
            ->title('Areas chart')
            ->elementLabel('Delete')
            ->values([$areas,0,$locals])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $districts_numbers=Charts::create('percentage', 'justgage')
            ->title('Districts chart')
            ->elementLabel('Delete')
            ->values([$districts,0,$locals])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $locals_numbers=Charts::create('percentage', 'justgage')
            ->title('Locals chart')
            ->elementLabel('Delete')
            ->values([$locals,0,$locals])
            ->responsive(true)
            ->height(300)
            ->width(0);

        return view('headquarters.region.dashboard',compact(
            'regions','areas','districts','locals','areaAdmins','districtsAdmins','localsAdmins','members',
            'female','loginCounts','update','delete','totalMembers','population','admins','levelsCount','levelsBreakdown',
            'male','nonactive','deceased','maleTotal','femaleTotal','childrenTotal','newConvertTotal','totalYouth',
            'maleOrFemale', 'children', 'maleBetweenAgesof15to60', 'femaleBetweenAgesof15to60', 'user','areas_numbers',
            'districts_numbers','locals_numbers','region_numbers'
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
        //searching for individual region
        $id=$request->name=$request['name'];

        $regions=Region::where('id','LIKE','%'.$id.'$')
            ->orWhere('name','LIKE','%'.$id.'%')->get();

        if (!$regions)
            return redirect()->back()->with(['success1'=>'Sorry couldn\'t find anything']);
        else
        return view('headquarters.region.search',compact('regions'));
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
