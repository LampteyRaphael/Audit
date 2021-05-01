<?php

namespace App\Http\Controllers\National;

use App\District;
use App\Http\Controllers\Controller;
use App\Locals;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class swapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =Locals::get(['id','name']);
            return Datatables::of($data)
                ->EditColumn('name', function($data){
                    $name=strtoupper( $data->name?$data->name:'');
                    $toshow=route('swapping.show',$data->id);
                    $btn='<a class="" onclick="return ConfirmUpdate()" href="'.$toshow.'">'.$name.'</a>';
                    return $btn;
                })
                ->rawColumns(['name'])

                ->make(true);
        }

        $districts=null;

        return view('headquarters.swap.index',compact('districts'));
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
       $districts=Locals::where('id',$id)->get();
       $locals=Locals::GetLatest();
       $districtss=District::pluck('name','id')->all();
        return view('headquarters.swap.index',compact('districts','locals','districtss'));
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
        //swapping a local to district
        $post=Locals::findorFail($id);

        $post->update($request->all());

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
