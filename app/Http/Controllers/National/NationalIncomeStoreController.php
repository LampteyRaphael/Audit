<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalIncomeRequest;
use App\NationalExpenditure;
use App\NationalIncome;
use Illuminate\Http\Request;

class NationalIncomeStoreController extends Controller
{
    //
    public function store(NationalIncomeRequest $request){

        $post=$request->all();

        NationalIncome::create($post);

        return redirect()->back()->with(['success'=>'Successfully Posted']);
    }

    public function store2(NationalIncomeRequest $request){

        $post=$request->all();

        NationalExpenditure::create($post);

        return redirect()->back()->with(['success'=>'Successfully Posted']);
    }

}
