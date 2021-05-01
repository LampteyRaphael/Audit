<?php

namespace App\Http\Controllers\Locals;

use App\DonationAndPledge;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DonationAndPledgeController extends Controller
{
    //
    public function index(){

        $localId=Auth::user()->local_id;
        $user = User::orderBy('members_id','asc')
            ->where('is_active',1)
            ->where('local_id', $localId)
            ->pluck('name','id')->all();

        return view('members.tithe.donationPledge',compact('localId','user'));
    }


    public function post(Request $request)
    {
        $post = new DonationAndPledge();
        $local_code = $request['user_id'];
        $userName=User::where('id',$local_code)->pluck('name');
        if ($request['user_id']=='' && $request['check']==''){
            return redirect()->back()->with('success1','Please Select Account Name/Anonymous');
        }else {
            foreach ($userName as $usernames) {
                $usernames;
            }
            if ($post['check'] == 1) {
                $post->modeOfPayment = $request['fictitious'];
                $post->amount = $request['amount'];
                $post->local_id = $request['local_id'];
                $post->user_id = 9999;
                $post->donationOrPledge = $request['donationOrPledge'];
                $post->save();
            } elseif ($post['check'] == '') {
                $post->modeOfPayment = $request['modeOfPayment'];
                $post->amount = $request['amount'];
                $post->dateOfCheque = $request['dateOfCheque'];
                $post->checkNo = $request['checkNo'];
                $post->bank = $request['bank'];
                $post->local_id = $request['local_id'];
                $post->user_id = $request['user_id'];
                $post->donationOrPledge = $request['donationOrPledge'];
                $post->save();
            } else {
                return redirect()->back()->with('success', 'Please Select Account Name/Anonymous');
            }
            $user = User::where('is_active', 1)->where('local_id', Auth::user()->local_id)
                ->where('id', 'LIKE', '%' . $local_code . '%')
                ->pluck('name', 'id')->all();
            if (empty($usernames)){

                $usernames='Anonymous';
            }
            return redirect()->back()->with('success', 'Successfully Posted Donation To ' . $usernames . ' ' . 'Account')->with(compact('user', 'usernames'));
        }
    }


    public function search(Request $request){

        $search=$request['search'];

        $local_code=Auth::user()->local->local_code.$search;

        $user = User::where('is_active',1)->where('local_id',Auth::user()->local_id)
            ->where('members_id', 'LIKE', '%' . $local_code. '%')
            ->orwhere('name', 'LIKE', '%' .$search . '%')->where('local_id',Auth::user()->local_id)->where('is_active',1)
            ->orwhere('email', 'LIKE', '%' . $search . '%')->where('local_id',Auth::user()->local_id)->where('is_active',1)
            ->pluck('name','id')->all();

        return view('members.tithe.donationPledge',compact('localId','user'));
    }


    public function onlyD(){
        $id=Auth::user()->local_id;
        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $date=Carbon::now()->format('jS F,Y');

        $donation=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','donation')->get();

        $donationSum=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','donation')->pluck('amount')->sum();

        return view('members.tithe.onlyD',compact('donation','date','donationSum'));
    }


    public function onlyDpost(Request $request){
        $id=Auth::user()->local_id;
        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year=Carbon::parse($request['date'])->year;

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');
        $donation=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','donation')->get();
        $donationSum=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','donation')->pluck('amount')->sum();
        return view('members.tithe.onlyD',compact('donation','date','donationSum'));
    }


    public function onlyP(){
        $id=Auth::user()->local_id;
        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $date=Carbon::now()->format('jS F,Y');

        $donation=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','Pledge')->get();

        $donationSum=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','Pledge')->pluck('amount')->sum();

        return view('members.tithe.onlyP',compact('donation','date','donationSum'));
    }
    public function onlyPpost(Request $request){
        $id=Auth::user()->local_id;
        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year=Carbon::parse($request['date'])->year;

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');

        $donation=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','Pledge')->get();

        $donationSum=DonationAndPledge::where('local_id',$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('donationOrPledge','Pledge')->pluck('amount')->sum();

        return view('members.tithe.onlyP',compact('donation','date','donationSum'));
    }



}

