@extends('layouts.app')
@section('content')

    <div class="container" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-danger text-light text-center ">القائمة</div>
                    <div class="card-body text-right ">
                        <ul class="list-group ">
                            <a href="{{ route('meal.show') }}" class="list-group-item list-group-item-action ">عرض
                                الوجبات</a>
                            <a href="{{ route('meal.create') }}" class="list-group-item list-group-item-action">إضافة
                                وجبة</a>
                            <a href="/home" class="list-group-item list-group-item-action">طلبات المستخدمين</a>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-danger text-light text-center ">جميع الوجبات

                    </div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                            @if (count($meals) > 0)

                            <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">صورة الوجبة</th>
                                <th scope="col">اسم الوجبة</th>
                                <th scope="col">الوصف</th>
                                <th scope="col">الصنف</th>
                                <th scope="col">السعر ($)</th>
                                <th scope="col">تعديل</th>
                                <th scope="col">حذف</th>

                            </tr>

                            </thead>
                            <tbody>

                                @php
                                $i = 0;
                                @endphp
                                @foreach ($meals as $row)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td><img src="{{asset('images/meals/'.$row->image) }}" width="80"></td>
                                        <td>{{$row->name  }}</td>
                                        <td>{{$row->description }}</td>
                                        <td>{{$row->category->cat_name }}</td>
                                        <td>{{$row->price }}</td>

                                        <td><a href="{{route('meal.edit', $row->id)}}"><button class="btn btn-primary">تعديل</button></a></td>




                                        <td> <a href="{{route('meal.delete',$row->id)}}" class="btn btn-danger" id="delete">حذف</a></td>


                                    </tr>


                                @endforeach

                            @else
                                <p>لا يوجد وجبات </p>
                            @endif


                            </tbody>
                        </table>
{{--                            مشان تعمل pagination للركوردس--}}
{{--بعد ما عملنا الترقيم بالصفحة للصفحات بالpagination صار في مشكلة بالتصميم لحل هالمشكلة منستدعي مكتبة paginator بـ AppServicProvider--}}
                        {{ $meals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
