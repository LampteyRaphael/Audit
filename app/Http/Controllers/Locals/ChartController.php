<?php

namespace App\Http\Controllers\Locals;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Charts;
class ChartController extends Controller
{
    /**
 * Show the application dashboard.
 *

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */

    public function index()

    {

        $users = User::all();

         return view('chart',compact('users'));

    }
    public function index2()

    {

        $users = User::all();

        return view('ui',compact('users'));

    }
}
