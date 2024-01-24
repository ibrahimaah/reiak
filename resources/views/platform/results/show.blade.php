@extends('platform.layouts.layout')
@section('content')


<style>
    .myOtherBarChart{
      font: 15px sans-serif;
      background-color: lightblue;
      text-align: right;
      padding:5px;
      margin:5px;
      color: white;
      font-weight: bold;
    }
        
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="w-75 m-auto">
    <div class="card"> 
        <div class="card-header d-flex justify-content-between align-items-baseline">
            <h4> بيانات الاجوبة </h4>
            <h5 class="text-secondary"> <span>عدد الأصوات :</span> <span class="fw-bold">{{ $totalVotes }}</span></h5>
        </div>
        <div class="card-body">
            
        @foreach($results as $question_content => $choice_percentage_arr )
            @php 
                $max_percentage = max($choice_percentage_arr)
            @endphp 
            <h5>{{ ++$loop->index}}<span>)</span> {{ $question_content }} </h5> 
            <div class="me-3">
                @foreach($choice_percentage_arr as $choice_content => $percentage)
                    <p class="d-block mb-1 text-secondary <?=$percentage == $max_percentage ? 'fw-bold' :''?>">{{ $choice_content }}</p>
                    <div class = "progress" style = "height: 25px"> 
                        <div class = "progress-bar <?=$percentage == $max_percentage ? 'bg-success' :''?>" style = "width:<?=$percentage?>%">  
                        <b>% {{ $percentage }} </b>   
                        </div>  
                    </div>
                <br>  
                @endforeach
            </div>
        @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>  المدن الاكتر مشاركة </h4>
        </div>
        <div class="card-body">
            <canvas id="myPieChart"></canvas>
        </div>
        @php
            $checkip = [];
            $city2 = [];
        @endphp
        @foreach($poll->results as $city => $count)
            @if (!in_array($count->ip,$checkip))
                    @php
                        $checkip[] = $count->ip;
                    @endphp
                    @if (!isset($city2[$count->city]))
                        @php
                            $city2[$count->city] = 1
                        @endphp
                    @else
                        @php
                            $city2[$count->city]++
                        @endphp
                    @endif

            @else
            @endif
        @endforeach
   
  
    </div>

    {{-- comments Section --}}

    {{-- Get title slug from url --}}
    <?php 
        $url = request()->url();
        $path = parse_url(urldecode($url), PHP_URL_PATH);
        $segments = explode('/', $path);
        $title_slug = end($segments);
    ?>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xs-10 col-md-8 justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success-store-comment'))
                <div class="alert alert-success">
                    {{ session()->get('success-store-comment') }}
                </div>
            @endif
            
            @if(session('error-store-comment'))
                <div class="alert alert-danger">
                    {{ session()->get('error-store-comment') }}
                </div>
            @endif
            @if(session('success-update-comment'))
                <div class="alert alert-success">
                    {{ session()->get('success-update-comment') }}
                </div>
            @endif
            
            @if(session('error-update-comment'))
                <div class="alert alert-danger">
                    {{ session()->get('error-update-comment') }}
                </div>
            @endif
            @if(session('success-delete-comment'))
                <div class="alert alert-success">
                    {{ session()->get('success-delete-comment') }}
                </div>
            @endif
            
            @if(session('error-delete-comment'))
                <div class="alert alert-danger">
                    {{ session()->get('error-delete-comment') }}
                </div>
            @endif
        </div>
      </div>
    </div>


    
    <section class='bg-success container my-2 pt-3 rounded'>
        
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card text-dark">
                        <div class="card-body">
                            <h4 class="mb-0 text-success">أحدث التعليقات</h4>
                            <p class="fw-light pb-2 mb-1 fs-6 text-secondary">قسم أحدث التعليقات من قبل المستخدمين</p>

                            @auth 
                                <button type="button"
                                        class='btn btn-success btn-sm mb-4'
                                        data-bs-toggle="modal"
                                        data-bs-target="#addCommentModal"
                                >إضافة تعليق &nbsp;<i class="fas fa-plus ms-2"></i></button>
                            @endauth
                        @if(!$comments->isEmpty())
                            @foreach($comments as $comment)
                            <div class="d-flex flex-start gap-2">

                                <!-- <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp" 
                                    alt="avatar" 
                                    width="60"
                                    height="60" 
                                /> -->

                                <div>
                                    <h6 class="fw-bold mb-1 text-success">
                                        {{ App\Helpers\CommentHelper::getUserById($comment->user_id)->name }}</h6>
                                    <div class="d-flex align-items-center mb-3 gap-1">
                                        <p class="mb-0">
                                        
                                            <span class="badge bg-secondary">
                                                {{ App\Helpers\CommentHelper::formateDate($comment->created_at) }}
                                            </span>
                                        </p>
                                    @if(Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                                        <a class="link-secondary" 
                                           data-bs-toggle="modal"
                                           data-bs-target="#editCommentModal{{ $comment->id }}"
                                           style="cursor:pointer"
                                        >
                                            <i class="fas fa-pencil-alt ms-2"></i>
                                        </a>
                                        
                                        <form id="delete-comment-form"
                                              method="POST" 
                                              action="{{ route('delete-comment',['id' => $comment->id]) }}">
                                            @csrf 
                                            @method('DELETE')
                                            <a href="javascript:void(0);" 
                                               class="link-secondary"
                                               onclick="document.getElementById('delete-comment-form').submit();">
                                                <i class="fas fa-trash ms-2"></i>
                                            </a>
                                        </form>
                                            
                                        
                                    @endif
                                    </div>
                                    <p class="mb-0 text-secondary fs-6">
                                       {{ $comment->comment }}
                                    </p>
                                </div>
                            </div>
                            <hr class="my-2" />

                                {{-- Edit Comment Modal --}}
                                <div class="modal fade" 
                                    id="editCommentModal{{ $comment->id }}" 
                                    data-bs-backdrop="static" 
                                    data-bs-keyboard="false"
                                    tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title text-success fs-5" id="addCommentModalLabel">تعديل تعليق </h1>
                                        </div>
                                        <form method='POST' action="{{ route('update-comment',['id'=>$comment->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type='hidden' name='title_slug' value="{{ $title_slug }}"/>
                                            <div class="modal-body">
                                                    
                                                <div class="mb-3">
                                                    <textarea class="form-control" rows="3" name='comment'>{{ $comment->comment }}</textarea>
                                                </div>
                                                
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">حفظ</button>    
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خروج</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif  
                        </div>

                        

                


                    


                    </div>
                </div>
            </div>
    </section>
    

   

    {{-- Add Comment Modal --}}
    <div class="modal fade" 
         id="addCommentModal" 
         data-bs-backdrop="static" 
         data-bs-keyboard="false"
         tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-success fs-5" id="addCommentModalLabel">إضافة تعليق جديد</h1>
            </div>
            <form method='POST' action="{{ route('store-comment') }}">
                @csrf
                <input type='hidden' name='title_slug' value="{{ $title_slug }}"/>
                <div class="modal-body">
                        
                    <div class="mb-3">
                        <textarea class="form-control" rows="3" name='comment'></textarea>
                    </div>
                    
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">إضافة</button>    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خروج</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.5.0/d3.min.js"></script>

<script>
        // your_script.js

    // Sample data for the pie chart
    var data = {
        labels: [
            @foreach ($city2 as $t => $c)
                '{{ $t }}',
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach ($city2 as $t => $c)
                    {{ $c }},
                @endforeach
          
            ], // Values for each section of the pie chart
            backgroundColor: [
                @php
                    $colors = ['#183E75', '#927FC1', '#5733FF', '#FF5733', '#33FF57', '#5733FF']; // Add more colors as needed
                @endphp
                @foreach ($colors as $c)
                    '{{ $c }}',
                @endforeach
            ],
            borderColor: [
                @foreach ($colors as $c)
                    '{{ $c }}',
                @endforeach
            ],
            borderWidth: 1
        }]
    };

    // Get the canvas element
    var ctx = document.getElementById('myPieChart').getContext('2d');

    // Create the pie chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data
    });

</script>


@endsection