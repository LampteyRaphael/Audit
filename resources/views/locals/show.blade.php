{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            MEMBERSHIP DATA--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a href="{{route('registration.index')}}" class=" btn-default btn-xs">Home</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a href="{{route('localIndividualT',$user->id)}}" class=" btn-info btn-xs">Tithe</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a class="btn-success btn-xs" href="{{route('registration.edit',$user->id)}}" id="submitUpdate">Edit</a>--}}
{{--        </p>--}}
{{--    </li>--}}

{{--@endsection--}}

{{--@section('content')--}}
@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('users')])

@section('content')
    @include('includes.alert')
    @include('includes.form_error')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Active Users</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
        <table class="table" style="text-transform: uppercase;background:#f3f3f3;">
                    <ol class="breadcrumb mb0 no-padding">
                        <li> <a href="{{route('registration.index')}}" class="btn btn-default btn-xs">Home</a></li>
                        <li> <a href="{{route('localIndividualT',$user->id)}}" class="btn btn-default btn-xs">Tithe</a></li>
                        <li> <a class="btn btn-default btn-xs" href="{{route('registration.edit',$user->id)}}" onclick="return update()">Edit</a></li>
                        <li><a class="btn btn-default btn-xs" href="">Pdf</a></li>
                    </ol>
                    <tbody>
                    <tr>
                        <td>
                            <img class="img-circle img-responsive" height="100" width="100" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt="image">
                        </td>
                        <td>
                            <ul class="nav nav-divider">
                                <li style="border-bottom: 1px solid black">REGION:</li>
                                <li style="border-bottom: 1px solid black">AREA:</li>
                                <li style="border-bottom: 1px solid black">DISTRICT:</li>
                                <li style="border-bottom: 1px solid black">LOCAL:</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav active-result">
                                <li style="border-bottom: 1px solid black">{{$user->region->name}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->area->name}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->district->name}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->local->name}}</li>
                            </ul>
                        </td>

                    </tr>
                    <tr>
                        <td style="padding: 0px; margin: 0px;">
                            PERSONAL DETAILS
                        </td>

                        <td>
                            <ul class="nav navbar" style="border-bottom: 1px solid black">
                                <li style="border-bottom: 1px solid black">FULL NAME:</li>
                                <li style="border-bottom: 1px solid black">GENDER</li>
                                <li style="border-bottom: 1px solid black">DATE OF BIRTH:</li>
                                <li style="border-bottom: 1px solid black">PLACE OF BIRTH:</li>
                                <li style="border-bottom: 1px solid black">HOME TOWN</li>
                                <li style="border-bottom: 1px solid black">HOME TOWN REGION</li>
                                <li style="border-bottom: 1px solid black">NATIONALITY</li>
                                <li style="border-bottom: 1px solid black">LANGUAGES SPOKEN</li>
                                <li style="border-bottom: 1px solid black">MARITAL STATUS</li>
                                <li style="border-bottom: 1px solid black">MARRIAGE TYPE</li>
                                <li style="border-bottom: 1px solid black">NAME OF SPOUSE</li>
                                <li style="border-bottom: 1px solid black">NUMBER OF CHILDREN</li>
                                <li style="border-bottom: 1px solid black">FATHERS NAME</li>
                                <li style="border-bottom: 1px solid black">FATHERS HOME TOWN</li>
                                <li style="border-bottom: 1px solid black">MOTHERS NAME</li>
                                <li style="border-bottom: 1px solid black">MOTHERS HOME TOWN</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">{{$user->name? $user->name:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->gender? $user->gender:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->birthDate? $user->birthDate:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->placeOfBirth? $user->placeOfBirth:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->hometown? $user->hometown:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->hometown_region? $user->hometown_region:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->nationality? $user->nationality:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->languagess? $user->languagess:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->maritalStatus? $user->maritalStatus:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->mariagetype? $user->mariagetype:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->spouseName? $user->spouseName:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->numberOfChildren? $user->numberOfChildren:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->fathers_name? $user->fathers_name:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->fathers_hometown? $user->fathers_hometown:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->mothers_name? $user->mothers_name:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->mothers_hometown? $user->mothers_hometown:'-'}}</li>

                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>CONTACT INFORMATION</td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">DIGITAL ADDRESS</li>
                                <li style="border-bottom: 1px solid black">HOUSE NUMBER</li>
                                <li style="border-bottom: 1px solid black">STREET NAME</li>
                                <li style="border-bottom: 1px solid black">LANDMARK</li>
                                <li style="border-bottom: 1px solid black">MOBILE NUMBER 1</li>
                                <li style="border-bottom: 1px solid black">MOBILE NUMBER 2</li>
                                <li style="border-bottom: 1px solid black">WORK NUMBER</li>
                                <li style="border-bottom: 1px solid black">WHATSAPP NUMBER</li>
                                <li style="border-bottom: 1px solid black">EMAIL</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">{{$user->digitalAddress?$user->digitalAddress:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->houseaddress? $user->houseaddress:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->streetname? $user->streetname:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->landmark? $user->landmark:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->mobileNumber1? $user->mobileNumber1:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->mobileNumber2? $user->mobileNumber2:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->workNumber? $user->workNumber:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->whatsappNumber? $user->whatsappNumber:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->email? $user->email:'-'}}</li>

                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            EDUCATION & PROFESSION
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">EDUCATION</li>
                                <li style="border-bottom: 1px solid black">COURSE STUDIED</li>
                                <li style="border-bottom: 1px solid black">EMPLOYMENT TYPE</li>
                                <li style="border-bottom: 1px solid black">PROFESSION/OCCUPATION</li>
                                <li style="border-bottom: 1px solid black">PLACE OF WORK</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">{{$user->education? $user->education:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->courseStudied? $user->courseStudied:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->employmentType? $user->employmentType:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->profOccupation? $user->profOccupation:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->placeOfWork? $user->placeOfWork:'-'}}</li>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            CHURCH DETAILS
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">DATE JOIN THE CHURCH</li>
                                <li style="border-bottom: 1px solid black">PREVIOUS DENOMINATION</li>
                                <li style="border-bottom: 1px solid black">WATER BAPTISM</li>
                                <li style="border-bottom: 1px solid black">BAPTISED BY</li>
                                <li style="border-bottom: 1px solid black">DATE OF BAPTISM</li>
                                <li style="border-bottom: 1px solid black">PLACE OF BAPTISM</li>
                                <li style="border-bottom: 1px solid black">RIGHT HAND OF FELLOWSHIP</li>
                                <li style="border-bottom: 1px solid black">COMMUNICANT</li>
                                <li style="border-bottom: 1px solid black">HOLY SPIRIT BAPTISM</li>
                                <li style="border-bottom: 1px solid black">ANY SPIRITUAL GIFT(S)</li>
                                <li style="border-bottom: 1px solid black">OFFICE HELD</li>
                                <li style="border-bottom: 1px solid black">ORDAINED BY</li>
                                <li style="border-bottom: 1px solid black">DATE ORDAINED</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">{{$user->datejoinchurch? $user->datejoinchurch:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->previousdenomination? $user->previousdenomination:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->waterBaptism? $user->waterBaptism:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->baptismBy? $user->baptismBy:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->baptismDate? $user->baptismDate:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->baptismLocality? $user->baptismLocality:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->rightHandOfFellowship? $user->rightHandOfFellowship:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->communicant? $user->communicant:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->holySpiritBaptism? $user->holySpiritBaptism:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->anySpiritualGift? $user->anySpiritualGift:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->pleaseIndicate? $user->pleaseIndicate:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->ordainedBy? $user->ordainedBy:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->dateOrdained? $user->dateOrdained:''}}</li>

                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>POSITION/SERVICE IN THE CHURCH</td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">MOVEMENT/GROUP</li>
                                <li style="border-bottom: 1px solid black">POSITION/SERVICE IN THE CHURCH</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">{{$user->movementGroup? $user->movementGroup:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->position? $user->position:'-'}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>OFFICE USE ONLY</td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">ROLE</li>
                                <li style="border-bottom: 1px solid black">MEMBERSHIP ID</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="nav">
                                <li style="border-bottom: 1px solid black">{{$user->role? $user->role->name:'-'}}</li>
                                <li style="border-bottom: 1px solid black">{{$user->members_id? $user->members_id:'-'}}</li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
