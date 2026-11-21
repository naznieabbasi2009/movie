@extends("Admin.layouts.master")
@section("content")
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <a href="{{route('casts.create')}}" class="btn btn-primary"> افزودن </a>
        <h5 class="card-header"> جدول پایه</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام </th>
                    <th>نقش</th>
                    <th>تصویر</th>
                    <th>توضیحات</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($casts as $cast)
                <tr>
                    <td>
                        {{$cast->id}}
                    </td>
                    <td>{{$cast->full_name}} </td>
                    <td>@if($cast->role == "actor")
                            بازیگر
                        @else
                            کارگردان
                    @endif
                    </td>
                    <td>
                        {{$cast->image}}
                    </td>
                    <td>
                       {{$cast->description}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <hr class="my-5" />
@endsection
