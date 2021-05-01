<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Http\Requests\AreaUpdateRequest;
use App\Locals;
use App\Region;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            return DataTables::eloquent(Area::query('id','name','area_code'))
                ->addIndexColumn()

                ->addColumn('actionA', function ($region) {

                    $showId=route('area.show',$region->id);
                    $regionNames='<a class="btn-link" href="'.$showId.'">'.$region->name.'</a>';
                    return $regionNames;
                })

                ->addColumn('actionB',function ($region){

                    return $male= User::where('area_id',$region->id)->where('is_active',1)->where('gender','male')->count();

                })

                ->addColumn('actionC',function ($region){

                    return $female= User::where('area_id',$region->id)->where('is_active',1)->where('gender','female')->count();

                })

                ->addColumn('actionD',function ($region){

                    return User::where('area_id',$region->id)->where('is_active',1)->where('officeHeld','elder')->count();

                })

                ->addColumn('actionE',function ($region){

                    return  User::where('area_id',$region->id)->where('is_active',1)->where('officeHeld','deacon')->count();

                })

                ->addColumn('actionF',function ($region){

                    return User::where('area_id',$region->id)->where('is_active',1)->where('officeHeld','deaconess')->count();

                })

                ->addColumn('actionGG',function ($region){

                    return  User::where('area_id',$region->id)->where('officeHeld','children ministry')->where('is_active',1)->count();

                })

                ->addColumn('actionPastor',function ($region){

                    return  User::where('area_id',$region->id)->where('officeHeld','pastor')->where('is_active',1)->count();

                })

                ->addColumn('actionPresidingElders',function ($region){

                    return  User::where('area_id',$region->id)->where('officeHeld','presiding elder')->where('is_active',1)->count();

                })

                ->addColumn('actionApostle',function ($region){

                    return  User::where('area_id',$region->id)->where('officeHeld','apostle')->where('is_active',1)->count();

                })


                ->addColumn('actionG',function ($region){

                    return  User::where('area_id',$region->id)->where('is_active',0)->count();

                })


                ->addColumn('actionH',function ($region){

                    return  User::where('area_id',$region->id)->where('is_active',1)->count();

                })

                ->addColumn('actionJ',function ($region){
                    $showIdd=route('area.edit',$region->id);
                    return  '<a class="btn btn-primary btn-xs" href="'.$showIdd.'"><i class="fa fa-edit"></i></a>';
                })

                ->addColumn('delete',function ($region){
                    $showIdd=route('area.edit',$region->id);
                    return  '<a class="btn btn-danger btn-xs" href="'.$showIdd.'"><i class="fa fa-edit"></i></a>';
                })

                ->rawColumns(['actionJ','delete'])
                ->toJson();

        }

        return view('headquarters.area.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //creating of area
        $regions=Region::all('id','name');
        return view('headquarters.area.create',compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AreaRequest $request)
    {
        //
        Area::create($request->all());

        return redirect()->back()->with(['success1'=>'Successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        // showing district at the area level
        try{
        $area=Area::findOrFail($id);

        $districts=District::where('area_id','=',$id)->GetLatest();

        $countArea=$districts->count();

           Session(['area_id'=>$area->id]);

        }catch (ModelNotFoundException $exception){

            return back()->withError('Area not found by ID ' . $id)->withInput();
        }
        return view('headquarters.area.show',compact('id','area','districts','countArea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        try{
        $area=Area::findOrFail($id);
        }catch (ModelNotFoundException $exception){

            return back()->withError('Area not found by ID ' . $id)->withInput();
        }
        return view('headquarters.area.edit',compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    * $area=Area::findOrFail($id);
 * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AreaUpdateRequest $request, $id)
    {
        //
        //updating area
        try{
        $user=Area::findOrFail($id);

        $input=$request->all();

        $user->update($input);
        }catch (ModelNotFoundException $exception){

            return back()->withError('Area not found by ID ' . $id)->withInput();
        }

        return redirect()->route('region.show',(Session::get('region_id')))->with(['success1'=>'successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
       $area=Area::findOrFail($id);

       $area->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Area not found by ID ' . $id)->withInput();
        }
       return redirect()->route('region.show',(Session::get('region_id')))->with(['success1'=>'successfully deleted']);

    }
}
