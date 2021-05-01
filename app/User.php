<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class User extends Authenticatable
{
    use Notifiable;

    protected $dates=['created_at','deleted_at'];

    protected $table='users';

    protected $guarded = array('id','members_id');

    protected $fillable = [
        'region_id',
        'local_id',
        'district_id',
        'area_id',
        'name',
        'surname',
        'othername',
        'gender',
        'birthDate',
        'placeOfBirth',
        'hometown',
        'hometown_region',
        'nationality',
        'languagess',
        'maritalStatus',
        'mariagetype',
        'spouseName',
        'numberOfChildren',
        'fathers_name',
        'fathers_hometown',
        'mothers_name',
        'mothers_hometown',
        'digitalAddress',
        'houseaddress',
        'streetname',
        'landmark',
        'mobileNumber1',
        'mobileNumber2',
        'workNumber',
        'whatsappNumber',
        'email',
        'education',
        'courseStudied',
        'employmentType',
        'profOccupation',
        'placeOfWork',
        'datejoinchurch',
        'previousdenomination',
        'waterBaptism',
        'baptismBy',
        'baptismDate',
        'baptismLocality',
        'rightHandOfFellowship',
        'communicant',
        'holySpiritBaptism',
        'anySpiritualGift',
        'pleaseIndicate',
        'officeHeld',
        'ordainedBy',
        'dateOrdained',
        'movementGroup',
        'position',
        'role_id',
        'is_active',
        'password',
        'members_id',
        'photo_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function isOnline()
    {
        return Cache::has('user-is-online-' .$this->id);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){

        return $this->belongsTo(Role::class,'role_id');
    }

    public function isAdminHeadQuarters(){

        if ($this->role->name=='national administrator' && Auth::user()->is_active==1){
            return true;
        }
        return false;
    }

    public function isAreaAdmin(){

        if ($this->role->name=='area administrator' || $this->role->name=='area anonymous' || $this->role->name=='special area administrator' && Auth::user()->is_active==1){
            return true;
        }
        return false;
    }

    public function isAdminDistrict(){
        if ($this->role->name=='district administrator' || $this->role->name=='district anonymous' || $this->role->name=='special district administrator' && Auth::user()->is_active==1){

            return true;
        }
        return false;
    }

    public  function isAdminLocal(){
        if ($this->role->name=='local administrator' || $this->role->name=='local anonymous' || $this->role->name=='special local administrator' && Auth::user()->is_active==1){

            return true;
        }
        return false;
    }

    public function isMember(){
        if ($this->role->name=='member'){

            return true;
        }
        return false;
    }

    public function photo(){

        return  $this->belongsTo(Photo::class,'photo_id');

    }

    public function posts(){

        return $this->hasMany(Post::class);
    }


    public function transfer(){

        return $this->belongsTo(Transfer::class);
    }

    public function chart(){

        return $this->hasMany(TextField::class);
    }

    public function getNameAttribute($value){

        return strtoupper($value);
    }

//    public function setBirthDateAttribute($value)
//    {
//        $this->attributes['birthDate'] = str_replace('/','-',$value);
//    }



//    public function getAttribute($value){
//
//        return strtoupper($value);
//    }


//    public function getOfficeHeldAttribute($value){
//
//        return strtoupper($value);
//    }


    public function setNameAttribute($value){

        return $this->attributes['name']=strtoupper($value);
    }

    public static function scopeGetLatest($query)
    {
        return  $query->orderBy('members_id','asc')->paginate(50);

    }

    public function local(){

        return $this->belongsTo(Locals::class,'local_id');
    }

    public  function post_tithe(){

        return $this->hasMany(PostTithe::class);
    }

    public function district(){

        return $this->belongsTo(District::class,'district_id');
    }

    public function errorLog(){

        return $this->belongsTo(ErrorLog::class);
    }

    public function area(){

        return $this->belongsTo(Area::class,'area_id');
    }

    public function region(){

        return $this->belongsTo(Region::class,'region_id');
    }

    public function atten(){

        return $this->hasMany(Attendance::class);
    }



    public function nationalitys(){

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


}
