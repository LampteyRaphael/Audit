      <table>
        <thead>
        <tr>
            <th>MEMBERSHIP ID</th>
            <th>NAME</th>
            <th>GENDER</th>
            <th>DATE OF BIRTH</th>
            <th>PLACE OF BIRTH </th>
            <th>HOMETOWN</th>
            <th>HOMETOWN REGION</th>
            <th>NATIONALITY</th>
            <th>LANGUAGES</th>
            <th>MARITAL STATUS</th>
            <th>MARRIAGE TYPE</th>
            <th>SPOUSE NAME</th>
            <th>NO. OF CHILDREN</th>
            <th>FATHER NAME</th>
            <th>FATHER'S HOMETOWN</th>
            <th>MOTHER'S NAME</th>
            <th>MOTHERS HOMETOWN</th>
            <th>DIGITAL ADDRESS</th>
            <th>HOUSE ADDRESS</th>
            <th>STREET NAME</th>

            <th>LANDMARK</th>
            <th>MOBILE NUMBER1</th>
            <th>MOBILE NUMBER2</th>
            <th>WORK NUMBER</th>
            <th>WHATSAPP NUMBER</th>
            <th>EMAIL</th>
            <th>EDUCATION</th>
            <th>COURSE STUDIED</th>
            <th>EMPLOYMENT TYPE</th>
            <th>PROFESSIONAL OCCUPATION </th>
            <th>PLACE OF WORK</th>
            <th>DATE JOIN THE CHURCH</th>
            <th>PREVIOUS DENOMINATION</th>
            <th>WATER BAPTISM</th>
            <th>BAPTISM BY</th>
            <th>BAPTISM DATE</th>
            <th>BAPTISM LOCALITY</th>
            <th>RIGHT HAND OF FELLOWSHIP</th>
            <th>COMMUNICANT</th>
            <th>HOLY SPIRIT BAPTISM</th>
            <th>ANY SPIRITUAL GIFT</th>
            <th>INDICATE SPIRITUAL GIFT</th>
            <th>OFFICE HELD</th>
            <th>ORDAINED BY</th>
            <th>DATE ORDAINED</th>
            <th>MOVEMENT GROUP</th>
            <th>POSITION</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->members_id}}</td>
                    <td>{{($user->name)}}</td>
                    <td>{{strtoupper($user->gender)}}</td>
                    <td>{{strtoupper($user->birthDate)}}</td>
                    <td>{{strtoupper($user->placeOfBirth)}}</td>
                    <td>{{strtoupper($user->hometown)}}</td>
                    <td>{{strtoupper($user->hometown_region)}}</td>
                    <td>{{strtoupper($user->nationality)}}</td>
                    <td>{{strtoupper($user->languagess)}}</td>
                    <td>{{strtoupper($user->maritalStatus)}}</td>
                    <td>{{strtoupper($user->mariagetype)}}</td>
                    <td>{{strtoupper($user->spouseName)}}</td>
                    <td>{{strtoupper($user->numberOfChildren)}}</td>
                    <td>{{strtoupper($user->fathers_name)}}</td>
                    <td>{{strtoupper($user->fathers_hometown)}}</td>
                    <td>{{strtoupper($user->mothers_name)}}</td>
                    <td>{{strtoupper($user->mothers_hometown)}}</td>
                    <td>{{strtoupper($user->digitalAddress)}}</td>
                    <td>{{strtoupper($user->houseaddress)}}</td>
                    <td>{{strtoupper($user->streetname)}}</td>
                    <td>{{strtoupper($user->landmark)}}</td>
                    <td>{{strtoupper($user->mobileNumber1)}}</td>
                    <td>{{strtoupper($user->mobileNumber2)}}</td>
                    <td>{{strtoupper($user->workNumber)}}</td>
                    <td>{{strtoupper($user->whatsappNumber)}}</td>
                    <td>{{strtoupper($user->email)}}</td>
                    <td>{{strtoupper($user->education)}}</td>
                    <td>{{strtoupper($user->courseStudied)}}</td>
                    <td>{{strtoupper($user->employmentType)}}</td>
                    <td>{{strtoupper($user->profOccupation)}}</td>
                    <td>{{strtoupper($user->placeOfWork)}}</td>
                    <td>{{strtoupper($user->datejoinchurch)}}</td>
                    <td>{{strtoupper($user->previousdenomination)}}</td>
                    <td>{{strtoupper($user->waterBaptism)}}</td>
                    <td>{{strtoupper($user->baptismBy)}}</td>
                    <td>{{strtoupper($user->baptismDate)}}</td>
                    <td>{{strtoupper($user->baptismLocality)}}</td>
                    <td>{{strtoupper($user->rightHandOfFellowship)}}</td>
                    <td>{{strtoupper($user->communicant)}}</td>
                    <td>{{strtoupper($user->holySpiritBaptism)}}</td>
                    <td>{{strtoupper($user->anySpiritualGift)}}</td>
                    <td>{{strtoupper($user->pleaseIndicate)}}</td>
                    <td>{{strtoupper($user->officeHeld)}}</td>
                    <td>{{strtoupper($user->ordainedBy)}}</td>
                    <td>{{strtoupper($user->dateOrdained)}}</td>
                    <td>{{strtoupper($user->movementGroup)}}</td>
                    <td>{{strtoupper($user->position)}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>