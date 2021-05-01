<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\Locals;
use App\LocalSMS;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class NationalSMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sms=LocalSMS::all();

        return  view('headquarters.sms.index',compact('sms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $locals=Locals::pluck('name','id')->all();
        return  view('headquarters.sms.create',compact('locals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

          $input=new LocalSMS();

          $input->amount = $request['amount'];

          $input->local_id = $request['local_id'];

          $input->block = $request['block'];

          $input->smsToPost=$request['amount'];

          $input->is_active = $request['is_active'];

          $input->smsGeneratedCode =Str::random(6);

          $input->save();

        return redirect()->route('nationalSms.index')->with(['success'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

            $post=LocalSMS::findOrFail($id);

            return  view('headquarters.sms.edit',compact('post'));

        }catch (ModelNotFoundException $id){

        }

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
        $post=LocalSMS::findOrFail($id);

        $input=$request->all();

        $post->update($input);

        return  redirect()->route('nationalSms.index')->with(['success'=>'Successfully Updated']);
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
