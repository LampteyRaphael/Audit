<?php

namespace App\Http\Controllers\national;

use App\Area;
use App\District;
use App\Locals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class districtSwappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =District::get(['id','name']);
            return Datatables::of($data)
                ->EditColumn('name', function($data){
                    $name=strtoupper( $data->name? $data->name:'');
                    $toshow=route('DistrictSwapping.show',$data->id);
                    $btn='<a class="" onclick="return ConfirmUpdate()" href="'.$toshow.'">'.$name.'</a>';
                    return $btn;
                })
                ->rawColumns(['name'])

                ->make(true);
        }

        $districts=null;

        return view('headquarters.swap.district',compact('districts'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $districts=District::where('id',$id)->get();
        $locals=District::GetLatest();
        $areass=Area::pluck('name','id')->all();
        return view('headquarters.swap.district',compact('districts','locals','areass'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //swapping to district
        //swapping a local to district
        $post=District::findorFail($id);

        $post->update(['area_id'=>$request['area_id']]);

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
