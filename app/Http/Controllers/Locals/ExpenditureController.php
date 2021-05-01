<?php

namespace App\Http\Controllers\Locals;

use App\AuditTrail;
use App\ErrorLog;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExpenditureController extends Controller
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
    public function store(DepositeRequest $request)
    {
        //
        $amount=$request->all();

        Expenditure::create($amount);

        $c=ExpenditureCategory::findOrFail($request['category_id']);

        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category=' Posted ' . ' '. $request['amount'] .' to '.$c->name.'/Expenditure Category';
        $audit->user_id=Auth::user()->id;
        $audit->save();

        return redirect()->route('expenditure.show',Session::get('amountIdd'))->with(['success1'=>'Expenditure successfully Posted']);

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
        $category=ExpenditureCategory::findOrFail($id);

        $ids=  Auth::user()->local_id;

        Session(['amountIdd'=>$id]);

        $categoryAll=Expenditure::Latest()->where('category_id','=',$category->id)->where('local_id','=',$ids)->get();

        $categoryAllTotal=Expenditure::where('category_id','=',$category->id)->where('local_id','=',$ids)->pluck('amount')->sum();

        return view('members.expenditure.show',compact('category','categoryAll','categoryAllTotal','ids'));
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
        $expenditure=Expenditure::findOrFail($id);

        $categoryName=ExpenditureCategory::findorFail($expenditure->category_id);

        return view('members.expenditure.index',compact('expenditure','categoryName'));
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
        $post=Expenditure::findOrFail($id);

        if (empty($request['reason'])){

            return redirect()->back()->with(['success1'=>'Sorry Administrator, there must be a tangible reason for changing this figures']);
        }else
        $post->amount=$request['amount'];

        $log=new ErrorLog();
        $authName=Auth::user()->name;

        $local_id=Auth::user()->local_id;

        $log->local_id=$local_id;

        $log->name=$authName;

        $log->details='Expenditure Category'.$request['reason'];

        $log->save();


        $post->update();

        return redirect()->route('expenditure.show',session::get('amountIdd'))->with([''=>'Successfully Updated']);

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
