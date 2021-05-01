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
use Illuminate\Support\Facades\Auth;
use PDF;

class MonthlyPdfController extends Controller
{
    //monthly pdf generation

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
        $t=incomeCategory::where("name",'Thanksgiving Offering')->where("local_id",0)->pluck('id');
        $thanks=income::where("local_id",$id)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year)
                ->where('category_id',$t)->pluck('amount')->sum()*.75;

        $total=income::where("local_id",$id)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year)
                ->pluck('amount')->sum()-$thanks;

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $totalExpenditure=Expenditure::where("local_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();
        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->pluck('amount')->sum();

        $pdf = PDF::loadView('members.services.monthlypdf',compact(
            'year', 'month','date','totalTithe','incomeCategory','total',
            'expenditureCategory', 'totalExpenditure','date','donation'
        ));

        return $pdf->stream($date.'Monthly.pdf');
    }

    public function monthlyStatement($idd){
        //show monthly contributions
        $id=Auth::user()->local_id;

        $year=Carbon::parse($idd)->year;
        $month=Carbon::parse($idd)->month;

        $date=$year.'-'.$month;
        $incomeCategory=incomeCategory::all()
            ->where("local_id",$id);

        $total=income::where("local_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::all()->where("local_id",$id);
        $totalExpenditure=Expenditure::where("local_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();
        $totalTithe=PostTithe::where('local_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $pdf = PDF::loadView('members.services.monthlyStatement',compact(
            'year', 'month','date','incomeCategory','total','totalTithe','expenditureCategory', 'totalExpenditure','date'
        ));
        return $pdf->stream('Monthly.pdf');
    }
}
