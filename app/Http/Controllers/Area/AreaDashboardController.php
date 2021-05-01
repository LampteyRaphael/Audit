<?php

namespace App\Http\Controllers\Area;


use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocalsRequest;
use App\Locals;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaDashboardController extends Controller
{
    //
    public function index(){
        $area= strtoupper(Auth::user()->area->name);

      $area_id=Auth::user()->area_id;

      $district_id=District::where('area_id',$area_id)->pluck('id');

      $local_id=Locals::whereIn('district_id',$district_id)->pluck('id');



        $loginCount=AuditTrail::where('category','LIKE','%'.'Login'.'%')->whereIn('local_id',$local_id)->count();

        $update=AuditTrail::where('category','LIKE','%'.'Updated'.'%')->whereIn('local_id',$local_id)->count();

        $delete=AuditTrail::where('category','LIKE','%'.'Deleted'.'%')->whereIn('local_id',$local_id)->count();

        $totalMembers=User::where('is_active',1)->whereIn('local_id',$local_id)->count();

        $nonactive=User::where('is_active',0)->whereIn('local_id',$local_id)->count();

        $deceased=User::where('is_active',3)->whereIn('local_id',$local_id)->count();


        /////////////////////////////////////////////////////////////////////////////
        $january=User::where('is_active',1)->whereMonth('created_at',1)->whereYear('created_at',Carbon::now()->year)->whereIn('local_id',$local_id)->count();

        $febuary=User::where('is_active',1)->whereMonth('created_at',2)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $march=User::where('is_active',1)->whereMonth('created_at',3)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $april=User::where('is_active',1)->whereMonth('created_at',4)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $may=User::where('is_active',1)->whereMonth('created_at',5)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $june=User::where('is_active',1)->whereMonth('created_at',6)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $july=User::where('is_active',1)->whereMonth('created_at',7)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $august=User::where('is_active',1)->whereMonth('created_at',8)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $september=User::where('is_active',1)->whereMonth('created_at',9)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $october=User::where('is_active',1)->whereMonth('created_at',10)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $november=User::where('is_active',1)->whereMonth('created_at',11)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();

        $december=User::where('is_active',1)->whereMonth('created_at',12)->whereIn('local_id',$local_id)->whereYear('created_at',Carbon::now()->year)->count();


        //counting number of male,female and children

        $users=User::where('is_active',1)->whereIn('local_id',$local_id)->get(['birthDate']);

        $dateOfBirth=Carbon::now()->format('Y-m-d');

        $children=[];
        foreach ($users as $user){

            if (Carbon::parse($user->birthDate)->age<=15){

                $children[]=$user;
            }
        }


        $usersmale=User::where('is_active',1)
            ->whereIn('local_id',$local_id)
            ->where('gender','male')
            ->get(['birthDate']);

        $maleBetweenAgesof15to60=[];
        foreach ($usersmale as $user){

            if (Carbon::parse($user->birthDate)->age >15 && Carbon::parse($user->birthDate)->age <=60){

                $maleBetweenAgesof15to60[]=$user;
            }
        }


        $usersfemale=User::where('is_active',1)->whereIn('local_id',$local_id)
            ->where('gender','female')
            ->get(['birthDate']);

        $femaleBetweenAgesof15to60=[];
        foreach ($usersfemale as $user){

            if (Carbon::parse($user->birthDate)->age >15 && Carbon::parse($user->birthDate)->age <=60 ){

                $femaleBetweenAgesof15to60[]=$user;
            }
        }

        //youth between the ages of 20 to 35 years
        $youth=User::where('is_active',1)->whereIn('local_id',$local_id)->get(['birthDate']);

        $maleAbove=User::where('is_active',1)->where('gender','male')->whereIn('local_id',$local_id)->get(['birthDate']);

        $femaleAbove=User::where('is_active',1)->where('gender','female')->whereIn('local_id',$local_id)->get(['birthDate']);

        $youths=[];
        $maleAboves=[];
        $femaleAboves=[];
        foreach ($youth as $user){

            if (Carbon::parse($user->birthDate)->age >=20 && Carbon::parse($user->birthDate)->age <=35 ){

                $youths[]=$user;
            }

        }

        foreach ($maleAbove as $user){

            if (Carbon::parse($user->birthDate)->age >60){

                $maleAboves[]=$user;
            }
        }

        foreach ($femaleAbove as $user){

            if (Carbon::parse($user->birthDate)->age >60){

                $femaleAboves[]=$user;
            }
        }



        //summey of male,female,below 15 and above 15years of age

        $elders=User::where('is_active',1)->where('officeHeld','elder')->whereIn('local_id',$local_id)->count();
        $deacon=User::where('is_active',1)->where('officeHeld','deacon')->whereIn('local_id',$local_id)->count();
        $deaconess=User::where('is_active',1)->where('officeHeld','deaconess')->whereIn('local_id',$local_id)->count();
        $pastors=User::where('is_active',1)->where('officeHeld','pastor')->whereIn('local_id',$local_id)->count();
        $presiding=User::where('is_active',1)->where('officeHeld','presiding elder')->whereIn('local_id',$local_id)->count();
        $apostles=User::where('is_active',1)->where('officeHeld','apostle')->whereIn('local_id',$local_id)->count();
        $members=User::where('is_active',1)->where('officeHeld','member')->whereIn('local_id',$local_id)->count();



        $areaadmins=User::where('is_active',1)->where('role_id',2)->whereIn('local_id',$local_id)->count();
        $districtAdmins=User::where('is_active',1)->where('role_id',3)->whereIn('local_id',$local_id)->count();
        $localAdmins=User::where('is_active',1)->where('role_id',4)->whereIn('local_id',$local_id)->count();

        $pie  =	 Charts::create('donut', 'highcharts')
            ->title('Admin chart')
            ->labels(['Area', 'District', 'Local'])
            ->values([$areaadmins,$districtAdmins,$localAdmins])
            ->dimensions(1000,500)
            ->responsive(true);


        //monthly population registration
        $population=    Charts::multi('areaspline', 'highcharts')
            ->title('Monthly Registered Members')
            ->elementLabel('Members')
            ->colors(['#ff0000', '#ffffff'])
            ->labels(['January','February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'])
            ->dataset('Monthly', [$january,$febuary, $march, $april, $may, $june, $july,$august,$september,$october,$november,$december]);


//summey of male,female,below 15 and above 15years of age
        $levelsBreakdown=   Charts::create('bar', 'highcharts')
            ->title('Members')
            ->elementLabel('Members')
            ->labels(['Male Above 60', 'Female Above 60', 'Children below 15 years','Male Between 15-60','Female Between 15-60','Elders', 'Deacon', 'Deaconess', 'Pastors', 'Presiding Elders','Apostle','Church Members'])
            ->values([count($maleAboves),count($femaleAboves),count($children),count($maleBetweenAgesof15to60),count($femaleBetweenAgesof15to60),$elders,$deacon,$deaconess,$pastors,$presiding,$apostles,$members])
            ->dimensions(1000,500)
            ->responsive(true);


    //creating the number of login in the system
    $per=    Charts::create('percentage', 'justgage')
        ->title('Login chart')
        ->elementLabel('Login')
        ->values([$loginCount,0,$loginCount+$loginCount])
        ->responsive(true)
        ->height(400)
        ->width(0);

        $per1=    Charts::create('percentage', 'justgage')
            ->title('Update chart')
            ->elementLabel('Update')
            ->values([$update,0,$loginCount+$loginCount])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $per2=    Charts::create('percentage', 'justgage')
            ->title('Delete chart')
            ->elementLabel('Delete')
            ->values([$delete,0,$delete+$delete])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $per3=    Charts::create('percentage', 'justgage')
            ->title('Membership')
            ->elementLabel('Total Number')
            ->values([$totalMembers,0,$totalMembers+$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

//finding active,none active,and decease in the system

        //total Member in the system
        $female=User::where('is_active',1)
            ->where('gender','female')->whereIn('local_id',$local_id)->count();

        $male=User::where('is_active',1)
            ->where('gender','male')->whereIn('local_id',$local_id)->count();

        $newConvertTotals=User::where('is_active',1)->where('officeHeld','new convert')->whereIn('local_id',$local_id)->count();



//        $dateOfBirth=Carbon::now()->format('Y-m-d');

        $children=[];
        foreach ($users as $user){

            if (Carbon::parse($user->birthDate)->age<=15){

                $children[]=$user;
            }
        }

        $youth=User::where('is_active',1)->whereIn('local_id',$local_id)->get(['birthDate']);

        $youths=[];

        foreach ($youth as $user){

            if (Carbon::parse($user->birthDate)->age >=20 && Carbon::parse($user->birthDate)->age <=35 ){

                $youths[]=$user;
            }

        }

        $maleTotal= Charts::create('percentage', 'justgage')
            ->title('Male')
            ->elementLabel('Total Number')
            ->values([$male,0,($totalMembers)])
            ->responsive(true)
            ->height(300)
            ->width(0);


        $femaleTotal= Charts::create('percentage', 'justgage')
            ->title('Female')
            ->elementLabel('Total Number')
            ->values([$female,0,$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $childrenTotal= Charts::create('percentage', 'justgage')
            ->title('Children')
            ->elementLabel('Total Number')
            ->values([count($children),0,$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $totalYouth= Charts::create('percentage', 'justgage')
            ->title('Youth')
            ->elementLabel('Total Number')
            ->values([count($youths),0,$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $newConvertTotal= Charts::create('percentage', 'justgage')
            ->title('New Convert')
            ->elementLabel('Total Number')
            ->values([$newConvertTotals,0,$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $totalNoneActive= Charts::create('percentage', 'justgage')
            ->title('Non Active')
            ->elementLabel('Total Number')
            ->values([$nonactive,0,$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        $totalDeceased= Charts::create('percentage', 'justgage')
            ->title('Deceased')
            ->elementLabel('Total Number')
            ->values([$deceased,0,$totalMembers])
            ->responsive(true)
            ->height(300)
            ->width(0);

        return view('area.dashboard',compact('totalDeceased','totalNoneActive','totalYouth','area','pie','levelsBreakdown',
            'per','per1','per2','per3','deceased','nonactive','maleTotal','femaleTotal','childrenTotal','newConvertTotal','population'
            ));
    }

    public function store(Request $request){

        District::create($request->all());

        return redirect()->back()->with(['success1' => 'Successfully created']);
    }

    public function localstore(LocalsRequest $request){

        Locals::create($request->all());

        return redirect()->back()->with(['success1' => 'Successfully created']);
    }



}
