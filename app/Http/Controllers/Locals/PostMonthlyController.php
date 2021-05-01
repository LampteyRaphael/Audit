<?php

namespace App\Http\Controllers\Locals;

use App\DonationAndPledge;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\PostExpenses;
use App\Postservices;
use App\PostSunday;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PostMonthlyController extends Controller
{
    //
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index(Request $request){

        //show monthly contributions
        $id=Auth::user()->local_id;
        $post=$request->all();
        $year=$post['year'];
        $month=$post['month'];
        $date=$year.'-'.$month;
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        return view('members.services.index',compact('year','donation','totalTithe','month','date','incomeCategory','expenditureCategory','totalExpenditure','incomeCategoryTotal'));
    }



    public function store($idd){
        //show monthly contributions
        $id=Auth::user()->local_id;

        $year=Carbon::parse($idd)->year;
        $month=Carbon::parse($idd)->month;

        $date=$year.'-'.$month;

        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->pluck('amount')->sum();

        $pdf=PDF::Loadview('members.services.monthlypdf',compact(
            'date','incomeCategory','expenditureCategory','totalTithe','totalExpenditure','month','year','donation','incomeCategoryTotal'
        ));

        return $pdf->stream('Month.pdf');
    }
}
