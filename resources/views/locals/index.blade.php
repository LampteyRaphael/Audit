@extends('layouts.app', ['activePage' => 'churchMembers', 'titlePage' => __('Active Church Members')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <input type="hidden" value="{{Session::get('success1')}}" class="showsupdate">
            <div class="row">
                <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Search Church Member</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['method'=>'POST','action'=>'Locals\LocalMembersSearchController@store'])!!}

                                <div class="form-group">
                                    {!! Form::text('search',null,['class'=>'form-control','placeholder'=>'Search Church Members','required'=>'search']) !!}
                                </div>
                            </div>
                            <div class="modal-footer text-md-center">
                                {!! Form::submit('Search',['class'=>'btn btn-sm btn-info']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Membership Data Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['method'=>'POST','action'=>'Locals\RegisterLocalMembersController@store','files'=>true, 'onsubmit'=>'return ConfirmDelete()'])!!}
                                @include('includes.localFolder.local_head')
                                @include('includes.registrationFolder.personal')
                                @include('includes.registrationFolder.contact')
                                @include('includes.registrationFolder.educationProfession')
                                @include('includes.registrationFolder.churchDetails')
                                @include('includes.registrationFolder.provisionService')
                                @include('includes.localFolder.localFooter')
                                {!! Form::close() !!}
                            </div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
                </div>
            </div>


