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
    console.log('hey')
  // Use jQuery or vanilla JavaScript to show the modal on page load
  $(document).ready(function() {
      if(!localStorage.getItem('alert')){
             $('#staticBackdrop').modal('show');
             localStorage.setItem('alert', 'true');
      }
 

  });
</script>
<div class="row">
    @forelse ($votes as $vote)
    @if ($vote->status == 'true')
        <div class="col-12 col-lg-6">
            <!-- Simple card -->
            <div class="card" style='height:330px;'>
             

                <img class="card-img-top" 
                        width='100%' 
                        height='200px' 
                        src="{{ asset('files/'.$vote->image) }}" 
                        onerror="this.src='{{ asset('assets/images/logo/logo.png') }}';"
                        alt="Card image cap">
          
                <div class="card-body">
                    <h4 class="card-title mb-2">{{ Illuminate\Support\Str::limit($vote->title, 30) }} </h4>
                    {{-- <p class="card-text">At missed advice my it no sister. Miss told ham dull knew see she spot near can. Spirit her entire her called.</p> --}}
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
            </div><!-- end card -->
        </div>
    @endif
       
    @empty
        
    @endforelse
 
</div>


@endsection