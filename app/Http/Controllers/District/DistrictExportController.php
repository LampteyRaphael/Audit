<?php

namespace App\Http\Controllers\District;

use App\Exports\ChildrenFromView;
use App\Exports\DistrictMembersView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DistrictExportController extends Controller
{
    public function members(){

        return Excel::download(new DistrictMembersView,     'DistrictExcel.xlsx');
    }

}
