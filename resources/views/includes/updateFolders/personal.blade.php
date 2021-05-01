<header class="text-primary text-capitalize text-md-center font-weight-bold">PERSONAL DETAILS</header>
<div class="row">
    <div class="col-4">
        <div  class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">
            <img class="" id="myImage" src="" alt="" style="max-width: 100px;">
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group has-success">
                {!! Form::label('name','Full Name (required)',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('gender','Select Gender',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                {!! Form::select('gender',[''=>'--Choose Option--','male'=>'Male','female'=>'Female'],null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">calendar_today</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('birthDate','Date Of Birth',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                {!! Form::date('birthDate',null,['class'=>'form-control' ,'placeholder'=>'YY-mm-dd']) !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">place</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('placeOfBirth','Place Of Birth',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                {!! Form::text('placeOfBirth',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">place</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('hometown','Hometown',['class'=>'bmd-label-floating  bmd-label-static font-weight-bold']) !!}
                {!! Form::text('hometown',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-4">
            <div class="input-group form-control-lg">
                <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
                </div>
                <div class="form-group has-success">
                {!! Form::label('hometown_region','Home Town Region',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('hometown_region',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
          </div>
       </div>

    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">build</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('nationality','Nationality',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('nationality',[''=>'Choose Option']+nationalities(),null,['class'=>'form-control','required'=>'required' ]) !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">build</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('languagess','Language(s) Spoken',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('languagess',null,['class'=>'form-control','required'=>'required','placeholder'=>'(eg.twi,english) max 5']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">build</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('maritalStatus','Marital Status',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('maritalStatus',[''=>'Choose Option','married'=>'Married','single'=>'Single',
                'divorce'=>'Divorce','separated'=>'Separated','widow(er)'=>'Widow(er)'
                ],null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="material-icons">build</i>
      </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">

                {!! Form::label('mariagetype','Type Of Marriage',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('mariagetype',[''=>'--Choose Option--','customary'=>'Customary','ordinance'=>'Ordinance'],null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="material-icons">category</i>
          </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('spouseName','Name Of Spouse',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('spouseName',null,['class'=>'form-control',]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="material-icons">category</i>
          </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('numberOfChildren','Number Of Children',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::number('numberOfChildren',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="material-icons">record_voice_over</i>
      </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('fathers_name',' Name Of Father',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('fathers_name',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="material-icons">category</i>
          </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('fathers_hometown','Father\'s Hometown',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('fathers_hometown',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">record_voice_over</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('mothers_name',' Name Of Mother',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('mothers_name',null,['class'=>'form-control','id'=>'mothers_name','required'=>'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('mothers_hometown','Mother\'s  Hometown',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('mothers_hometown',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
</div>


<?php

  function nationalities(){
    return  $nationaliyty=[
        "afghan"=>"afghan",
        "albanian"=> "albanian",
        "algerian"=> "algerian",
        "american"=>"american",
        "andorran"=> "andorran",
        "angolan"=>"angolan",
        "antiguans"=> "antiguans",
        "argentinean"=> "argentinean",
        "armenian"=> "armenian",
        "australian"=>"australian",
        "austrian"=>"austrian",
        "azerbaijani"=>"azerbaijani",
        "bahamian"=>"bahamian",
        "bahraini"=> "bahraini",
        "bangladeshi"=>"bangladeshi",
        "barbadian"=>"barbadian",
        "barbudans"=>"barbudans",
        "batswana"=>"batswana",
        "belarusian"=> "belarusian",
        "belgian"=> "belarusian",
        "belizean"=>"belizean",
        "beninese"=>"beninese",
        "bhutanese"=>"bhutanese",
        "bolivian"=> "bolivian",
        "bosnian"=>"bosnian",
        "brazilian"=>"brazilian",
        "british"=>"british",
        "bruneian"=> "bruneian",
        "bulgarian"=>"bulgarian",
        "burkinabe"=> "burkinabe",
        "burmese"=>"burmese",
        "burundian"=>"burundian",
        "cambodian"=>"cambodian",
        "cameroonian"=> "cameroonian",
        "canadian"=> "canadian",
        "cape verdean"=> "cape verdean",
        "central african"=>"central african",
        "chadian"=>"chadian",
        "chilean"=>"chilean",
        "chinese"=> "chinese",
        "colombian"=>"colombian",
        "comoran"=>"comoran",
        "congolese"=>"congolese",
        "costa rican"=> "costa rican",
        "croatian"=> "croatian",
        "cuban"=>"cuban",
        "cypriot"=>"cypriot",
        "czech"=>  "czech",
        "danish"=>"danish",
        "djibouti"=> "djibouti",
        "dominican"=>"dominican",
        "dutch"=>"dutch",
        "east timorese"=> "east timorese",
        "ecuadorean"=>"ecuadorean",
        "egyptian"=>"egyptian",
        "emirian"=>"emirian",
        "equatorial guinean"=>"equatorial guinean",
        "eritrean"=>"eritrean",
        "estonian"=>"estonian",
        "ethiopian"=> "ethiopian",
        "fijian"=> "fijian",
        "filipino"=>"filipino",
        "finnish"=>"finnish",
        "french"=> "french",
        "gabonese"=>"gabonese",
        "gambian"=>"gambian",
        "georgian"=>"georgian",
        "german"=>"german",
        "ghanaian"=>"ghanaian",
        "greek"=> "greek",
        "grenadian"=>"grenadian",
        "guatemalan"=> "guatemalan",
        "guinea-bissauan"=> "guinea-bissauan",
        "guinean"=> "guinean",
        "guyanese"=>  "guyanese",
        "haitian"=>"haitian",
        "herzegovinian"=> "herzegovinian",
        "honduran"=>"honduran",
        "hungarian"=> "hungarian",
        "icelander"=> "icelander",
        "indian"=> "indian",
        "indonesian"=>"indonesian",
        "iranian"=>  "iranian",
        "iraqi"=>"iraqi",
        "irish"=> "irish",
        "israeli"=>"israeli",
        "italian"=>"italian",
        "ivorian"=> "ivorian",
        "jamaican"=>"jamaican",
        "japanese"=>"japanese",
        "jordanian"=> "jordanian",
        "kazakhstani"=>"kazakhstani",
        "kenyan"=> "kenyan",
        "kittian and nevisian"=>"kittian and nevisian",
        "kuwaiti"=>"kuwaiti",
        "kyrgyz"=> "kyrgyz",
        "laotian"=> "laotian",
        "latvian"=>"latvian",
        "lebanese"=>"lebanese",
        "liberian"=> "liberian",
        "libyan"=> "libyan",
        "liechtensteiner"=>"liechtensteiner",
        "lithuanian"=>"lithuanian",
        "luxembourger"=> "luxembourger",
        "macedonian"=>"macedonian",
        "malagasy"=> "malagasy",
        "malawian"=>"malawian",
        "malaysian"=> "malaysian",
        "maldivan"=>  "maldivan",
        "malian"=>  "malian",
        "maltese"=>"maltese",
        "marshallese"=>"marshallese",
        "mauritanian"=> "mauritanian",
        "mauritian"=> "mauritian",
        "mexican"=> "mexican",
        "micronesian"=>"micronesian",
        "moldovan"=>"moldovan",
        "monacan"=> "monacan",
        "mongolian"=>   "mongolian",
        "moroccan"=>  "moroccan",
        "mosotho"=>"mosotho",
        "motswana"=> "motswana",
        "mozambican"=> "mozambican",
        "namibian"=>"namibian",
        "nauruan"=> "nauruan",
        "nepalese"=>"nepalese",
        "new zealander"=> "new zealander",
        "ni-vanuatu"=> "ni-vanuatu",
        "nicaraguan"=>"nicaraguan",
        "nigerien"=>  "nigerien",
        "north korean"=>"north korean",
        "northern irish"=> "northern irish",
        "norwegian"=>"norwegian",
        "omani"=> "omani",
        "pakistani"=> "pakistani",
        "palauan"=> "palauan",
        "panamanian"=>  "panamanian",
        "papua new guinean"=> "papua new guinean",
        "paraguayan"=>  "paraguayan",
        "peruvian"=>  "peruvian",
        "polish"=>  "polish",
        "portuguese"=>  "portuguese",
        "qatari"=> "qatari",
        "romanian"=> "romanian",
        "russian"=>"russian",
        "rwandan"=> "rwandan",
        "saint lucian"=>"saint lucian",
        "salvadoran"=> "salvadoran",
        "samoan"=>  "samoan",
        "san marinese"=>"san marinese",
        "sao tomean"=> "sao tomean",
        "saudi"=>"saudi",
        "scottish"=>"scottish",
        "senegalese"=> "senegalese",
        "serbian"=> "serbian",
        "seychellois"=>  "seychellois",
        "sierra leonean"=>"sierra leonean",
        "singaporean"=> "singaporean",
        "slovakian"=> "slovakian",
        "slovenian"=>  "slovenian",
        "solomon islander"=> "solomon islander",
        "somali"=>   "somali",
        "south african"=> "south african",
        "south korean"=> "south korean",
        "spanish"=>"spanish",
        "sri lankan"=> "sri lankan",
        "sudanese"=> "sudanese",
        "surinamer"=> "surinamer",
        "swazi"=> "swazi",
        "swedish"=>  "swedish",
        "swiss"=>  "swiss",
        "syrian"=> "syrian",
        "taiwanese"=> "taiwanese",
        "tajik"=> "tajik",
        "tanzanian"=> "tanzanian",
        "thai"=> "thai",
        "togolese"=> "togolese",
        "tongan"=> "tongan",
        "trinidadian or tobagonian"=>  "trinidadian or tobagonian",
        "tunisian"=>"tunisian",
        "turkish"=>  "turkish",
        "tuvaluan"=>  "tuvaluan",
        "ugandan"=> "ugandan",
        "ukrainian"=> "ukrainian",
        "uruguayan"=> "uruguayan",
        "uzbekistani"=>  "uzbekistani",
        "venezuelan"=>"venezuelan",
        "vietnamese"=> "vietnamese",
        "welsh"=> "welsh",
        "yemenite"=>"yemenite",
        "zambian"=> "zambian",
        "zimbabwean"=> "zimbabwean",
    ];
}
?>

