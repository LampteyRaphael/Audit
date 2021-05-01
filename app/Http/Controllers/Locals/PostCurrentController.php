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

class PostCurrentController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    //changing current date
    public function request(Request $request){
        $date=$request['date'];
        $year=Carbon::parse($date)->format('Y');
        $month=Carbon::parse($date)->format('m');
        $day=Carbon::parse($date)->format('d');

        $id=Auth::user()->local_id;

        $date=Carbon::parse($request['date'])->format('jS F,Y');;
        $date1=$request['date'];
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();
        return view('members.sunday.index',compact('date1','date','incomeCategory','year','month','day','donation',
            'expenditureCategory','totalExpenditure','incomeCategoryTotal','totalTithe'
        ));
    }
}
