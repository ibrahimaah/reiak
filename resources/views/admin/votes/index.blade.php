@extends('admin.layouts.layout')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
    <div class="card">
    
        <div class="card-body">
            <div id="customerList">
                <div class="row g-4 mb-3">
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <div class="search-box ms-2">
                                
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="table-responsive table-card mt-3 mb-1 px-5">
                    <table class="table align-middle table-nowrap" id="customerTable">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort" data-sort="customer_name">Poll</th>
                                <th class="sort" data-sort="email">Status</th>
                                <th class="sort" data-sort="date">Joining Date</th>
                                <th class="sort" data-sort="action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @forelse ($votes as $vote)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                    </div>
                                </th>
                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#{{ $vote->id }}</a></td>
                                <td class="customer_name">{{ $vote->title }}</td>
                                <td class="email">{{ $vote->status }}</td>
                                <td class="date">{{ $vote->created_at }}</td>
                                <td class='d-flex'>
                                    <div class="d-flex gap-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-status" type="checkbox" role="switch" id="toggle-{{ $vote->id }}" data-vote-id="{{ $vote->id }}" {{ $vote->status == 'true' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="toggle-{{ $vote->id }}"> قبول </label>
                                        </div>
                                    </div>
                                    <div>
                                        <form action='{{route('vote.destroy',$vote->id)}}' method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class='btn btn-danger ms-2'> حذف </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                
                            @endforelse
                                               
                                                 
                        </tbody>
                    </table>
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                            <h5 class="mt-2">Sorry! No Result Found</h5>
                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                        </div>
                    </div>
                </div>
    
                <div class="d-flex justify-content-end">
                    <div class="pagination-wrap hstack gap-2">
                        <a class="page-item pagination-prev disabled" href="#">
                            Previous
                        </a>
                        <ul class="pagination listjs-pagination mb-0"><li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li></ul>
                        <a class="page-item pagination-next" href="#">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- end card -->
    </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        
        $(document).ready(function () {
            $('.toggle-status').on('change', function () {
                var voteId = $(this).data('vote-id');
                var isChecked = $(this).prop('checked');
                console.log(isChecked);
                // Send AJAX request to update the status in the database
                $.ajax({
                    url: 'vote/' + voteId, // Replace with your actual update route
                    method: 'PUT', // Use the appropriate HTTP method
                    data: {
                        _token:'{{ csrf_token() }}',
                        status: isChecked
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    

@endsection