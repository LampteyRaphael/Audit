<?php

namespace App\Http\Controllers\Locals;

use App\Area;
use App\AuditTrail;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\LanguagesInGhana;
use App\Locals;
use App\Photo;
use App\Region;
use App\Role;
use App\TextField;
use App\Transfer;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TextFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //chating with admins online
        $id=Auth::user()->local_id;
        $user_id=Auth::user()->id;
        $users=TextField::where('local_id',$id)->where('user_id',$user_id)->orderBy('created_at','desc')->limit('created_at');
        return view('members.TextField.index',compact('users'));

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
        //storing members who has been transfer
        TextField::create($request->all());

        return redirect()->back();
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
        try{
            $user=User::findOrFail($id);
            $area= Area::where('area_code','=',substr($user->members_id,0,2))->pluck('id')->first();
            $district= District::where('district_code','=',substr($user->members_id,0,4))->pluck('id')->first();
            $local= Locals::where('local_code','=',substr($user->members_id,0,6))->pluck('id')->first();

            //keeping history of all the transfers that are done at the local level
            Session(['historyLocal'=>$local]);
            Session(['historyDistrict'=>$district]);
            Session(['historyArea'=>$area]);
            Session(['historynameId'=>$id]);

            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;

            $locals=Locals::where('id',$local_id)->pluck('name','id');
            $districts=District::where('id',$district_id)->pluck('name','id');

            $areas=Area::where('id',$area_id)->pluck('name','id')->all();
            $regions=Region::where('id',$region_id)->pluck('name','id');
            $roles = Role::where('id',5)->pluck('name','id');

            $languages= LanguagesInGhana::GetLatest();
            $home_regions=Region::orderBy('name','ASC')->pluck('name','name')->all();
            $Adminsroles=Role::whereId(5)->pluck('name','id');

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return view('locals.transfer.edit',compact('user','Adminsroles','home_regions','languages','roles','locals','districts','regions','areas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        try{
            $district_id=Auth::user()->district_id;
            $region_id=Auth::user()->region_id;
            $area_id=Auth::user()->area_id;
            $local_id=Auth::user()->local_id;

            $idd=trim(Auth::user()->local->local_code.$request['members_id']);
            $user=User::where('members_id',$idd)->where('local_id',Auth::user()->local_id)->count();
            if ($request['members_id']==""){
                return back()->withError('Membership ID is required')->withInput();
            }else if ($user !=null){
                return back()->withError('User by ID' . $idd  . ' ' . ' Already Exist')->withInput();
            }else

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
                $string="";
                foreach ($request->get('languagess') as $value){
                    $string .= $value.',';
                }
                $input['languagess']=$string;
                $input['members_id'] = Auth::user()->local->local_code . $request->members_id;
//                $user->update($input);

                $transferHistory=new Transfer();
                $transferHistory->local_id=Session::get('historyLocal');
                $transferHistory->district_id= Session::get('historyDistrict');
                $transferHistory->area_id=Session::get('historyArea');
                $transferHistory->user_id=Session::get('historynameId');
                $transferHistory->to_local=Auth::user()->local_id;
                $transferHistory->save();


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
                $string="";
                foreach ($request->get('languagess') as $value){
                    $string .= $value.',';
                }
                $input['languagess']=$string;
                $input['members_id'] = Auth::user()->local->local_code . $request->members_id;
                $user->update($input);

                $transferHistory=new Transfer();
                $transferHistory->local_id=Session::get('historyLocal');
                $transferHistory->district_id= Session::get('historyDistrict');
                $transferHistory->area_id=Session::get('historyArea');
                $transferHistory->user_id=Session::get('historynameId');
                $transferHistory->to_local=Auth::user()->local_id;
                $transferHistory->save();

                $audit=new AuditTrail();
                $audit->local_id=Auth::user()->local_id;
                $audit->category=$request['name'] .' '. '/Updated';
                $audit->user_id=Auth::user()->id;
                $audit->save();
            }
        }catch (ModelNotFoundException $exception){
            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return redirect()->route('transferLocal')->with(['success1' => 'Successfully Updated']);
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
