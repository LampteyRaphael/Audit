<?php

namespace App\Http\Controllers\Locals;

use App\AreaLevelCircular;
use App\DistrictCircular;
use App\Http\Controllers\Controller;
use App\LocalCircular;
use App\Locals;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLocalCircularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $post=DistrictCircular::orderBy('created_at','desc')->take(10)->get();


        return view('members.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Posting of circular
        $id=Auth::user()->local_id;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=LocalCircular::where('local_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->take(5)->get();

        $local=Auth::user()->local->name;

        return view('members.circular',compact('post','local','month','year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //creating local messages

         $input =$request->all();

        if ($file=$request->file('name')){

            $name=time().$file->getClientOriginalName();

            $file->move('LocalMembers',$name);

            LocalCircular::create(['name'=>$name,'local_id'=>$request['local_id']]);
        }

        return redirect()->back()->with(['success1'=>'Successfully Posted Messages']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
       //localCircular to the church members
         $post=LocalCircular::where('id',$id)->where('local_id',Auth::user()->local_id)->get();
         return view('members.circular.localshow',compact('post','year','month'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {

            $post=DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->get();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }

        return view('members.circular.district',compact('post'));
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
