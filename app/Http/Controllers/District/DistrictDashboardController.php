<?php
namespace App\Http\Controllers\District;
use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Locals;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Auth;
 class DistrictDashboardController extends Controller
{
    //creating dashboard for district
    public function index(){

        $district_id=Auth::user()->district_id;
        $local_id=Locals::where('district_id',$district_id)->pluck('id');
//        $districtToLocals=DistrictCircular::orderBy('created_at','desc')->where('district_id',$district_id)->take(10)->count();
//
//        $nationalCircular=AreaCircular::orderBy('created_at','desc')->take(10)->count();
//
//        $onlydistrictadmins=PostCircularForDistrictAdmins::orderBy('created_at','desc')->take(10)->count();


               //ORIGINAL
             $district=Auth::user()->district->name;
                $january=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',1)->count();

                $febuary=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',2)->count();

                $march=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',3)->count();

                $april=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',4)->count();

                $may=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',5)->count();

                $june=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',6)->count();

                $july=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',7)->count();

                $august=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',8)->count();

                $september=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',9)->count();

                $october=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',10)->count();

                $november=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',11)->count();

                $december=User::where('is_active',1)->whereIn('local_id',$local_id)->whereMonth('created_at',12)->count();


                //displaying number of regions,area,district,locals,users

               $locals=Locals::where('district_id',$district_id)->count();

                $levelsCount  =	 Charts::create('donut', 'highcharts')
                    ->title('Levels chart')
                    ->labels(['Local'])
                    ->values([$locals])
                    ->dimensions(1000,500)
                    ->responsive(true);

                $districtsAdmins=User::where('role_id',3)->whereIn('local_id',$local_id)
                    ->where('is_active',1)->count();
                $localsAdmins=User::where('role_id',4)->whereIn('local_id',$local_id)
                    ->where('is_active',1)->count();

                //counting the number of admin
                $admins=    Charts::create('donut', 'highcharts')
                    ->title('Admins chart')
                    ->labels(['District Admins','Local Admins'])
                    ->values([$districtsAdmins,$localsAdmins])
                    ->dimensions(100,$districtsAdmins+$localsAdmins)
                    ->responsive(true);

                $female=User::where('is_active',1)->whereIn('local_id',$local_id)
                ->where('gender','female')->count();

                $male=User::where('is_active',1)->whereIn('local_id',$local_id)
                    ->where('gender','male')->count();

                $maleOrFemale=User::where('is_active',1)->whereIn('local_id',$local_id)
                    ->where('gender','male')
                    ->orwhere('gender','female')->count();


                $users=User::where('is_active',1)->whereIn('local_id',$local_id)->get();

                $dateOfBirth=Carbon::now()->format('Y-m-d');

                $children=[];
                foreach ($users as $user){

                    if (Carbon::parse($user->birthDate)->age<=15){

                        $children[]=$user;
                    }
                }


                $usersmale=User::where('is_active',1)->whereIn('local_id',$local_id)->where('gender','male')->get(['birthDate']);

                $maleBetweenAgesof15to60=[];
                foreach ($usersmale as $user){

                    if (Carbon::parse($user->birthDate)->age >15 && Carbon::parse($user->birthDate)->age <=60){

                        $maleBetweenAgesof15to60[]=$user;
                    }
                }

        $youth=User::where('is_active',1)->whereIn('local_id',$local_id)->get(['birthDate']);
        $youths=[];
        foreach ($youth as $user){

            if (Carbon::parse($user->birthDate)->age >=20 && Carbon::parse($user->birthDate)->age <=35 ){

                $youths[]=$user;
            }

        }


                $usersfemale=User::where('is_active',1)->whereIn('local_id',$local_id)->where('gender','female')->get(['birthDate']);


                $femaleBetweenAgesof15to60=[];
                foreach ($usersfemale as $user){

                    if (Carbon::parse($user->birthDate)->age >15 && Carbon::parse($user->birthDate)->age <=60 ){

                        $femaleBetweenAgesof15to60[]=$user;
                    }
                }

        $maleAbove=User::where('is_active',1)->whereIn('local_id',$local_id)->where('gender','male')->get(['birthDate']);

        $femaleAbove=User::where('is_active',1)->whereIn('local_id',$local_id)->where('gender','female')->get(['birthDate']);


        $maleAboves=[];
        $femaleAboves=[];
        foreach ($maleAbove as $user){

            if (Carbon::parse($user->birthDate)->age >60){

                $maleAboves[]=$user;
            }
        }

        foreach ($femaleAbove as $user){

            if (Carbon::parse($user->birthDate)->age >=60){

                $femaleAboves[]=$user;
            }
        }
                //summey of male,female,below 15 and above 15years of age
                $elders=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','elder')->count();
                $deacon=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','deacon')->count();
                $deaconess=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','deaconess')->count();
                $pastors=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','pastor')->count();
                $presiding=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','presiding elder')->count();
                $apostles=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','apostle')->count();
                $members=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','member')->count();
                $newConvertTotals=User::where('is_active',1)->whereIn('local_id',$local_id)->where('officeHeld','new convert')->count();

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


                $loginCount=AuditTrail::where('category','LIKE','%'.'Login'.'%')->whereIn('local_id',$local_id)->count();

                $update=AuditTrail::where('category','LIKE','%'.'Updated'.'%')->whereIn('local_id',$local_id)->count();

                $delete=AuditTrail::where('category','LIKE','%'.'Deleted'.'%')->whereIn('local_id',$local_id)->count();

                $totalMembers=User::where('is_active',1)->whereIn('local_id',$local_id)->count();

                $total=$totalMembers;

                $nonactive=User::where('is_active',0)->whereIn('local_id',$local_id)->count();

                $deceased=User::where('is_active',3)->whereIn('local_id',$local_id)->count();

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
                    ->title('Update')
                    ->elementLabel('Total Number')
                    ->values([$update,0,$loginCount+$loginCount])
                    ->responsive(true)
                    ->height(300)
                    ->width(0);

                //delete
                $delete=    Charts::create('percentage', 'justgage')
                    ->title('Delete')
                    ->elementLabel('Total Number')
                    ->values([$delete,0,$delete+$delete])
                    ->responsive(true)
                    ->height(300)
                    ->width(0);


                //creating none active  information
                $nonactive=    Charts::create('percentage', 'justgage')
                    ->title('None Active')
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

                return view('districts.dashboard',compact(
                    'members',
                    'female','loginCounts','update','delete','totalMembers','population','admins','levelsCount','levelsBreakdown',
                    'male','nonactive','deceased','maleTotal','femaleTotal','childrenTotal','newConvertTotal',
                    'maleOrFemale','district','totalYouth',
                    'children',
                    'maleBetweenAgesof15to60',
                    'femaleBetweenAgesof15to60',
                    'user'

                ));



    }

    public function index2($id){

        //displaying the user name
        $username=Auth::user()->name;
        $post=User::findOrFail($id);

        $tithe=PostTithe::where('local_id',$post->local_id)
            ->where('user_id',$post->id)
            ->whereYear('created_at',Carbon::now()->year)->get();

        return view('districts.individualTithe',compact('tithe','username'));
    }
}
