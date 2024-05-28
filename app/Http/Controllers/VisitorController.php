<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
            $cats = Category::all();

            if (!$request->category) {
                $meals = Meal::all();
                $cat1 = 'الصفحة الرئيسية';
                return view('visitorPage', compact('cats', 'meals', 'cat1'));
            } else {
                $category = Category::findOrFail($request->category);
                $meals = $category->meals;

                $cat_id = $request->category;
                $category = Category::findOrFail($cat_id);

                // تعيين $cat1 إلى اسم القسم
                $cat1 = $category->cat_name;

                return view('visitorPage', compact('cats', 'meals', 'cat1'));
            }
    }
}
