<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\Locals;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NationalViewLocalMembersController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try{
            $locals=Locals::findOrFail($id);

            $users=User::where('local_id','=',$locals->id)->GetLatest();

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
