<?php

namespace App\Http\Controllers\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaChurchAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $d[]="";
        $id=Auth::user()->area_id;

        $district=District::where('area_id',$id)->pluck('name','id')->all();

        $d=District::where('area_id',$id)->pluck('id');

        $local=Locals::whereIn('district_id',$d)->pluck('name', 'id')->all();

        $category='';
        $from="";
        $to="";
        return view('area.churchaccount.index',compact('district','local','d','category','from','to'));
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
        $d[]="";
        $id=Auth::user()->area_id;

        $district=District::where('area_id',$id)->pluck('name','id')->all();

        $d=District::where('area_id',$id)->pluck('id');

         $local=Locals::whereIn('district_id',$d)->pluck('name', 'id')->all();

         $post= $request->all();

         $local_id=$post['local_id'];

        $from=$post['from'];

        $to=$post['to'];

         $category=incomeCategory::all()->where('local_id',$local_id);

        $c=incomeCategory::where('local_id',$local_id)->pluck('id');

        $total=income::where("local_id",$local_id)
             ->where('category_id',$c)
             ->whereBetween('created_at',[$from." 00:00:00",$to." 23:59:59"])
             ->pluck('amount')->sum();

        return view('area.churchaccount.index',compact('category', 'c','local','district','from','to','local_id','total'));
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
