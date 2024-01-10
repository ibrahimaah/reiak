@extends('platform.layouts.layout')
@section('content')


<h5 class='mb-3 text-success text-center'>مواضيعي</h5>
@if($user_votes->isNotEmpty())
    <table class="table table-bordered border-success text-secondary text-center">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">عنوان الموضوع</th>
            <th scope="col">الحالة</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user_votes as $vote)
            <tr>
            <th scope="row">{{++$loop->index}}</th>
            <td>{{ $vote->title }}</td>
            @if($vote->status == "false")
                <td>قيد المراجعة</td>
                @elseif ($vote->results->count() > 0)
                <td>
                    <a href="{{ route('result.show', $vote->title_slug) }}"
                       class='text-success text-decoration-none fw-bold' target="_blank"> عرض النتائج  </a>
                </td>
                @else 
                <td>لا توجد نتائج بعد</td>
            @endif
            </tr>

        @endforeach
        </tbody>
    </table>
@else 
    <div class="alert alert-info text-center">
        لا يوجد بيانات متاحة
    </div>
@endif 

@endsection