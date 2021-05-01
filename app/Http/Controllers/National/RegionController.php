<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Region;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //  $users=User::all();


        if ($request->ajax()) {

            return Datatables::of(Region::all())
                ->addIndexColumn()
                ->addColumn('actionA', function ($region) {

                   $showId=route('region.show',$region->id);
                    $regionNames='<a class="btn-link" href="'.$showId.'">'.$region->name.'</a>';
                    return $regionNames;
                })

                ->addColumn('actionB',function ($region){

                  return $male= User::where('region_id',$region->id)->where('is_active',1)->where('gender','male')->count();

                })

                ->addColumn('actionC',function ($region){

                    return $female= User::where('region_id',$region->id)->where('is_active',1)->where('gender','female')->count();

                })

                ->addColumn('actionD',function ($region){

                    return User::where('region_id',$region->id)->where('is_active',1)->where('officeHeld','elder')->count();

                })

                ->addColumn('actionE',function ($region){

                    return  User::where('region_id',$region->id)->where('is_active',1)->where('officeHeld','deacon')->count();

                })

                ->addColumn('actionF',function ($region){

                    return User::where('region_id',$region->id)->where('is_active',1)->where('officeHeld','deaconess')->count();

                })

                ->addColumn('actionGG',function ($region){

                    return  User::where('region_id',$region->id)->where('officeHeld','children ministry')->where('is_active',1)->count();

                })

                ->addColumn('actionPastor',function ($region){

                    return  User::where('region_id',$region->id)->where('officeHeld','pastor')->where('is_active',1)->count();

                })

                ->addColumn('actionPresidingElders',function ($region){

                    return  User::where('region_id',$region->id)->where('officeHeld','presiding elder')->where('is_active',1)->count();

                })

                ->addColumn('actionApostle',function ($region){

                    return  User::where('region_id',$region->id)->where('officeHeld','apostle')->where('is_active',1)->count();

                })


                ->addColumn('actionG',function ($region){

                    return  User::where('region_id',$region->id)->where('is_active',0)->count();

                })


                ->addColumn('actionH',function ($region){

                    return  User::where('region_id',$region->id)->where('is_active',1)->count();

                })

                    ->addColumn('actionJ',function ($region){
                        $showIdd=route('region.edit',$region->id);
                        return  '<a class="btn btn-primary btn-xs" href="'.$showIdd.'"><i class="fa fa-edit"></i></a>';
                 })

                ->addColumn('delete',function ($region){
                    $showIdd=route('region.edit',$region->id);
                    return  '<a class="btn btn-danger btn-xs" href="'.$showIdd.'"><i class="fa fa-edit"></i></a>';
                })

                ->rawColumns(['actionA','actionB','actionC','actionD','actionE','actionF','actionGG','actionG','actionPastor','actionPresidingElders','actionApostle','actionH','actionJ','delete'])
                ->make(true);

        }
//        $countRegion=$regions->count();
        return view('headquarters.region.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('headquarters.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request)
    {
        //
         Region::create($request->all());

        return redirect('admin/region')->with(['success1' => 'successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //showing area at the region show

        try{
        $regions=Region::findOrFail($id);

        $areas=Area::where('region_id','=',$regions->id)->GetLatest();

        $areasc=Area::where('region_id','=',$regions->id)->get();
        $countAreas=$areasc->count();

          $countArea=$areas->count();

            Session(['region_id'=>$regions->id]);
        }catch (ModelNotFoundException $exception){

            return back()->withError('National not found by ID ' . $id)->withInput();
        }

        return view('headquarters.region.show',compact('id','regions','areas','countArea','countAreas'));
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
        try{
        $regions=Region::findOrFail($id);
      }catch (ModelNotFoundException $exception){

       return back()->withError('National not found by ID ' . $id)->withInput();
}
        return view('headquarters.region.edit',compact('regions','id'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, $id)
    {
        //updating region
        try{
         $user=Region::findOrFail($id);

         $input=$request->all();

         $user->update($input);
      }catch (ModelNotFoundException $exception){

        return back()->withError('National not found by ID ' . $id)->withInput();
      }
         return redirect('admin/region')->with(['success1'=>'successfully updated']);

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
        try{
        $region=Region::findOrFail($id);

        $region->delete();
       }catch (ModelNotFoundException $exception){

           return back()->withError('National not found by ID ' . $id)->withInput();
        }
        return redirect('admin/region')->with(['success1'=>'successfully deleted']);
    }
}

