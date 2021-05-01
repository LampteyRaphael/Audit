<?php

namespace App\Http\Controllers\Locals;

use App\AuditTrail;
use App\DonationAndPledge;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositeRequest;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PostYearController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    //printing of daily account

    public function dailyPdf($id){
        $year=Carbon::parse($id)->year;
        $month=Carbon::parse($id)->month;
        $day=Carbon::parse($id)->day;

        $id=Auth::user()->local_id;
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at',$month) ->whereDay('created_at',$day)->pluck('amount')->sum();

        $date=Carbon::now()->format('jS F  Y');
        $pdf = PDF::loadView('members.sunday.dailyPdf',compact('date','incomeCategory','year','month','day','donation','expenditureCategory','totalExpenditure','totalTithe','incomeCategoryTotal'));
        return $pdf->stream($date.'Daily.pdf');
    }

    public function index(){
        //show monthly contributions
        $id=Auth::user()->local_id;
        $year= Carbon::now()->year;
        $date=$year;
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();
        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();
        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('members.sunday.year',compact('year','date','incomeCategory','incomeCategoryTotal','expenditureCategory', 'totalExpenditure','totalTithe','donation'));

    }

    public function midyear(){
        //show monthly contributions
        $id=Auth::user()->local_id;

        $year= Carbon::now()->year;
        $date=$year;

        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        return view('members.sunday.midyear',compact('incomeCategoryTotal','donation','totalTithe','year','date','incomeCategory','expenditureCategory', 'totalExpenditure'));
    }

    public function midyearpdf(){
        //show monthly contributions
        $id=Auth::user()->local_id;
        $year= Carbon::now()->year;
        $date=$year;
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');
        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->whereMonth('created_at','<=',6)->pluck('amount')->sum();

        $pdf = PDF::loadView('members.sunday.midyearpdf',compact('donation','totalTithe','year','date','incomeCategory','expenditureCategory', 'totalExpenditure','incomeCategoryTotal'));

        return $pdf->stream($year.'MidYear.pdf');
    }

    public function store(Request $request)
    {
        //show monthly contributions
        $id=Auth::user()->local_id;

        $year=$request['year'];
        $date=$year;
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();
        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();
        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->pluck('amount')->sum();

        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('members.sunday.year',compact('totalTithe','year','date','incomeCategory','expenditureCategory','incomeCategoryTotal', 'totalExpenditure','donation'
        ));
    }

    public function pdf($post){
        $year=$post;
        $id=Auth::user()->local_id;
        $local=Locals::where('id',$id)->pluck('name');
        $incomeCategory=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->get();
        $incomeCategoryId=incomeCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $incomeCategoryTotal=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();
        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->pluck('amount')->sum();


        $expenditureCategory=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->get();

        $expenditureCategoryId=ExpenditureCategory::where("local_id",$id)->orwhere("local_id",0)->pluck('id');

        $totalExpenditure=Expenditure::where("local_id",$id)->whereIn('category_id',$expenditureCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();

        $totalTithe=PostTithe::where('local_id',$id)->whereYear('created_at',$year)->pluck('amount')->sum();
        $pdf = PDF::loadView('members.sunday.yearpdf', compact(
            'incomeCategory','post','post','local','totalExpenditure','expenditureCategory','incomeCategoryTotal','donation','year','totalTithe'))->setPaper('a4');

        return $pdf->stream($year.'Year.pdf');
    }

    public function printStatementY($post){
    $id=Auth::user()->local_id;
    $local=Locals::where('id',$id)->pluck('name');

    $incomeCategory=incomeCategory::all()->where("local_id",$id);

    $total=income::where("local_id",$id)
        ->whereYear('created_at',$post)
        ->pluck('amount')->sum();

    $expenditureCategory=ExpenditureCategory::all()->where("local_id",$id);

    $totalExpenditure=Expenditure::where("local_id",$id)
        ->whereYear('created_at',$post)
        ->pluck('amount')->sum();

    $totalTithe=PostTithe::where('local_id',$id)
        ->whereYear('created_at',$post)->pluck('amount')->sum();

    $pdf = PDF::loadView('members.sunday.statementY', compact(
        'incomeCategory','totalTithe','post','local','totalExpenditure','expenditureCategory'
    ))->setPaper('a4');

    return $pdf->stream('Year.pdf');
}

    public function addIncome(DepositeRequest $request){

    $amount=$request->all();

    income::create($amount);
        Swal.fire('Hello world!');
    return redirect()->back()->withInput(['success'=>'Income successfully Posted']);

    }

    public function post(DepositeRequest $request){

        $amount=$request->all();

        Expenditure::create($amount);

        $c=ExpenditureCategory::findOrFail($request['category_id']);

        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category=' Posted ' . ' '. $request['amount'] .' to '.$c->name.'/Expenditure Category';
        $audit->user_id=Auth::user()->id;
        $audit->save();

        return redirect()->back()->with(['success'=>'Expenditure successfully posted']);
    }
}
