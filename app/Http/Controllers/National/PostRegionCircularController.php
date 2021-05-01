<?php

namespace App\Http\Controllers\National;

use App\AreaCircular;
use App\Http\Controllers\Controller;
use App\LocalCircular;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostRegionCircularController extends Controller
{
    //region circulating circulating circular to locals
    public function index(){

        //Posting of circular to Locals

        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $post=AreaCircular::orderBy('created_at','desc')->whereMonth('created_at',$month)->whereYear('created_at',$year)->get();

        return view('headquarters.region.circularlocal',compact('post','month','year'));
    }


    public function store2(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $post=AreaCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        return view('headquarters.region.circularlocal',compact('post','month','year'));
    }


    public function delete($id)
    {
        try{
            $national=AreaCircular::where('id',$id)->firstOrFail();
            if (!empty($national->name)) {
                if (file_exists($national->name)) {
                    unlink(public_path().$national->name);
                }
            }
            $national->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('National not found by ID ' . $id)->withInput();
        }

        return redirect()->back()->with(['success'=>'successfully deleted']);

    }


  public function show($id){

    //Posting of circular to Locals

    $post=AreaCircular::where('id',$id)->get();

    return view('headquarters.region.pdfshow',compact('post'));
}

    public function store(Request $request){
        $input =$request->all();

        if ($file=$request->file('name')){

            $name=time().$file->getClientOriginalName();

            $file->move('NationalPdf',$name);

            AreaCircular::create(['name'=>$name]);
        }
        return redirect()->back()->with(['success1'=>'Successfully Posted Circular']);
    }
}
