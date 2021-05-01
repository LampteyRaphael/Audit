<?php

namespace App\Http\Controllers\Locals;

use App\DonationAndPledge;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostExpenses;
use App\Postservices;
use App\PostSunday;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PostSundayController extends Controller
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
        //finding the sum of church account
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $id=Auth::user()->local_id;

        $date=Carbon::now()->format('jS F  Y');
        $date1=Carbon::now()->format('d-m-Y');

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


    public function create()
    {
        //
        return view('members.sunday.create');
    }


    public function store(Request $request)
    {
        //
        $post=$request->all();

        if (is_numeric($post['typeofevent'])){

            return redirect()->back()->with(['success1'=>'Fail: Type of event must be in words']);
        }else

        PostSunday::create($post);

        return redirect()->back()->with(['success1'=>'Successfully Posted']);
    }


    public function show($id)
    {
        //showing it in pdf
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $date=$year.'-'.$month.'-'.$day;
        $offering=PostSunday::where('local_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('offering')->sum();

        $tithe=PostSunday::where('local_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('tithe')->sum();

        $envelop=PostSunday::where('local_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('envelop')->sum();

        $fundraising=PostSunday::where('local_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('fundraising')->sum();

        $generatedfund=Postservices::where('local_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('amount')->sum();

        $expenditure=PostExpenses::where('local_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('amount')->sum();

        $total=$offering+$tithe+$envelop+$envelop+$fundraising+$generatedfund;

        $localNames=Locals::where('id',$id)->pluck('name');

        foreach ($localNames as $localName ){
            $localName;
        }

        $pdf = PDF::loadView('members.sunday.show', compact('localName',

            'offering', 'tithe', 'envelop', 'fundraising', 'generatedfund',
            'total', 'expenditure','date'));

       return $pdf->stream('Sunday.pdf');


    }


    public function edit($id)
    {
        //
        $date=$id;

        $year=Carbon::parse($date)->format('Y');
        $month=Carbon::parse($date)->format('m');
        $day=Carbon::parse($date)->format('d');

        $idd=Auth::user()->local_id;

        $offering=PostSunday::where('local_id',$idd)
            ->where('created_at',$date)
            ->pluck('offering')->sum();

        $tithe=PostSunday::where('local_id',$idd)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('tithe')->sum();

        $envelop=PostSunday::where('local_id',$idd)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('envelop')->sum();

        $fundraising=PostSunday::where('local_id',$idd)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('fundraising')->sum();

        $generatedfund=Postservices::where('local_id',$idd)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('amount')->sum();

        $expenditure=PostExpenses::where('local_id',$idd)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('amount')->sum();

        $total=$offering+$tithe+$envelop+$envelop+$fundraising+$generatedfund;

        $localNames=Locals::where('id',$idd)->pluck('name');

        foreach ($localNames as $localName ){
            $localName;
        }

        $pdf = PDF::loadView('members.sunday.show', compact('localName',

            'offering', 'tithe', 'envelop', 'fundraising', 'generatedfund',
            'total', 'expenditure','date'));

        return $pdf->stream('Sunday.pdf');
    }


    public function update(Request $request)
    {
        //

    }

}
