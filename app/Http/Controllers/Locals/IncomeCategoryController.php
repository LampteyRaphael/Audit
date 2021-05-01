<?php
namespace App\Http\Controllers\Locals;
use App\incomeCategory;
use App\AuditTrail;
use App\DonationAndPledge;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\income;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id=auth()->user()->local_id;
        $year=Carbon::now()->year;
        $incomeCategory=incomeCategory::whereLocal_id($id)->orwhere("local_id",0)->get();
        $incomeCategoryId=incomeCategory::whereLocal_id($id)->orwhere("local_id",0)->pluck('id');

        $total=income::where("local_id",$id)->whereIn('category_id',$incomeCategoryId)->whereYear('created_at',$year)->pluck('amount')->sum();
        $tithe=PostTithe::where("local_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();
        $donation=DonationAndPledge::where('local_id',$id)->where('donationOrPledge','donation')->whereYear('created_at',$year)->pluck('amount')->sum();

        return view('members.category.index',compact('incomeCategory','total','tithe','donation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('members.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        //
         $a=strtolower($request['name']);
        if ($a=='tithe' || $a=='ehtit'){

            return redirect()->back()->with(['success1'=>'Sorry tithe category is already in the system']);

        }else{

            $category=$request->all();
            incomeCategory::create($category);
        }


        return redirect()->route('category.index')->with(['success1'=>'Category successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //showing only one category
      //$category=incomeCategory::findOrFail($id);

        return view('members.category.show');
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
        $category=incomeCategory::findOrFail($id);

        return view('members.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        //
        $category1=$request->all();

        $category=incomeCategory::findOrFail($id);

        $category->update($category1);

        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category='Updated/'.' '.$category->name;
        $audit->user_id=Auth::user()->id;
        $audit->save();

        return redirect()->route('category.index')->with(['success1'=>'Category successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category=incomeCategory::findOrFail($id);
        $category->delete();
        $audit=new AuditTrail();
        $audit->local_id=Auth::user()->local_id;
        $audit->category='Deleted/'.' '.$category->name;
        $audit->user_id=Auth::user()->id;
        $audit->save();
        return response()->json(['success1'=>'Successfully Deleted']);

//        return redirect()->route('category.index')->with(['success1'=>'Category successfully deleted']);

    }
}
