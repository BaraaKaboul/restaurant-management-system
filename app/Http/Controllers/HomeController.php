<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if (auth()->user()->role == 0){
            $cats = Category::all();

            if (!$request->category){
                $meals = Meal::all();
                $cat1 = 'الصفحة الرئيسية';
                return view('userPage', compact('cats','meals','cat1'));
            }else{
                $category = Category::findOrFail($request->category);
                $meals = $category->meals;

                $cat_id = $request->category;
                $category = Category::findOrFail($cat_id);

                // تعيين $cat1 إلى اسم القسم
                $cat1 = $category->cat_name;

                return view('userPage', compact('cats','meals','cat1'));
            }

        }
        else
            //وظيفة تعليمة orderBy بتجبلي الاوردرات حسب الid مرتبين بشكل تنازلي بسبب DESC
            $order = Order::orderBy('id','DESC')->get();

            return view('adminPage', compact('order'));
    }

    public function updateStatus(Request $request){

        $status = $request->status;
        $order_id = $request->order_id;
        Order::where('id',$order_id)->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
}
