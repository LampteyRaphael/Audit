{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--<li>--}}
{{--    <p class="navbar-text">--}}
{{--        Post tithe to individual Account--}}
{{--    </p>--}}
{{--</li>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    @include('includes.form_error')--}}
{{--    @include('includes.alert')--}}
{{--<div class="row">--}}
@extends('layouts.app', ['activePage' => 'tithe', 'titlePage' => __('Add Tithe')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Entry Of tithe</h4>
                            <p class="card-category"> Post tithe to individual Account</p>
                        </div>
                        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <span class="pull-left" style="font-size: 12px; font-weight: bold">Select yes for bulk tithe post(
                        {!! Form::label('bulk','Yes',['class'=>'control-label']) !!}
                        <input type="radio" id="bulk" value='1' name="bulk">
                        {!! Form::label('notBult','No',['class'=>'control-label']) !!}
                        <input type="radio" id="notBult" value='2' name="bulk">
                         )
                    </span>
                    <div id="total_amount"  class="pull-right" style="font-size: 12px; font-weight: bold"></div>
                </div>
            </div>


        <div id="form_show"">

                    {!! Form::open(['method'=>'POST','action'=>'Locals\SearchTitheController@search','onsubmit' => 'return searchInfo()'])!!}
              <div class="row">
                   <div class="col-md-2">
                    <div class="form-group">
                            {!! Form::label('code','Local Code',['class'=>'control-label']) !!}
                            {!! Form::text('code',Auth::user()->local->local_code,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                    </div>
                  </div>
                <div class="col-md-8">
                    <div class="form-group" id="form-show">
                        {!! Form::label('search','Last Three Digit Of Membership Id/Name/Email',['class'=>'control-label']) !!}
                        {!! Form::text('search',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="form-show">
                        {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            </div>

                    {!! Form::close() !!}




            {!! Form::model($user,['method'=>'POST','action'=>'Locals\PostTitheController@store','onsubmit' => 'return ConfirmDelete()'])!!}
            <div class="row">
                <div class="col-md-2">
               <div class="form-group">
                   {!! Form::label('check','Anonymous',['class'=>'control-label']) !!}
                   {!! Form::checkbox('check',1,null,['id'=>'Fictitious']) !!}
               </div>
                </div>
            </div>

         <div class="row">
             <div class="col-md-2">
            <div class="form-group bold" id="showFictitious">
                {!! Form::label('user_id','Account Name',['class'=>'control-label']) !!}
                <div class="input-group">
                    <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                    {!! Form::select('fictitious',[5=>'UNKNOWN SELECTED TITHE'],5,['class'=>'form-control']) !!}
                    <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                </div>
            </div>
            </div>
         </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group" id="accountName">
                {!! Form::label('user_id','Account Name',['class'=>'control-label']) !!}
                </div>
            </div>
            <div class="col-md-8">
            <div class="form-group" id="accountName">
                    {!! Form::select('user_id',$user,null,['class'=>'form-control']) !!}
                </div>
            </div>
            </div>
        </div>

      <div class="row">
          <div class="col-md-2">
              <div class="form-group" id="accountName">
                  {!! Form::label('modeOfPayment','Payment Mode',['class'=>'control-label']) !!}
              </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
                        {!! Form::select('modeOfPayment',[1=>'Cash',
                        2=>'E-Payment',
                        3=>'Cheque'
                        ],'cash',['class'=>'form-control','required'=>'required','id'=>'modeofpayment']) !!}
                </div>
            </div>
            </div>


    <div class="row">
        <div class="col-md-2">
            <div class="form-group" id="accountName">
                {!! Form::label('dateOfCheque','Date Written On the Cheque',['class'=>'control-label']) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group bold" id='dateOfCheque'>
                {!! Form::text('dateOfCheque',null,['id'=>'dateOfCheque','class'=>'form-control','placeholder'=>'YY/MM/DD']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group" id="accountName">
                {!! Form::label('checkNo','Check Number',['class'=>'control-label']) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group bold" id='dateOfCheque'>
                {!! Form::text('checkNo',null,['id'=>'checkNo','class'=>'form-control']) !!}
            </div>
         </div>
    </div>
      <div class="row">
          <div class="col-md-2">
              <div class="form-group" id='bank'>
              {!! Form::label('bank','Bank',['class'=>'control-label']) !!}
              </div>
          </div>
          <div class="col-md-8">
            <div class="form-group" id='bank'>
                {!! Form::text('bank',null,['id'=>'bank','class'=>'form-control']) !!}
            </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-2">
              {!! Form::label('amount','Amount (GHS)',['class'=>'control-label']) !!}
          </div>
          <div class="col-md-8">
            <div class="form-group ">
                    {!! Form::number('amount',null,['class'=>'form-control','step'=>'any','required'=>'required']) !!}
                    <div class="input-group-addon bg-blue"><i class="fa fa-money"></i></div>
                </div>
            </div>
       </div>

     <div class="row">
         <div class="col-md-8">
            <div class="form-group ">
                {!! Form::hidden('local_id','local id',['class'=>'control-label']) !!}
                {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control']) !!}
{{--                {!! Form::text('mobileNumber1',$user->mobileNumber1,['class'=>'form-control']) !!}--}}
{{--                {!! Form::text('mobileNumber2',$user->mobileNumber2,['class'=>'form-control']) !!}--}}
            </div>
         </div>
     </div>

            <div class="pull-right">
                {!! Form::submit('submit',['class'=>'btn  btn-primary']) !!}
                {{--<button type="submit" id="submit">click</button>--}}
            </div>

        </div>
            {!! Form::close() !!}
        </div>

            <div class="col-md-12">
                <span style="font-size: 12px;color:#094498; font-weight: bold" id="header">The maximum number you can post is 50.Membership ID is required(only the last 3-digit number).The amount field is required.Only cash deposit is accepted with bulk tithe post</span>
                <div id="showBulk">
                    <div id="step1">
                        {!! Form::model($user,['method'=>'POST','action'=>'Locals\LocalNoneActiveUsersController@store','class'=>'form-horizontal','onsubmit' => 'return bulkpost()'])!!}
                        <div class="col-md-12">
                            <div id="bulkSubmit" class="shadow"></div>
                            <div class="pull-right" style="padding-top: 10px; padding-left: 20px">
                                <div class="pull-left">
                                    <div class="form-group">
                                       {!! Form::submit('submit',['class'=>'btn  btn-success','id'=>'bulksubmitsave']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}

                            </div>

                        </div>
                    </div>
                </div>

                <div style="padding-top:20px">
                    <div class="col-md-2 col-md-offset-1">
                        <button class="btn btn-sm btn-danger pull-left" id="remove">Remove</button>
                    </div>
                    <div class="col-md-">
                        <button class="btn btn-sm btn-primary pull-left" id="send">+Add</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
</div>
</div>


    <script type="text/javascript">
        //checking anonymous and other things
        var mode=document.getElementById('modeofpayment');

        var dateOfCheque=document.getElementById('dateOfCheque');

        var checkNo=document.getElementById('checkNo');

        var bank=document.getElementById('bank');


        dateOfCheque.style.display="none";
        checkNo.style.display="none";
        bank.style.display="none";


        mode.addEventListener('click',function (e) {
            if (mode.value==='3') {
                dateOfCheque.style.display="block";
                checkNo.style.display="block";
                bank.style.display="block";

            }else {
                dateOfCheque.style.display="none";
                checkNo.style.display="none";
                bank.style.display="none";
            }
        });

        var showFictitious=document.getElementById('showFictitious');
        showFictitious.style.display='none';
        var Fictitious=document.getElementById('Fictitious');

        Fictitious.onclick=function(e){

            if (Fictitious.checked){
                showFictitious.style.display="block";
                document.getElementById('accountName').style.display="none";
            }else {
                showFictitious.style.display="none";
                document.getElementById('accountName').style.display="block";
            }
        };


        var cl=document.getElementById('send');
        var removechild=document.getElementById('remove');
        var b=document.getElementById('step1');
        var bulkSubmit=document.getElementById('bulkSubmit');

        document.getElementById('send').style.display="none";
        removechild.style.display="none";
        var bulk=document.getElementById('bulk');
        var notBult=document.getElementById('notBult');
        document.getElementById('header').style.display="none";


        bulk.addEventListener('click',function (e) {

            if (bulk.value==1){
                document.getElementById('form_show').style.display="none";
                cl.style.display="block";
                document.getElementById('header').style.display="block";
            }else {
                document.getElementById('header').style.display="none";
                document.getElementById('form_show').style.display="block";

            }

        });

        notBult.addEventListener('click',function (e) {

            if (notBult.value==2){
                document.getElementById('header').style.display="none";
                document.getElementById('form_show').style.display="block";
                document.getElementById('showBulk').style.display="none";
                removechild.style.display="none";
                cl.style.display="none";
            }else {
                document.getElementById('form_show').style.display="block";
                document.getElementById('showBulk').style.display="block";
                document.getElementById('bulksubmitsave').style.display='block';
            }

        });


        cl.addEventListener('click',function () {

            var div1=document.createElement('div');
            div1.classList.add('row');

            var div2=document.createElement('div');
            div2.classList.add('col-md-4');

            var label1=document.createElement('label');
            label1.classList.add('control-label');
            label1.id='adId';
            label1.for='user_id';
            // label1.innerText='Membership ID(Last 3 Digit Number)';
            div2.append(label1);

            //adding div to the main div which is div1
            div1.append(div2);
            //adding input to the label of div2
            var userId= document.createElement('input');
            userId.type="number";
            userId.name='user_id[]';
            userId.required='required';
            userId.placeholder='Membership ID(Last 3 Digit Number)',
            userId.classList.add('form-control');
            userId.id='userIss';
            userId.maxLength=3;
            userId.minLength=3;
            div2.append(userId);

            //creating another div
            var div3=document.createElement('div');
            div3.classList.add('col-md-4');
            var label2=document.createElement('label');
            label2.classList.add('control-label');
            label2.id='amount';
            label2.for='amount';
            // label2.innerText='Amount(GHS)';
            //adding label to the div created
            div3.append(label2);
            div1.append(div3);
            //creating input for the div3 label
            var input2=document.createElement('input');
            input2.name='amount[]';
            input2.id='amounts';
            input2.required='required';
            input2.placeholder='Amount(GHS)';
            input2.step='any';
            input2.type='number';
            input2.classList.add('form-control');
            div3.append(input2);


            var div0=document.createElement('div');
            div0.classList.add('col-md-4');
            var label3=document.createElement('label');
            label3.classList.add('control-label');
            label3.id='amount';
            label3.for='amount';
            // label3.innerText='select';
            // adding label to the div0 created
            div0.append(label3);

            var option =document.createElement('select');
            option.classList.add('form-control');
            option.name="modeOfPayment[]";
            option.id="modeOfPayment";
            var options1=document.createElement('option');
            options1.innerText="Cash";
            options1.value=1;
            option.append(options1);

            div0.append(option);
            div1.append(div0);
            bulkSubmit.append(div1);
        });


        removechild.addEventListener('click',function () {
            bulkSubmit.removeChild(bulkSubmit.lastElementChild);
        });

        var bulksubmitsave=document.getElementById('bulksubmitsave');
        bulksubmitsave.style.display='none';
        var total_amount=document.getElementById('total_amount');
        total_amount.style.display="none";
        var totals=document.getElementById('amountId');


        cl.addEventListener('click',function () {
            document.getElementById('bulksubmitsave').style.display='block';
            var sums=document.getElementById('amounts');
            removechild.style.display='block';

            // var initSum=0;
            //
            // for(var i=0; i<=sum.value.lengtn; i++){
            //
            //     initSum +=sum.value[i];
            // }
            var stack =sums.value;
                sum = 0;
            while(stack.length > 0) { sum += stack.pop() };

            total_amount.innerHTML=sum;
             total_amount.style.display="block";
        });























        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to post?");
            if (x)
                return true;
            else
                return false;
        }

        function searchInfo()
        {
            var x = confirm("Are you ready to search?");
            if (x)
                return true;
            else
                return false;
        }

        function bulkpost()
        {
            var x = confirm("You are about to send bulk tithe to individuals account.Click Ok to proceed Or Cancel to terminate");
            if (x)
                return true;
            else
                return false;
        }


    </script>

@endsection

