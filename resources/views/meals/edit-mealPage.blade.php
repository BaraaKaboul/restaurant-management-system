@extends('layouts.app')
@section('content')
    {{--    لازم نضيف هاد الcdn مشان يشتغل تحت السكربت--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-danger text-light text-center">القائمة</div>
                    <div class="card-body text-right">
                        <ul class="list-group">
                            <a href="{{route('cat.show')}}" class="list-group-item list-group-item-action">إضافة صنف</a>
                            <a href="{{route('meal.show')}}" class="list-group-item list-group-item-action">عرض الوجبات</a>

                            <a href="" class="list-group-item list-group-item-action">طلبات
                                المستخدمين</a>

                        </ul>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p> {{ $error }}
                                    <p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-center text-light">تعديل الوجبة</div>

                    <form action="{{route('meal.update',$editMeal->id)}}" method="post" enctype="multipart/form-data">
                        @csrf

{{--                        عملنا انبوت نوع هيدين مشان نجيب الصورة القديمة ونبدلها بالجديدة--}}
                        <input type="hidden" name="old_image" value="{{'images/meals/'.$editMeal->image}}">
                        <div class="card-body text-right">
                            <div class="form-group">
                                <label for="name">اسم الوجبة</label>
                                <input type="text" class="form-control" name="name" placeholder="اسم الوجبة" value="{{($editMeal->name)}}">
                            </div>
                            <div class="form-group">
                                <label for="description">وصف الوجبة</label>
                                <textarea class="form-control" name="description" >{{($editMeal->description)}}</textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>سعر الوجبة($)</label>
                                    <input type="number" name="price" class="form-control" placeholder="سعر الوجبة" value="{{$editMeal->price}}">
                                </div>

                            </div>




                            <div class="form-group">
                                <h5>اختر صنف <span class="text-danger">*</span></h5>
                                <div class="controls">

                                    <select name="category" class="form-control" required="">
                                        <option value="" selected="" disabled="">اختر صنف</option>
                                        @foreach ($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                        @endforeach
                                    </select>






                                    <br>

                                    <div class="form-group">
                                        <label>صورة الوجبة</label>
                                        <input type="file" name="image" value="" class="form-control" id="image">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <img id="showImage" src="{{asset('images/meals/'.$editMeal->image)}}" style="width: 100px; height: 100px;">
                                    </div>


                                    <br>
                                    <div class="form-group text-center">
                                        <button class="btn btn-danger" type="submit">تعديل</button>
                                    </div>

                                </div>
                    </form>


                </div>
            </div>
        </div>

        {{--سكربت مشان تطلع شو هي الصورة مكانها بالفورم يعني يطلع شكل الصورة--}}
        <script type="text/javascript">
            $(document).ready(function(){
                $('#image').change(function(e){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#showImage').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>


@endsection
