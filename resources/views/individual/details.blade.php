@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            MEMBERSHIP DATA
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a href="{{route('IndividualProfile')}}" class=" btn-default btn-xs">Home</a>
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a href="{{route('MDTithe.index')}}" class=" btn-info btn-xs">Tithe</a>
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a class="btn-success btn-xs" href="{{route('MDTithe.create')}}" id="submitUpdate">Edit</a>
        </p>
    </li>

@endsection

@section('content')
<div class="col-md-12">
    <div class="row table-responsive">
        @include('includes.form_error')
        @include('includes.alert')
        <table class="table shadow" style="text-transform: uppercase;">
                    <ol class="breadcrumb mb0 no-padding">
                        <li> <a href="{{route('IndividualProfile')}}" class="btn btn-default btn-xs">Home</a></li>
                        <li> <a href="{{route('MDTithe.index')}}" class="btn btn-default btn-xs">Tithe</a></li>
                        <li> <a class="btn btn-default btn-xs" href="{{route('MDTithe.create')}}" onclick="return update()">Edit</a></li>
                        <li><a class="btn btn-default btn-xs" href="">Pdf</a></li>
                    </ol>
                    <tbody>
                    <tr>
                        <td>
                            <img class="img-circle img-responsive" height="150" width="150" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt="image">
                        </td>
                        <td>
                            LOCATION
                        </td>
                        <td>
                            <ul class="nav">
                                <li>REGION:</li>
                                <li>AREA:</li>
                                <li>DISTRICT:</li>
                                <li>LOCAL:</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav active-result">
                                <li>{{$user->region->name}}</li>
                                <li>{{$user->area->name}}</li>
                                <li>{{$user->district->name}}</li>
                                <li>{{$user->local->name}}</li>
                            </ul>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            PERSONAL DETAILS
                        </td>
                        <td>
                            <ul class="nav">
                                <li>FULL NAME:</li>
                                <li>GENDER</li>
                                <li>DATE OF BIRTH:</li>
                                <li>PLACE OF BIRTH:</li>
                                <li>HOME TOWN</li>
                                <li>HOME TOWN REGION</li>
                                <li>NATIONALITY</li>
                                <li>LANGUAGES SPOKEN</li>
                                <li>MARITAL STATUS</li>
                                <li>MARRIAGE TYPE</li>
                                <li>NAME OF SPOUSE</li>
                                <li>NUMBER OF CHILDREN</li>
                                <li>FATHERS NAME</li>
                                <li>FATHERS HOME TOWN</li>
                                <li>MOTHERS NAME</li>
                                <li>MOTHERS HOME TOWN</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav">
                                <li>{{$user->name}}</li>
                                <li>{{$user->gender}}</li>
                                <li>{{$user->birthDate}}</li>
                                <li>{{$user->placeOfBirth}}</li>
                                <li>{{$user->hometown}}</li>
                                <li>{{$user->hometown_region}}</li>
                                <li>{{$user->nationality}}</li>
                                <li>{{$user->languagess}}</li>
                                <li>{{$user->maritalStatus}}</li>
                                <li>{{$user->mariagetype}}</li>
                                <li>{{$user->spouseName}}</li>
                                <li>{{$user->numberOfChildren}}</li>
                                <li>{{$user->fathers_name}}</li>
                                <li>{{$user->fathers_hometown}}</li>
                                <li>{{$user->mothers_name}}</li>
                                <li>{{$user->mothers_hometown}}</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>CONTACT INFORMATION</td>
                        <td>
                            <ul class="nav">
                                <li>DIGITAL ADDRESS</li>
                                <li>HOUSE NUMBER</li>
                                <li>STREET NAME</li>
                                <li>LANDMARK</li>
                                <li>MOBILE NUMBER 1</li>
                                <li>MOBILE NUMBER 2</li>
                                <li>WORK NUMBER</li>
                                <li>WHATSAPP NUMBER</li>
                                <li>EMAIL</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav">
                                <li>{{$user->digitalAddress}}</li>
                                <li>{{$user->houseaddress}}</li>
                                <li>{{$user->streetname}}</li>
                                <li>{{$user->landmark}}</li>
                                <li>{{$user->mobileNumber1}}</li>
                                <li>{{$user->mobileNumber2}}</li>
                                <li>{{$user->workNumber}}</li>
                                <li>{{$user->whatsappNumber}}</li>
                                <li>{{$user->email}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            EDUCATION & PROFESSION
                        </td>
                        <td>
                            <ul class="nav">
                                <li>EDUCATION</li>
                                <li>COURSE STUDIED</li>
                                <li>EMPLOYMENT TYPE</li>
                                <li>PROFESSION/OCCUPATION</li>
                                <li>PLACE OF WORK</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav">
                                <li>{{$user->education}}</li>
                                <li>{{$user->courseStudied}}</li>
                                <li>{{$user->employmentType}}</li>
                                <li>{{$user->profOccupation}}</li>
                                <li>{{$user->placeOfWork}}</li>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            CHURCH DETAILS
                        </td>
                        <td>
                            <ul class="nav">
                                <li>DATE JOIN THE CHURCH</li>
                                <li>PREVIOUS DENOMINATION</li>
                                <li>WATER BAPTISM</li>
                                <li>BAPTISED BY</li>
                                <li>DATE OF BAPTISM</li>
                                <li>PLACE OF BAPTISM</li>
                                <li>RIGHT HAND OF FELLOWSHIP</li>
                                <li>COMMUNICANT</li>
                                <li>HOLY SPIRIT BAPTISM</li>
                                <li>ANY SPIRITUAL GIFT(S)</li>
                                <li>OFFICE HELD</li>
                                <li>ORDAINED BY</li>
                                <li>DATE ORDAINED</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav">
                                <li>{{$user->datejoinchurch}}</li>
                                <li>{{$user->previousdenomination}}</li>
                                <li>{{$user->waterBaptism}}</li>
                                <li>{{$user->baptismBy}}</li>
                                <li>{{$user->baptismDate}}</li>
                                <li>{{$user->baptismLocality}}</li>
                                <li>{{$user->rightHandOfFellowship}}</li>
                                <li>{{$user->communicant}}</li>
                                <li>{{$user->holySpiritBaptism}}</li>
                                <li>{{$user->anySpiritualGift}}</li>
                                <li>{{$user->pleaseIndicate}}</li>
                                <li>{{$user->ordainedBy}}</li>
                                <li>{{$user->dateOrdained}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>POSITION/SERVICE IN THE CHURCH</td>
                        <td>
                            <ul class="nav">
                                <li>MOVEMENT/GROUP</li>
                                <li>POSITION/SERVICE IN THE CHURCH</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav">
                                <li>{{$user->movementGroup}}</li>
                                <li>{{$user->position}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>OFFICE USE ONLY</td>
                        <td>
                            <ul class="nav">
                                <li>ROLE</li>
                                <li>MEMBERSHIP ID</li>
                            </ul>
                        </td>
                        <td colspan="2">
                            <ul class="nav">
                                <li>{{$user->role->name}}</li>
                                <li>{{$user->members_id}}</li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
    </div>
</div>
@endsection