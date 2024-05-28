@extends('layouts.app')

@section('content')

    <div class="container" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">القائمة</div>
                    <div class="card-body text-right">
                        <form action="" method="get">
                            <a class="list-group-item list-group-item-action"  href="/">الصفحة الرئيسية</a>
                            @foreach ($cats as $row)
                                <button type="submit" value="{{ $row->id }}" name="category" class="list-group-item list-group-item-action">
                                    {{ $row->cat_name }}
                                </button>
                            @endforeach


                        </form>
                    </div>
                </div>


                @if(Auth::check())
                    <div class="card">
                    <div class="card-header text-center">الطلبات السابقة</div>
                    <div class="card-body text-right">
                        <form action="" method="get">
                            <a class="list-group-item list-group-item-action"  href="{{route('order.show')}}">اظهار الطلبات السابقة</a>



                        </form>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{$cat1}}</h4>

                        عدد الوجبات ({{count($meals)}})</div>
                    <div class="card-body">
                        <div class="row">


                            @forelse($meals as $meal )
                                <div class="col-md-4 mt-2 text-center" style="border: 1px solid rgb(149, 212, 159) ;">
                                    <img src="{{ asset('images/meals/'.$meal->image) }}" class="img-thumbnail" style="width:100%;">
                                    <strong>{{ $meal->name }}</strong>
                                    <p>{{ $meal->description }}</p>
                                    <div>

                                        <a href="{{route('meal.details', $meal->id)}}" class="btn btn-success" style="font-size:16px" title="Add To Cart">
                                            <i class="fa fa-bell-slash-o" style="font-size:16px;color:white">اطلب الأن</i>
                                        </a>

                                    </div>
                                    <br>
                                </div>
                                {{--                                ازا كان مافي وجبات متوفرة بالقسم الي انحط بيطلع هاي الرسالة تحت--}}
                            @empty
                                <p>لا يوجد وجبات متوفرة</p>
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>






    </div>




    <style>
        a.list-group-item {
            font-size: 18px;
        }

        a.list-group-item:hover {
            background-color: rgb(61, 114, 56);
            color: #fff;
        }

        .card-header {
            background-color: rgb(47, 160, 36);
            color: #fff;
            font-size: 20px;
        }




    </style>




@endsection
