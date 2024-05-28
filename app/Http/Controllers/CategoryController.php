<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(){

        $show_cat = Category::paginate(3); //بتجيب البيانات من دون مااعمل تعليمة get  او all
        return view('categories.categoryPage', compact('show_cat'));
    }

    public function store(Request $request){

        $request->validate(['cat_name'=>'required|string|unique:categories|max:40']);
        Category::create([
            'cat_name'=>$request->cat_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('message','تم إضافة الصنف بنجاح !');
    }

    public function delete($id){

        Category::find($id)->delete();
        return redirect()->route('cat.show')->with('message', 'تم حذف الصنف بنجاح!');
    }

    public function update(Request $request){

        $id = $request->id;
        Category::find($id)->update([
            'cat_name'=>$request->cat_name,
        ]);
        return redirect()->route('cat.show')->with('message', 'تم تحديث الصنف بنجاح !');
    }
}