{{--            ######################### update of users #########--}}

            <div class="modal fade" id="editUser"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="card card-signup card-plain">
                        <div class="modal-header">
                            <h5 class="modal-title">update</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div id="app">
                                <personal-information></personal-information>
                            </div>
                            {!! Form::open(['method'=>'PATCH','action'=>['Locals\RegisterLocalMembersController@update','updating'],'files'=>true, 'onsubmit'=>'return ConfirmUpdate()'],['class'=>''])!!}
                            @include('includes.localFolder.updateHeader')

                            @include('includes.updateFolders.personal')
                            @include('includes.updateFolders.contact')
                            @include('includes.updateFolders.educationProfession')
                            @include('includes.updateFolders.churchDetails')
                            @include('includes.updateFolders.provisionServices')
                            @include('includes.localFolder.updateFooter')
                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            ################### end of update of users ##############--}}
            @include('includes.alert')
            @include('includes.form_error')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-pills">
                            <h4 class="card-title ">Active Users</h4>
                            <p class="card-category text-primary"> Manage users</p>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-primary">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link btn btn-primary btn-fab btn-round" href="javascript:(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addUser">{{ __('Add User') }}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#search">{{ __('Search Church Member') }}</a>
                                                <a class="dropdown-item" href="{{route('storeExcel')}}">{{ __('Export to Excel') }}</a>
                                                <a class="dropdown-item" href="{{route('mychart')}}">{{ __('Chart') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('None Active Users') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('New Convert') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('New Entrant') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('Deceased') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('Anonymous User') }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGES</th>
                                        <th>NAME</th>
                                        <th>GENDER</th>
                                        <th>MOBILE</th>
                                        <th>Email</th>
                                        <th>OFFICE HELD </th>
                                        <th>AGE</th>
                                        <th>YRS IN CH.</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($users)
                                        @foreach($users as $user)
                                            <tr>
                                                <input type="hidden" class="userID" value="{{$user->id}}">
                                                <td>{{$user->members_id? $user->members_id:''}}</td>
                                                <td  rel="tooltip" title="">
                                                    <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">
                                                        <img src="{{$user->photo? $user->photo->file :asset('images/placeholder.png') }}" alt="" style="max-width: 100px;">
                                                    </div>
                                                </td>
                                                <td>{{($user->name? $user->name:'')}}</td>
                                                <td rel="tooltip" title="{{$user->gender}}">{{strtoupper($user->gender? $user->gender:'')}}</td>
                                                <td rel="tooltip" title="{{$user->mobileNumber1}}/{{$user->mobileNumber2}}">{{$user->mobileNumber1? $user->mobileNumber1:''}}</td>
                                                <td>{{$user->mobileNumber2 ? $user->mobileNumber2:''}}</td>
                                                <td rel="tooltip" title="{{$user->email}}">{{strtoupper($user->email? $user->email:'')}}</td>
                                                <td rel="tooltip" title="{{$user->officeHeld}}">{{strtoupper($user->officeHeld? $user->officeHeld:'' )}}</td>
                                                <td rel="tooltip" title="{{$user->birthDate}}">{{Carbon\Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age}}</td>
                                                <td rel="tooltip" title="{{$user->datejoinchurch}}">{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                                 ->format('%y years,%m months,%d days'))}}</td>
{{--
{{--                                                <td class="td-actions text-right">--}}
{{--                                                    <a href="javascript:(0)"--}}
{{--                                                       data-digital="{{$user->digitalAddress}}"--}}
{{--                                                       data-houseaddress="{{$user->houseaddress}}"--}}
{{--                                                       data-streetname="{{$user->streetname}}"--}}
{{--                                                       data-mobile="{{$user->mobileNumber1}}"--}}
{{--                                                       data-mobile2="{{$user->mobileNumber2}}"--}}
{{--                                                       data-e_mail="{{$user->email}}"--}}
{{--                                                       data-landmark="{{$user->landmark}}"--}}
{{--                                                       data-workNumber="{{$user->workNumber}}"--}}


{{--                                                       data-toggle="modal" data-target="#editUser" rel="tooltip" class="btn btn-info btn-round " data-original-title="details" title="{{$user->name}}  Edit his Profile">--}}
{{--                                                        <i class="material-icons">person</i>--}}
{{--                                                        <div class="ripple-container"></div></a>--}}
{{--                                                </td>--}}


{{--                                                <td class="td-actions text-left">--}}
{{--                                                    {!! Form::model($user,['method'=>'DELETE','action'=>['Locals\RegisterLocalMembersController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()',],['class'=>'form-inline'])!!}--}}
{{--                                                    <button type="submit" rel="tooltip" class="btn btn-danger btn-round" data-original-title="delete" title="CLICK HERE TO DELETE {{$user->name}} FROM THE SYSTEM">--}}
{{--                                                        <i class="material-icons input-field" >delete</i>--}}
{{--                                                        <div class="ripple-container"></div>--}}
{{--                                                    </button>--}}
{{--                                                    {!! Form::close() !!}--}}

{{--                                                </td>--}}

                                                <td>
                                                    <ul class="navbar-nav">
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                                <a href="javascript:(0)"
                                                                   data-ids="{{$user->id}}"
                                                                   data-username="{{$user->name}}"
                                                                   data-genders="{{$user->gender? $user->gender:''}}"
                                                                   data-birth="{{$user->birthDate}}"
                                                                   data-placeofbirth="{{$user->placeOfBirth}}"
                                                                   data-hometown="{{$user->hometown}}"
                                                                   data-hometownregion="{{$user->hometown_region}}"
                                                                   data-nationality="{{$user->nationality}}"
                                                                   data-digital="{{$user->digitalAddress}}"
                                                                   data-houseaddress="{{$user->houseaddress}}"
                                                                   data-streetname="{{$user->streetname}}"
                                                                   data-mobile="{{$user->mobileNumber1}}"
                                                                   data-mobile2="{{$user->mobileNumber2}}"
                                                                   data-e_mail="{{$user->email}}"
                                                                   data-landmark="{{$user->landmark}}"
                                                                   data-workNumber="{{$user->workNumber}}"
                                                                   data-education="{{$user->education}}"
                                                                   data-course="{{$user->courseStudied}}"
                                                                   data-employment="{{$user->employmentType}}"
                                                                   data-occupation="{{$user->profOccupation}}"
                                                                   data-work="{{$user->placeOfWork}}"
                                                                   data-movement="{{$user->movementGroup}}"
                                                                   data-positions="{{$user->position}}"
                                                                   data-datejoinchurch="{{$user->datejoinchurch}}"
                                                                   data-denomination="{{$user->previousdenomination}}"
                                                                   data-baptism="{{$user->waterBaptism}}"
                                                                   data-baptismby="{{$user->baptismBy}}"
                                                                   data-baptismdate="{{$user->baptismDate}}"
                                                                   data-baptismlocality="{{$user->baptismLocality}}"
                                                                   data-fellowship="{{$user->rightHandOfFellowship}}"
                                                                   data-communicants="{{$user->communicant}}"
                                                                   data-spiritbaptism="{{$user->holySpiritBaptism}}"
                                                                   data-anyspiritualgift="{{$user->anySpiritualGift}}"
                                                                   data-pleaseindicate="{{$user->pleaseIndicate}}"
                                                                   data-office="{{$user->officeHeld}}"
                                                                   data-photo="{{$user->photo? $user->photo->file:''}}"
                                                                   data-lang="{{$user->languagess}}"
                                                                   data-maritalstatu="{{$user->maritalStatus}}"
                                                                   data-marriagetypes="{{$user->mariagetype}}"
                                                                   data-spousename="{{$user->spouseName}}"
                                                                   data-numberchildren="{{$user->numberOfChildren}}"
                                                                   data-fathersname="{{$user->fathers_name}}"
                                                                   data-fathershometown="{{$user->fathers_hometown}}"
                                                                   data-mothersname="{{$user->mothers_name}}"
                                                                   data-mothershometown="{{$user->mothers_hometown}}"
                                                                   data-isactive="{{$user->is_active}}"
                                                                   data-roleid="{{$user->role_id}}"
                                                                   data-membersid="{{$user->members_id}}"
                                                                   data-toggle="modal" data-target="#editUser" class="dropdown-item" >
                                                                    <i  class="material-icons">edit</i>{{ __('Edit') }}
                                                                </a>
                                                                <a class="dropdown-item deleteButton" href="#"><i class="material-icons">delete </i>{{ __('Delete') }}</a>

                                                                <a  class="dropdown-item" data-toggle="modal" data-target="#detailsButton"  href="javascript:(0);"><i class="material-icons">details</i>{{ __('Details') }}</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right">
                                {{$users->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    user details--}}
    <div class="modal fade" id="detailsButton" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Member Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul>
                        <li id="name"></li>
                    </ul>

                </div>
                <div class="modal-footer text-md-center">

                </div>
            </div>
        </div>
    </div>
<!--    --><?php //function nationality(){ return  $nationaliyty=[
//            "afghan"=>"afghan",
//            "albanian"=> "albanian",
//            "algerian"=> "algerian",
//            "american"=>"american",
//            "andorran"=> "andorran",
//            "angolan"=>"angolan",
//            "antiguans"=> "antiguans",
//            "argentinean"=> "argentinean",
//            "armenian"=> "armenian",
//            "australian"=>"australian",
//            "austrian"=>"austrian",
//            "azerbaijani"=>"azerbaijani",
//            "bahamian"=>"bahamian",
//            "bahraini"=> "bahraini",
//            "bangladeshi"=>"bangladeshi",
//            "barbadian"=>"barbadian",
//            "barbudans"=>"barbudans",
//            "batswana"=>"batswana",
//            "belarusian"=> "belarusian",
//            "belgian"=> "belarusian",
//            "belizean"=>"belizean",
//            "beninese"=>"beninese",
//            "bhutanese"=>"bhutanese",
//            "bolivian"=> "bolivian",
//            "bosnian"=>"bosnian",
//            "brazilian"=>"brazilian",
//            "british"=>"british",
//            "bruneian"=> "bruneian",
//            "bulgarian"=>"bulgarian",
//            "burkinabe"=> "burkinabe",
//            "burmese"=>"burmese",
//            "burundian"=>"burundian",
//            "cambodian"=>"cambodian",
//            "cameroonian"=> "cameroonian",
//            "canadian"=> "canadian",
//            "cape verdean"=> "cape verdean",
//            "central african"=>"central african",
//            "chadian"=>"chadian",
//            "chilean"=>"chilean",
//            "chinese"=> "chinese",
//            "colombian"=>"colombian",
//            "comoran"=>"comoran",
//            "congolese"=>"congolese",
//            "costa rican"=> "costa rican",
//            "croatian"=> "croatian",
//            "cuban"=>"cuban",
//            "cypriot"=>"cypriot",
//            "czech"=>  "czech",
//            "danish"=>"danish",
//            "djibouti"=> "djibouti",
//            "dominican"=>"dominican",
//            "dutch"=>"dutch",
//            "east timorese"=> "east timorese",
//            "ecuadorean"=>"ecuadorean",
//            "egyptian"=>"egyptian",
//            "emirian"=>"emirian",
//            "equatorial guinean"=>"equatorial guinean",
//            "eritrean"=>"eritrean",
//            "estonian"=>"estonian",
//            "ethiopian"=> "ethiopian",
//            "fijian"=> "fijian",
//            "filipino"=>"filipino",
//            "finnish"=>"finnish",
//            "french"=> "french",
//            "gabonese"=>"gabonese",
//            "gambian"=>"gambian",
//            "georgian"=>"georgian",
//            "german"=>"german",
//            "ghanaian"=>"ghanaian",
//            "greek"=> "greek",
//            "grenadian"=>"grenadian",
//            "guatemalan"=> "guatemalan",
//            "guinea-bissauan"=> "guinea-bissauan",
//            "guinean"=> "guinean",
//            "guyanese"=>  "guyanese",
//            "haitian"=>"haitian",
//            "herzegovinian"=> "herzegovinian",
//            "honduran"=>"honduran",
//            "hungarian"=> "hungarian",
//            "icelander"=> "icelander",
//            "indian"=> "indian",
//            "indonesian"=>"indonesian",
//            "iranian"=>  "iranian",
//            "iraqi"=>"iraqi",
//            "irish"=> "irish",
//            "israeli"=>"israeli",
//            "italian"=>"italian",
//            "ivorian"=> "ivorian",
//            "jamaican"=>"jamaican",
//            "japanese"=>"japanese",
//            "jordanian"=> "jordanian",
//            "kazakhstani"=>"kazakhstani",
//            "kenyan"=> "kenyan",
//            "kittian and nevisian"=>"kittian and nevisian",
//            "kuwaiti"=>"kuwaiti",
//            "kyrgyz"=> "kyrgyz",
//            "laotian"=> "laotian",
//            "latvian"=>"latvian",
//            "lebanese"=>"lebanese",
//            "liberian"=> "liberian",
//            "libyan"=> "libyan",
//            "liechtensteiner"=>"liechtensteiner",
//            "lithuanian"=>"lithuanian",
//            "luxembourger"=> "luxembourger",
//            "macedonian"=>"macedonian",
//            "malagasy"=> "malagasy",
//            "malawian"=>"malawian",
//            "malaysian"=> "malaysian",
//            "maldivan"=>  "maldivan",
//            "malian"=>  "malian",
//            "maltese"=>"maltese",
//            "marshallese"=>"marshallese",
//            "mauritanian"=> "mauritanian",
//            "mauritian"=> "mauritian",
//            "mexican"=> "mexican",
//            "micronesian"=>"micronesian",
//            "moldovan"=>"moldovan",
//            "monacan"=> "monacan",
//            "mongolian"=>   "mongolian",
//            "moroccan"=>  "moroccan",
//            "mosotho"=>"mosotho",
//            "motswana"=> "motswana",
//            "mozambican"=> "mozambican",
//            "namibian"=>"namibian",
//            "nauruan"=> "nauruan",
//            "nepalese"=>"nepalese",
//            "new zealander"=> "new zealander",
//            "ni-vanuatu"=> "ni-vanuatu",
//            "nicaraguan"=>"nicaraguan",
//            "nigerien"=>  "nigerien",
//            "north korean"=>"north korean",
//            "northern irish"=> "northern irish",
//            "norwegian"=>"norwegian",
//            "omani"=> "omani",
//            "pakistani"=> "pakistani",
//            "palauan"=> "palauan",
//            "panamanian"=>  "panamanian",
//            "papua new guinean"=> "papua new guinean",
//            "paraguayan"=>  "paraguayan",
//            "peruvian"=>  "peruvian",
//            "polish"=>  "polish",
//            "portuguese"=>  "portuguese",
//            "qatari"=> "qatari",
//            "romanian"=> "romanian",
//            "russian"=>"russian",
//            "rwandan"=> "rwandan",
//            "saint lucian"=>"saint lucian",
//            "salvadoran"=> "salvadoran",
//            "samoan"=>  "samoan",
//            "san marinese"=>"san marinese",
//            "sao tomean"=> "sao tomean",
//            "saudi"=>"saudi",
//            "scottish"=>"scottish",
//            "senegalese"=> "senegalese",
//            "serbian"=> "serbian",
//            "seychellois"=>  "seychellois",
//            "sierra leonean"=>"sierra leonean",
//            "singaporean"=> "singaporean",
//            "slovakian"=> "slovakian",
//            "slovenian"=>  "slovenian",
//            "solomon islander"=> "solomon islander",
//            "somali"=>   "somali",
//            "south african"=> "south african",
//            "south korean"=> "south korean",
//            "spanish"=>"spanish",
//            "sri lankan"=> "sri lankan",
//            "sudanese"=> "sudanese",
//            "surinamer"=> "surinamer",
//            "swazi"=> "swazi",
//            "swedish"=>  "swedish",
//            "swiss"=>  "swiss",
//            "syrian"=> "syrian",
//            "taiwanese"=> "taiwanese",
//            "tajik"=> "tajik",
//            "tanzanian"=> "tanzanian",
//            "thai"=> "thai",
//            "togolese"=> "togolese",
//            "tongan"=> "tongan",
//            "trinidadian or tobagonian"=>  "trinidadian or tobagonian",
//            "tunisian"=>"tunisian",
//            "turkish"=>  "turkish",
//            "tuvaluan"=>  "tuvaluan",
//            "ugandan"=> "ugandan",
//            "ukrainian"=> "ukrainian",
//            "uruguayan"=> "uruguayan",
//            "uzbekistani"=>  "uzbekistani",
//            "venezuelan"=>"venezuelan",
//            "vietnamese"=> "vietnamese",
//            "welsh"=> "welsh",
//            "yemenite"=>"yemenite",
//            "zambian"=> "zambian",
//            "zimbabwean"=> "zimbabwean",
//        ];} ?>
@endsection
