<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use App\Locals;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostAreaCircularController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
        $local=Locals::where('id',$id)->where('district_id',Auth::user()->district_id)->firstOrFail();

        }catch (ModelNotFoundException $exception){

         return back()->withError('Local not found by ID ' . $id)->withInput();
        }

        return view('districts.localsupdate.edit',compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
        //updating local of the apostolic church
        $user=Locals::where('id',$id)->where('district_id',Auth::user()->district_id)->firstOrFail();

        $input=$request->all();

        $user->update($input);

        }catch (ModelNotFoundException $exception){
            return back()->withError('Local not found by ID ' . $id)->withInput();
        }
        return redirect()->route('districtPost.show',(Session::get('anotherDistrict_id')))->with(['success1'=>'successfully updated']);

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
