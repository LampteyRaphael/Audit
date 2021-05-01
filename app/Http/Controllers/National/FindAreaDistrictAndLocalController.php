<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\Locals;
use App\Region;
use Illuminate\Http\Request;

class FindAreaDistrictAndLocalController extends Controller
{
    //

    public function area(Request $request){
    //showing area at the region show
        $id=$request['id'];
        $regions=Region::findOrFail($id);
        $areas=Area::where('name','LIKE','%'.$request['name'].'%')->where('region_id','=',$regions->id)->orderBy('name','asc')->paginate(20);

        $areasc=Area::where('region_id','=',$regions->id)->get();
        $countAreas=$areasc->count();

        $countArea=$areas->count();

        Session(['region_id'=>$regions->id]);

        return view('headquarters.region.show',compact('id','regions','areas','countArea','countAreas'));
    }


    public function district(Request $request)
    {
        // showing district at the area level
        $id=$request['id'];
        $area = Area::findOrFail($id);

        $districts = District::where('name','LIKE','%'.$request['name'].'%')->where('area_id', '=', $area->id)->Latest()->get();

        $countArea = $districts->count();

        Session(['area_id' => $area->id]);

        return view('headquarters.area.show', compact('id', 'area', 'districts', 'countArea'));
    }

    public function locals(Request $request)
    {
        //
        $id = $request['id'];
        $district = District::findOrFail($id);

        $locals = Locals::where('name','LIKE','%'.$request['name'].'%')->where('district_id', '=', $district->id)->Latest()->paginate(20);

        $countDistrict = $locals->count();

        Session(['district_id' => $district->id]);

        return view('headquarters.district.show', compact('id', 'district', 'locals', 'countDistrict'));
    }
}
