<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function mealDetails($id){

        $meal = Meal::findOrFail($id);
        return view('meals.mealdetails', compact('meal'));
    }

    public function storeOrder(Request $request){

        Order::insert([
            'user_id'=>auth()->user()->id,
            'phone'=>$request->phone,
            'date'=>$request->date,
            'time'=>$request->time,
            'qty'=>$request->qty,
            'address'=>$request->address,
            'meal_id'=>$request->meal_id,
        ]);
        $notification = array(
            'message_id' => 'تم الطلب بنجاح !',
            'alert-type' => 'success'
        );
        return to_route('home')->with($notification);
    }

    public function showOrder(){

        $order = Order::where('user_id','=',auth()->user()->id)->get();
        return view('orders.showOrder', compact('order'));
    }
}
