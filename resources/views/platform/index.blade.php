@extends('platform.layouts.layout')
@section('content')


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"> تحذير </h1>
      </div>
      <div class="modal-body">
        <!-- Modal body content goes here -->
        <p>
             يمنع منعا كليا الاشارة الى الأشخاص أو نشر المواضيع السياسية و الدينية .
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close"> موافق </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Use jQuery or vanilla JavaScript to show the modal on page load
  $(document).ready(function() {
      if(!localStorage.getItem('alert')){
             $('#staticBackdrop').modal('show');
             localStorage.setItem('alert', 'true');
      }
 

  });
</script>



<div class="row g-3">
    @forelse ($votes as $vote)
        @if ($vote->status == 'true')
            <div class="col col-lg-6">
                @isset($vote->image)  
              
                
                     
                        <div class="card h-100">
                        @if($vote->image !== '' && str_contains($vote->image,'videos'))
                    
                            <a data-fancybox href="#myVideo{{ $vote->id }}">
                                <img class="card-img-top"
                                    src="{{ asset('assets/images/logo/logo.png') }}"
                                />
                            </a>
                            <video width="800" height="500" controls id="myVideo{{ $vote->id }}" style="display:none;">
                                <source src="{{ asset('storage/'.$vote->image) }}" type="video/mp4">
                                Your browser doesn't support HTML5 video tag.
                            </video>
                            
                        @else
                            <img class="card-img-top"
                                src="{{ asset('storage/'.$vote->image) }}" 
                                onerror="this.src='{{ asset('assets/images/logo/logo.png') }}';"
                                alt="Card image cap"
                            >
                        @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ Illuminate\Support\Str::limit($vote->title, 30) }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-end">
                                        <a href="{{ route('vote.poll',$vote->title_slug) }}" class="btn btn-success"> ابدأ </a>
                                        <a href="{{ route('result.show',$vote->title_slug) }}" class="btn btn-secondary"> عرض النتائج </a>
                                    </div>
                                    <div>
                                        
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-light dropdown p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                
                                                <i data-bs-toggle="tooltip" data-bs-placement="right" title=" مشاركة الرأي " class="bi bi-share text-dark me-2"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item h6 text-end" href="https://wa.me/?text={{ route('vote.poll', $vote->title_slug) }}" target="_blank"> 
                                                    <i class="mdi mdi-whatsapp h5 text-success"></i>
                                                    <span> المشاركة عبر الواتساب </span>
                                                </a>
                                                <a  class="dropdown-item h6 text-end" href="https://twitter.com/intent/tweet?text={{ route('vote.poll', $vote->title_slug) }}" target="_blank">
                                                    <i class="mdi mdi-twitter text-primary h5"></i>
                                                    <span> المشاركة عبر تويتر </span>
                                                </a>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        
                    
                @endisset
            </div>
        @endif  
    @empty
        <div class="alert alert-info">لا يوجد استطلاعات رأي حالياً</div>
    @endforelse
 
</div>


@endsection