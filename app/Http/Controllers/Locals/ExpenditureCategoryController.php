<?php

namespace App\Http\Controllers\Locals;

use App\AuditTrail;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesExpenditureRequest;
use App\Http\Requests\CategoriesRequest;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenditureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->local_id;
        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();
        $total=Expenditure::where("local_id",$id)->whereYear('created_at',Carbon::now()->year)->pluck('amount')->sum();

        return view('members.expenditureCategory.index',compact('expenditureCategory','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('members.expenditureCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesExpenditureRequest $request)
    {
        $category=$request->all();

        ExpenditureCategory::create($category);

        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category='Expenditure Category/'.' '.$request['name'].'/'.'Created';
        $audit->user_id=Auth::user()->id;
        $audit->save();

        return redirect()->route('expenditureC.index')->with(['success1'=>'Category successfully created']);

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
        $category=ExpenditureCategory::findOrFail($id);

        return view('members.expenditureCategory.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesExpenditureRequest $request, $id)
    {
        $category1=$request->all();

        $category=ExpenditureCategory::findOrFail($id);

        $category->update($category1);

        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category='Updated/'.' '.$category->name;
        $audit->user_id=Auth::user()->id;
        $audit->save();

        return redirect()->route('expenditureC.index')->with(['success1'=>'Category successfully updated']);
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

        $category=ExpenditureCategory::findOrFail($id);

        $category->delete();

        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category='Deleted/'.' '.'Expenditure Category of /'.$category->name;
        $audit->user_id=Auth::user()->id;
        $audit->save();

        return redirect()->route('expenditureC.index')->with(['success1'=>'Category successfully deleted']);
    }
}
