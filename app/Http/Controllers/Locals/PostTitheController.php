<?php
namespace App\Http\Controllers\Locals;

use App\AuditTrail;
use App\ErrorLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostTitheRegisterRequest;
use App\LocalSMS;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Jenssegers\Date\Date;
use Mockery\Exception;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;


//require_once "vendor/twilio/sdk/src/Twilio/autoload.php";

class PostTitheController extends Controller
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
        $authId=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $date=Carbon::now()->format('jS F,Y');
        $tithe=PostTithe::where('local_id',$authId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)->get();

        $totalTithe=PostTithe::where('local_id',$authId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();
        return view('members.tithe.index',compact('tithe','totalTithe','date'));
    }

    public function create()
    {
        $localId=Auth::user()->local_id;
        $user = User::orderBy('members_id','asc')
            ->where('is_active',1)
            ->where('local_id', $localId)
            ->pluck('name','id','mobileNumber1','mobileNumber2')->all();

        return view('members.create',compact('user'));
    }


    public function store(Request $request)
    {

        try {
            $smNotify ="";
            $user="";
            $local_code = $request['user_id'];

            $userName=User::where('id',$local_code)->get(['name','mobileNumber1','mobileNumber2']);

            if ($request['user_id']=='' && $request['check']==''){

                return redirect()->back()->with('success1','Please Select Account Name/Anonymous');

            }else {
                foreach ($userName as $users) {

                       $usernames=$users->name;

                    if (!$users->mobileNumber1 == ''){

                        $mobile=$users->mobileNumber1;

                    }else {
                        $mobile = $users->mobileNumber2;
                    }
                }
                if ($request['check'] == 1) {
                    $post = new PostTithe();
                    $post->modeOfPayment = $request['fictitious'];
                    $post->amount = $request['amount'];
                    $post->local_id = $request['local_id'];
                    $post->user_id = 9999;
                    $post->save();
                    $audit = new AuditTrail();
                    $audit->local_id = Auth::user()->local_id;
                    $audit->category = "Anonymous" . ' ' . '/Posted Tithe'.'/Amount ' . ' ' .'GHS'.$request['amount'];;
                    $audit->user_id = Auth::user()->id;
                    $audit->save();
                    //calling that person whose tithe is being posting to his or her account
                    $sms=LocalSMS::where('local_id',Auth::user()->local_id)->get();

                    //looping through the details to see whether the message can be sent or not
                    foreach ($sms as $sm){

                        /*if the generated code and the verification code entered are the same
                           and number to post is greater than zero and there is mobile number 1 or 2 the system should post the message
                         */
                        if ($sm->smsGeneratedCode===$sm->smsVerificationCode && $sm->smsToPost>0 && $sm->is_active===1 && $sm->block===1 && $mobile !==''){
                            $updateSmsPosted=LocalSMS::findOrFail($sm->id);
                            $basic  = new \Nexmo\Client\Credentials\Basic(('02c68f39'), ('Qyzcu6kXONNLoYLM'));
                            $client = new \Nexmo\Client($basic);

                            $message = $client->message()->send([
                                'to' => "233".substr($mobile,1,9),
                                'from' => 'TACMS',
                                'text' => 'Hi' .' '. User::where('id',$request['user_id'])->pluck('name')->first()."\n".
                                    'Your CHURCH/ID No : ' .User::where('id',$request['user_id'])->pluck('members_id')->first() ."\n".
                                    'has been credited with GHS ' . $request['amount']."\n".
                                    'Local Assembly: '. Auth::user()->local->name."\n".
                                    'Date:'.Carbon::now()."\n"
                            ]);

                            $response = $message->getResponseData();

                            if($response['messages'][0]['status'] == 0) {


                                $smNotify= "SMS has been sent successfully";

                            } else {

                                $smNotify= "SMS has not been sent";

                            }
                            //subtracting from post sms target given to them
                            $updateSmsPosted->update(['smsToPost'=>$sm->smsToPost-1,'amount'=>$sm->amount-0.04,'smsPosted'=>$sm->smsPosted+1]);

                        }
                    }

                } elseif ($request['check'] == '') {
                    $p = new PostTithe();
                    $p->modeOfPayment = $request['modeOfPayment'];
                    $p->amount = $request['amount'];
                    $p->dateOfCheque = $request['dateOfCheque'];
                    $p->checkNo = $request['checkNo'];
                    $p->bank = $request['bank'];
                    $p->local_id = $request['local_id'];
                    $p->user_id = $request['user_id'];
                    $p->save();
                    $audit = new AuditTrail();
                    $audit->local_id = Auth::user()->local_id;
                    $audit->category = $usernames . ' ' . '/Posted Tithe'.'/Amount ' . ' GHS ' . ' ' .$request['amount']; ;
                    $audit->user_id = Auth::user()->id;
                    $audit->save();

                                 //calling that person whose tithe is being posting to his or her account
                $sms=LocalSMS::where('local_id',Auth::user()->local_id)->get();

                //looping through the details to see whether the message can be sent or not
                foreach ($sms as $sm){

                    /*if the generated code and the verification code entered are the same
                       and number to post is greater than zero and there is mobile number 1 or 2 the system should post the message
                     */
                    if ($sm->smsGeneratedCode===$sm->smsVerificationCode && $sm->smsToPost>0 && $sm->is_active===1 && $sm->block===1 && $mobile !==''){
                        $updateSmsPosted=LocalSMS::findOrFail($sm->id);
                        $basic  = new \Nexmo\Client\Credentials\Basic(('02c68f39'), ('Qyzcu6kXONNLoYLM'));
                        $client = new \Nexmo\Client($basic);

                        $message = $client->message()->send([
                            'to' => "233".substr($mobile,1,9),
                            'from' => 'TACMS',
                            'text' => 'Hi' .' '. User::where('id',$request['user_id'])->pluck('name')->first()."\n".
                                'Your CHURCH/ID No : ' .User::where('id',$request['user_id'])->pluck('members_id')->first() ."\n".
                                'has been credited with GHS ' . $request['amount']."\n".
                                'Local Assembly: '. Auth::user()->local->name."\n".
                                'Date:'.Carbon::now()."\n"
                        ]);

                        $response = $message->getResponseData();


                        if($response['messages'][0]['status'] == 0) {

                            $smNotify= "SMS has been sent successfully";

                        }else {

                            $smNotify= "SMS has not been sent";

                        }
                        //subtracting from post sms target given to them
                        $updateSmsPosted->update(['smsToPost'=>$sm->smsToPost-1,'amount'=>$sm->amount-0.04,'smsPosted'=>$sm->smsPosted+1]);

                    }
                }
            }else {

                return redirect()->back()->with('success', 'Please Select Account Name/Anonymous');

            }

                $user = User::where('is_active', 1)->where('local_id', Auth::user()->local_id)
                    ->where('id', 'LIKE', '%' . $local_code . '%')
                    ->pluck('name', 'id')->all();

                if (empty($usernames)) {

                    $usernames = 'unknown selected tithe';
                }

                return redirect()->back()->with('success', 'Successfully Posted Tithe To ' . $usernames . ' ' . 'Account ' . ' / '. ' '.$smNotify)->with(compact('user'));
            }

            } catch (Exception $e) {

            echo "The message was not sent. Error: " . $e->getMessage() . "\n";
        } catch (\Exception $e) {

            return redirect()->back()->with('success', 'Successfully Posted Tithe To ' . $usernames . ' ' . 'Account ' . ' / '. ' SMS FAIL')->with(compact('user'));

        }


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
                $user=PostTithe::where('id',$id)->where('local_id',Auth::user()->local_id)->first();

                if (!$user){
                    return back()->withError('Can\'t find user by ID'.$id)->withInput();
                }

            }catch (ModelNotFoundException $exception){

            return back()->withError('Can\'t find by ID ')->withInput();
           }
         $name=$user->user? $user->user->name:"Anonymous";

