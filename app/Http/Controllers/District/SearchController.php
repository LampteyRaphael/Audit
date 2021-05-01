<?php
namespace App\Http\Controllers\District;
use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\LanguagesInGhana;
use App\Locals;
use App\Region;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index(Request $request){
        try{
        $id=$request->name=$request['name'];
        $area_id=Auth::user()->area_id;

        $districts=District::where('id','LIKE','%'.$id.'%')->whereIn('role_id',[1,2,3,4,5])->orWhere('name','LIKE','%'.$id.'%')
            ->where('area_id',$area_id)->get();

         }catch (ModelNotFoundException $exception){

           return back()->withError('User not found by' . $request['name'])->withInput();
             }

        return view('districts.search',compact('districts'));
    }



    public function locals($id){

       try{
        $locals = Locals::where('id',$id)->where('district_id',Auth::user()->district_id)->firstOrFail();

        $users = User::where('local_id', $id)->where('district_id',Auth::user()->district_id)
           ->whereIn('role_id',[1,2,3,4,5])->where('is_active', 1)->where('officeHeld','!=','children ministry')->GetLatest();


        $children =User::where('local_id', $id)->where('district_id',Auth::user()->district_id)
            ->whereIn('role_id',[1,2,3,4,5])->where('is_active', 1)->where('officeHeld','=','children ministry')->count();

        $countUsers = User::where('local_id', $id)
            ->where('is_active', 1)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        $matchM = ['local_id' => $id, 'is_active' => 1, 'gender' => 'male'];
        $male = User::where($matchM)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        $matchF = ['local_id' => $id, 'is_active' => 1, 'gender' => 'female'];
        $female = User::where($matchF)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        $matchD = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'deacon'];
        $deacon = User::where($matchD)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        $matchDN = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'deaconess'];
        $deaconess = User::where($matchDN)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        $elder = $match = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'elder'];
        $elder = User::where($elder)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        $member = $match = ['local_id' => $id, 'is_active' => 1, 'officeHeld' => 'member'];

        $member = User::where($member)->where('officeHeld','!=','children ministry')->where('district_id',Auth::user()->district_id)->whereIn('role_id',[1,2,3,4,5])->count();

        Session(['locals_back_id' => $locals->id]);

        }catch (ModelNotFoundException $exception){

    return back()->withError('Local not found by ID ' . $id)->withInput();
}
        return view('districts.localMembers',compact('locals',
            'users', 'countUsers', 'male', 'female', 'deacon', 'deaconess', 'elder', 'member', 'children','id'
        ));
    }


    public function index2($id){

      try{
        $district_id=Auth::user()->district_id;

        $region_id=Auth::user()->region_id;

        $area_id=Auth::user()->area_id;

        $user=User::where('id',$id)->where('district_id',$district_id)->firstOrFail();

        $locals=Locals::where('district_id',$district_id)->pluck('name','id');
        $districts=District::where('id',$district_id)->pluck('name','id');
        $areas=Area::where('id',$area_id)->pluck('name','id');
        $regions=Region::where('id',$region_id)->pluck('name','id');
        $roles = Role::pluck('name','id');
        $languages= LanguagesInGhana::GetLatest();

        $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();

      }catch (ModelNotFoundException $exception){

          return back()->withError('User not found by ID ' . $id)->withInput();
      }
        return view('districts.nonedit',compact(
            'user','home_regions','languages','roles','locals','districts','regions','areas'
        ));
    }


    public function children($id){

            try {
                $locals = Locals::where('id', $id)->where('district_id', Auth::user()->district_id)->firstOrFail();

                $users = User::where('local_id', $id)->where('district_id', Auth::user()->district_id)
                    ->whereIn('role_id', [1, 2, 3, 4, 5])->where('is_active', 1)->where('officeHeld', '=', 'children ministry')->GetLatest();

                $countUsers = User::where('local_id', $id)
                    ->where('is_active', 1)->where('officeHeld', '=', 'children ministry')->where('district_id', Auth::user()->district_id)->whereIn('role_id', [1, 2, 3, 4, 5])->count();

                $matchM = ['local_id' => $id, 'is_active' => 1, 'gender' => 'male'];
                $male = User::where($matchM)->where('officeHeld', '=', 'children ministry')->where('district_id', Auth::user()->district_id)->whereIn('role_id', [1, 2, 3, 4, 5])->count();

                $matchF = ['local_id' => $id, 'is_active' => 1, 'gender' => 'female'];
                $female = User::where($matchF)->where('officeHeld', '=', 'children ministry')->where('district_id', Auth::user()->district_id)->whereIn('role_id', [1, 2, 3, 4, 5])->count();

                Session(['locals_back_id' => $locals->id]);

            } catch (ModelNotFoundException $exception) {

                return back()->withError('Local not found by ID ' . $id)->withInput();
            }
            return view('districts.localMembersChildren', compact('locals', 'id', 'users', 'countUsers', 'male', 'female'));
    }


}
