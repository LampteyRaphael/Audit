<?php

namespace App\Http\Controllers\Locals;

use App\DonationAndPledge;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostServiceRequest;
use App\income;
use App\incomeCategory;
use App\PostExpenses;
use App\Postservices;
use App\PostSunday;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index()
    {
        //show monthly contributions
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $date=$year.'-'.$month;
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        return view('members.services.index',compact('year','totalTithe','month','date','incomeCategory','expenditureCategory','totalExpenditure','donation','incomeCategoryTotal'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('members.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostServiceRequest $request)
    {
        //
        $post=$request->all();

        if (is_numeric($post['generatedfund'])){

            return redirect()->back()->with(['success1'=>'Fail: State the type of generated fund must be in words']);
        }else

        Postservices::create($post);


        return redirect()->back()->with(['success1'=>'Successfully Posted Amount! Thank you']);


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
