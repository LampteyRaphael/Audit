<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\NationalExpenditure;
use App\NationalExpenditureCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NationalExpenditureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year=Carbon::now()->year;
        $expenditureCategory=NationalExpenditureCategory::all();
        $allExpenditureTotal=NationalExpenditure::whereYear('created_at',$year)->pluck('amount')->sum();
        return view('headquarters.finance.expenditure.index',compact('expenditureCategory','allExpenditureTotal'));

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
        //creating category at the national level
        NationalExpenditureCategory::create($request->all());

        return redirect()->back()->with(['success'=>'Successfully Created']);
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
        //showing national income category
        $category=NationalExpenditureCategory::findOrFail($id);

        $categoryAll=NationalExpenditure::where('category_id',$id)->get();

        $categoryAllTotal=NationalExpenditure::where('category_id',$id)->pluck('amount')->sum();

        return view('headquarters.finance.expenditure.show',compact('id','category','categoryAll','categoryAllTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //national category edit
        $category=NationalExpenditureCategory::findOrFail($id);

        return view('headquarters.finance.expenditure.edit',compact('category'));
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
        //updating category at the national level
        $post=NationalExpenditureCategory::findOrFail($id);

        $post->update($request->all());

        return redirect()->route('ExCategory.index')->with(['success'=>'Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=NationalExpenditureCategory::findOrFail($id);

        $post->delete();
        return redirect()->back()->with(['success'=>'Successfully deleted']);
    }
}
