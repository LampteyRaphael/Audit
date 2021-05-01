<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class nationAdminCategoris extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        if (request()->ajax()) {

            return DataTables::of(User::query()->where('role_id',4)->get())

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
                    $toshow=route('users.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('users.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="glyphicon glyphicon-trash"></i></a>';
                    return $deletes;
                })
                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('headquarters.admin.users.localAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if (request()->ajax()) {
            return datatables()->eloquent(User::query()->where('role_id',2))

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
                    $toshow=route('users.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('users.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="fa fa-trash"></i></a>';
                    return $deletes;
                })

                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('headquarters.admin.users.areaAdmins');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            return datatables()->eloquent(User::query()->where('role_id',3))

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
                    $toshow=route('users.edit',$data->id);
                    $btn='<a class="btn btn-primary btn-xs" onclick="return ConfirmUpdate()" href="'.$toshow.'"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })

                ->addColumn('delete',function ($data){
                    $dataDeletes=route('users.destroy',$data->id);
                    $deletes='<a onclick="return ConfirmDelete()" class="btn btn-danger btn-xs" href="'. $dataDeletes.'"><i class="fa fa-trash"></i></a>';
                    return $deletes;
                })

                ->rawColumns(['toShow','delete','photo_id'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('headquarters.admin.users.districtAdmin');
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
        //
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
