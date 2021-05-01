<?php

namespace App\Http\Controllers\District;

use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DistrictErrorsController extends Controller
{
    //

    public  function incomeErrors($id){

    try{
        $income=DistrictIncome::findOrFail($id);
        $categoryName=DistrictIncomeCategory::where('id',$income->district_income_categories_id)->get('name')->first();

    }catch (ModelNotFoundException $exception){

        return back()->withError('Income not found by ID ' . $id)->withInput();
    }
    return view('districts.incomeErrors.index',compact('income','categoryName'));
     }

//    public  function expenseErrors($id){
//
//        try{
//            $income=DistrictIncome::findOrFail($id);
//            $categoryName=DistrictIncomeCategory::where('id',$income->district_income_categories_id)->get('name')->first();
//
//        }catch (ModelNotFoundException $exception){
//
//            return back()->withError('Income not found by ID ' . $id)->withInput();
//        }
//        return view('districts.incomeErrors.index',compact('income','categoryName'));
//    }


}
