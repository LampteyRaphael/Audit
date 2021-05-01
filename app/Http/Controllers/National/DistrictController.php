<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests\DistrictUpdateRequest;
use App\Locals;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        //districts
//        $districts=District::GetLatest();
//        $districtCount=$districts->count();
//        $districtCount2=District::count();

        if ($request->ajax()) {
            return DataTables::eloquent(District::query())
                ->addIndexColumn()
                ->addColumn('actionA', function ($region) {
                    Session(['district_id'=>$region->id]);
                    $showId = route('district.show', $region->id);
                    $regionNames = '<a class="btn-link" href="' .$showId .'">' . $region->name . '</a>';
                    return $regionNames;
                })
                ->addColumn('actionB', function ($region) {

                    return $male = User::where('district_id', $region->id)->where('is_active', 1)->where('gender', 'male')->count();

                })
                ->addColumn('actionC', function ($region) {

                    return $female = User::where('district_id', $region->id)->where('is_active', 1)->where('gender', 'female')->count();

                })
                ->addColumn('actionD', function ($region) {

                    return User::where('district_id', $region->id)->where('is_active', 1)->where('officeHeld', 'elder')->count();

                })
                ->addColumn('actionE', function ($region) {

                    return User::where('district_id', $region->id)->where('is_active', 1)->where('officeHeld', 'deacon')->count();

                })
                ->addColumn('actionF', function ($region) {

                    return User::where('district_id', $region->id)->where('is_active', 1)->where('officeHeld', 'deaconess')->count();

                })
                ->addColumn('actionGG', function ($region) {

                    return User::where('district_id', $region->id)->where('officeHeld', 'children ministry')->where('is_active', 1)->count();

                })
                ->addColumn('actionPastor', function ($region) {

                    return User::where('district_id', $region->id)->where('officeHeld', 'pastor')->where('is_active', 1)->count();

                })
                ->addColumn('actionPresidingElders', function ($region) {

                    return User::where('district_id', $region->id)->where('officeHeld', 'presiding elder')->where('is_active', 1)->count();

                })
                ->addColumn('actionApostle', function ($region) {

                    return User::where('district_id', $region->id)->where('officeHeld', 'apostle')->where('is_active', 1)->count();

                })
                ->addColumn('actionG', function ($region) {

                    return User::where('district_id', $region->id)->where('is_active', 0)->count();

                })
                ->addColumn('actionH', function ($region) {

                    return User::where('district_id', $region->id)->where('is_active', 1)->count();

                })
                ->addColumn('actionJ', function ($region) {
                    $showIdd = route('district.edit', $region->id);
                    return '<a class="btn btn-primary btn-xs" href="' . $showIdd . '"><i class="fa fa-edit"></i></a>';
                })
                ->addColumn('delete', function ($region) {
                    $showIdd = route('district.edit', $region->id);
                    return '<a class="btn btn-danger btn-xs" href="' . $showIdd . '"><i class="fa fa-edit"></i></a>';
                })

                ->rawColumns(['actionA', 'actionB', 'actionC', 'actionD', 'actionE', 'actionF', 'actionGG', 'actionG', 'actionPastor', 'actionPresidingElders', 'actionApostle', 'actionH', 'actionJ', 'delete'])
                ->make(true);
        }

        return view('headquarters.district.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('headquarters.district.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DistrictRequest $request)
    {
        //
        District::create($request->all());

        return redirect()->back()->with(['success1' => 'Successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try{
        $district=District::findOrFail($id);

        $locals=Locals::where('district_id', $district->id)->GetLatest();

        $countDistrict=$locals->count();

        Session(['district_id'=>$district->id]);
        }catch (ModelNotFoundException $exception){

            return back()->withError('District not found by ID ' . $id)->withInput();
        }
        return view('headquarters.district.show',compact('id','district','locals','countDistrict'));
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
        $district=District::findOrFail($id);

        }catch (ModelNotFoundException $exception){

            return back()->withError('District not found by ID ' . $id)->withInput();
        }
        return view('headquarters.district.edit',compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictUpdateRequest $request, $id)
    {
        //updating area
        try{
        $user=District::findOrFail($id);

        $input=$request->all();

        $user->update($input);

        }catch (ModelNotFoundException $exception){

            return back()->withError('District not found by ID ' . $id)->withInput();
        }
        return redirect()->route('area.show',(Session::get('area_id')))->with(['success1'=>'successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        try{
        $district=District::findOrFail($id);

        $district->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('District not found by ID ' . $id)->withInput();
        }
        return redirect()->route('area.show',(Session::get('area_id')))->with(['success1'=>'successfully deleted']);
    }
}
