<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\NationalIncome;
use App\NationalIncomeCategory;
use App\PostTithe;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NationalIncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomeCategory=NationalIncomeCategory::all();

        $year=Carbon::now()->year;

        $allIncomeTotal=NationalIncome::whereYear('created_at',$year)->pluck('amount')->sum();

        $totalTithe=PostTithe::whereYear('created_at',$year)->pluck('amount')->sum()*0.6;

        $t=incomeCategory::where("name",'Thanksgiving Offering')->where("local_id",0)->pluck('id');

        $thanks=income::where('category_id',$t)->whereYear('created_at',$year)->pluck('amount')->sum()*0.6;

        return view('headquarters.finance.income.index',compact('incomeCategory','allIncomeTotal','totalTithe','thanks'));

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

        NationalIncomeCategory::create($request->all());

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
        try{
            //showing national income category
            $category=NationalIncomeCategory::findOrFail($id);

            $categoryAll=NationalIncome::where('category_id',$id)->get();

            $categoryAllTotal=NationalIncome::where('category_id',$id)->pluck('amount')->sum();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Not found by ID ' . $id)->withInput();
        }

        return view('headquarters.finance.income.show',compact('id','category','categoryAll','categoryAllTotal'));
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
            //national category edit
            $category=NationalIncomeCategory::findOrFail($id);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Not found by ID ' . $id)->withInput();
        }


        return view('headquarters.finance.income.edit',compact('category'));
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
        try{
            //updating category at the national level
            $post=NationalIncomeCategory::findOrFail($id);

            $post->update($request->all());

        }catch (ModelNotFoundException $exception){

            return back()->withError('Not found by ID ' . $id)->withInput();
        }

        return redirect()->route('categoryNa.index')->with(['success'=>'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $post=NationalIncomeCategory::findOrFail($id);

            $post->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Not found by ID ' . $id)->withInput();
        }

        return redirect()->back()->with(['success'=>'Successfully deleted']);
    }
}
