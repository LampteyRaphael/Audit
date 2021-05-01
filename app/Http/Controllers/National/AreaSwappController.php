<?php

namespace App\Http\Controllers\national;

use App\Area;
use App\District;
use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AreaSwappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
        $data =Area::get(['id','name']);
        return Datatables::of($data)
            ->EditColumn('name', function($data){
                $name=strtoupper( $data->name? $data->name:'');
                $toshow=route('AreaSwapping.show',$data->id);
                $btn='<a class="" onclick="return ConfirmUpdate()" href="'.$toshow.'">'.$name.'</a>';
                return $btn;
            })
            ->rawColumns(['name'])

            ->make(true);
        }

         $districts=null;

    return view('headquarters.swap.area',compact('districts'));
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $districts=Area::where('id',$id)->get();
        $locals=Area::GetLatest();
        $areass=Region::pluck('name','id')->all();
        return view('headquarters.swap.area',compact('districts','locals','areass'));
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
        //swapping a local to district
        $post=Area::findorFail($id);

        $post->update(['region_id'=>$request['region_id']]);

        return redirect()->back()->with(['success1'=>'Successfully Updated']);
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
