<?php

namespace App\Http\Controllers\Area;

use App\AuditTrail;
use App\District;
use App\Expenditure;
use App\ExpenditureCategory;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class PostAreaAccountController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function members(Request $request){
        $areaName=Auth::user()->area->name;
        if ($request->ajax()) {
            $area_id=Auth::user()->area_id;
            $data=User::query()->where('area_id',$area_id)
                ->where('officeHeld','!=','children ministry')
                ->where('is_active',1)
                ->whereIn('role_id',[1,2,3,4,5]);

            return DataTables::eloquent($data)

                ->addColumn('role_id', function($data){
                    $Mids=$data->role? strtoupper($data->role->name): '';
                    return $Mids;
                })

                ->addColumn('area_id',function ($data){
                    $district=$data->district? strtoupper($data->district->name):'';
                    return $district;
                })

                ->addColumn('district_id',function ($data){
                    $area=$data->district? strtoupper($data->area->name):'';
                    return $area;
                })

                ->addColumn('local_id',function ($data){
                    $local=$data->local? strtoupper($data->local->name):'';
                    return $local;
                })

                ->addColumn('is_active',function ($data){
                    $role=$data->is_active==1? strtoupper('Active'):strtoupper('Not Active');
                    return $role;
                })

                ->addColumn('datesOfBirth',function ($data){
                    $age= Carbon::parse(date("Y-m-d", strtotime($data->birthDate)))->age;
                    return $age;
                })

                ->addColumn('created_at', function($data){
                    $createdAt=$data->created_at->diffForHumans();
                    return $createdAt;
                })

                ->addColumn('photo_id', function ($data) {
                    $url=$data->photo? $data->photo->file :asset('images/placeholder.png');
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
                })

                ->addColumn('toShow', function($data){
                    $toshow=route('Admins.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('Admins.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $deletes;
                })
                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
    return view('area.churchaccount.members');
    }


    public function children(){

        $area_id=Auth::user()->area_id;

        $users=User::where('area_id',$area_id)->where('is_active',1)->where('officeHeld','children ministry')->whereIn('role_id',[1,2,3,4,5])->GetLatest();

        $areaName=Auth::user()->area->name;

        return view('area.churchaccount.children',compact('users','areaName'));
    }

    public function noneChildren(){

        $area_id=Auth::user()->area_id;

        $users=User::where('area_id',$area_id)->where('is_active',3)->where('officeHeld','children ministry')->whereIn('role_id',[1,2,3,4,5])->GetLatest();

        $areaName=Auth::user()->area->name;

        return view('area.churchaccount.Nonechildren',compact('users','areaName'));
    }


    public function none(){
        $area_id=Auth::user()->area_id;

        $areaName=Auth::user()->area->name;
        if (request()->ajax()) {
            return datatables()->collection(User::query()->where('area_id',$area_id)->where('is_active',1)->whereIn('role_id',[1,2,3,4,5])->where('officeHeld','new convert')->get())

                ->addColumn('role_id', function($data){
                    $Mids=$data->role? strtoupper($data->role->name): '';
                    return $Mids;
                })

                ->addColumn('area_id',function ($data){
                    $district=$data->district? strtoupper($data->district->name):'';
                    return $district;
                })

                ->addColumn('district_id',function ($data){
                    $area=$data->district? strtoupper($data->area->name):'';
                    return $area;
                })

                ->addColumn('local_id',function ($data){
                    $local=$data->local? strtoupper($data->local->name):'';
                    return $local;
                })

                ->addColumn('is_active',function ($data){
                    $role=$data->is_active==1? strtoupper('Active'):strtoupper('Not Active');
                    return $role;
                })

                ->addColumn('datesOfBirth',function ($data){
                    $age= Carbon::parse(date("Y-m-d", strtotime($data->birthDate)))->age;
                    return $age;
                })

                ->addColumn('created_at', function($data){
                    $createdAt=$data->created_at->diffForHumans();
                    return $createdAt;
                })

                ->addColumn('photo_id', function ($data) {
                    $url=$data->photo? $data->photo->file :asset('images/placeholder.png');
                    return '<img class="img-rounded" height="50" width="50" src="'.$url.'" alt="">';
                })

                ->addColumn('toShow', function($data){
                    $toshow=route('waiting.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('waiting.edit',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $deletes;
                })
                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('area.churchaccount.noneactive',compact('areaName'));
    }


    public function tray()
    {
        $area_id=Auth::user()->area_id;

        $district_id=District::where('area_id', $area_id  )->pluck('id');

        $id=Locals::whereIn('district_id',$district_id)->pluck('id');

        $users=AuditTrail::whereIn('local_id',$id)->GetLatest();

        return view('area.tray',compact('users'));
    }


    public function printStatementY(Request $request)
    {
        $post = $request->all();
        //show monthly contributions
        if ($post) {
            $year = $post['year'];
            $id = $post['local_id'];
        } else {
            $id = Auth::user()->local_id;
            $year = Carbon::now()->year;
        }

        $idd = Auth::user()->area_id;
        $d = District::where('area_id', $idd)->pluck('id');

        $local = Locals::whereIn('district_id', $d)->pluck('name', 'id')->all();

        $date = $year;
        $incomeCategory = incomeCategory::all()
            ->where("local_id", $id);

        $total = income::where("local_id", $id)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $expenditureCategory = ExpenditureCategory::all()->where("local_id", $id);

        $totalExpenditure = Expenditure::where("local_id", $id)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $totalTithe = PostTithe::where('local_id', $id)
            ->whereYear('created_at', $year)->pluck('amount')->sum();

        $pdf = PDF::loadView('area.churchaccount.yearsprint', compact(
            'incomeCategory', 'totalTithe', 'total', 'post', 'local', 'totalExpenditure', 'expenditureCategory'
        ))->setPaper('a4');

        return $pdf->stream('Year.pdf');
    }
}