//         $id=$user->user_id;
//        $log=new ErrorLog();
//        $authName=Auth::user()->name;
//
//        $local_id=Auth::user()->local_id;
//
//        $log->local_id=$local_id;
//
//        $log->name=$authName;
//
//        $log->details=$user->user->name.'/'.'GHS'.$user->amount.'-'.'tithe paid was deleted'.'-'.$user->created_at;
//
//        $log->save();

        return view('members.tithe.viewPending',compact('user','name','id'));

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

        $user=PostTithe::findOrFail($id);

         $user->modeOfPayment=1;

         $user->update();

//        $log=new ErrorLog();
//        $authName=Auth::user()->name;
//
//        $local_id=Auth::user()->local_id;
//
//        $log->local_id=$local_id;
//
//        $log->name=$authName;
//
//        $log->details=$user->user->name.'/'.'GHS'.$user->amount.'-'.'tithe paid was deleted'.'-'.$user->created_at;
//
//        $log->save();
//
//        $user->delete();


        return redirect()->back()->with(['success'=>' Pending has stop successfully ' . ' and credited to'.strtoupper($user->user->name).' Account ']);
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

       $post= PostTithe::findOrFail($id);


        $log=new ErrorLog();
        $authName=Auth::user()->name;

        $local_id=Auth::user()->local_id;

        $log->local_id=$local_id;

        $log->name=$authName;

        $log->details=$request['detail'];

        $log->save();

       $post->update($request->all());

       return redirect()->route('tithe.index')->with(['success'=>'Amount successfully change']);
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
