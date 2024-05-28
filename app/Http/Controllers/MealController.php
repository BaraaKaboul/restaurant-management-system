<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Intervention\Image\Image;


class MealController extends Controller
{
    public function create(){

        $cats = Category::latest()->get();
        return view('meals.mealPage', compact('cats'));
    }

    public function store(Request $request){

        $request->validate([
        'name' => 'required|string|min:3|max:40',
        'description' => 'required|min:3|max:500',
        'price' => 'required|numeric',
        'image' => 'required|mimes:png,jpeg,jpg',

    ]);

        if($request->hasFile('image')) {

            //هون مشان نخزن جوات الداتا بيز منكتب هالسطرين وبخزن جوات fileName
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalName();
        }
        //حتى نقدر نخزن الصور جوات الداتا بيز لازم نستخدم هاي الطريقة
        //سميتا بهاي الطريقة مشان اضمن انو المستخدمين حطو نفس الصورة بتجي باسمين مختلفين
        $store = new Meal();
        $store->name = $request->name;
        $store->description = $request->description;
        $store->price = $request->price;
        $store->category_id = $request->category;
        $store->image = $fileName;
        $store->save();


        //هون مشان خزن اسم الصورة جوات ملف المشروع فجبت اسم الصورة متل الي اتخزنت بالداتا بيز فوق
        //لازم يكون نفس الاسم بالداتابيز وبالملفات حتى اقدر اعرض الصورة جوات تيبل
//        $imageName = time() . '.' . $image->getClientOriginalName();
        $request->image->move(public_path('images/meals/'), $fileName);


        // هاد الحكي من مكتبة اسما toaster استدعينا روابط cdn بمكان app.blade
        $notification = array(
            'message_id' => 'تم إضافة الوجبة بنجاح !',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    public function index(){

        $meals = Meal::paginate(3);
        return view('meals.index', compact('meals'));
    }

    public function edit($id){

        $cats = Category::all();
        $editMeal = Meal::findOrFail($id);
        return view('meals.edit-mealPage', compact('editMeal','cats'));
    }

    public function update(Request $request, $id){

        $old_image = $request->old_image;


        if ($request->hasFile('image')) {

            //هاي التعليمة بتحذف الصورة القديمة ومنستبدلها بالصورة الي رح يضيفا المستخدم ازا بدو يعدل الصورة
            unlink($old_image);

            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalName();
            $request->image->move(public_path('images/meals/'), $fileName);


            Meal::where('id', $id)->findOrFail($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
                'image'=>$fileName,
            ]);
            return to_route('meal.show')->with('message','تم تعديل الوجبة بنجاح !');
        }
        else
            Meal::findOrFail($id)->update([

                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
            ]);
        return to_route('meal.show')->with('message','تم تعديل الوجبة بنجاح !');
    }

    public function mealDelete($id){

        Meal::where('id',$id)->delete();
        return to_route('meal.show')->with('message','لقد تم حذف الوجبة بنجاح!');
    }
}
