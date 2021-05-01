<?php

namespace App\Http\Controllers\Area;

use App\AuditTrail;
use App\Http\Requests\UserUpdateRequest;
use App\Photo;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AreaMemebersUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try{
            $user=User::where('id',$id)->where('area_id',Auth::user()->area_id)->firstOrFail();
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

        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }

        return redirect()->route('updates.show',Session::get('localAdminId'))->with(['success1'=>'Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
            $user = User::where('id',$id)->where('area_id',Auth::user()->area_id)->firstOrFail();
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
        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }


        return redirect()->route('updates.show',Session::get('localAdminId'))->with(['success1'=>'Successfully Deleted']);
    }
}
