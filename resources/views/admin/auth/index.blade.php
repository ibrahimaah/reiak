@extends('admin.layouts.layout')
@section('content')
<div class="page-content">
    <div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Add, &amp; Remove</h4>
    </div><!-- end card header -->

    <div class="card-body">
        <div id="customerList">
            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a type="button" class="btn btn-success add-btn" href="{{ route('user.create') }}" ><i class="ri-add-line align-bottom me-1"></i> Add</a>
                        {{-- <button class="btn btn-subtle-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> --}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="d-flex justify-content-sm-end">
                        <div class="search-box ms-2">
                            {{-- <input type="text" class="form-control search" placeholder="Search...">
                            <i class="ri-search-line search-icon"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
            @if (session('message'))
                <div class="mb-3">
                    <div class="bg-success">
                        <p class="p-2 text-light">{{ session('message') }}</p>
                    </div>
                </div>
            @endif
            <div>
                <h5><strong>Users Count :</strong> {{$users->count()}} </h5>
            </div>
            <div class="table-responsive table-card mt-3 mb-1 px-3">
                <table class="table align-middle table-nowrap" id="customerTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 50px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th class="sort" data-sort="customer_name">User</th>
                            <th class="sort" data-sort="email">Email</th>
                            <th class="sort" data-sort="email">Phone</th>
                            <th class="sort" data-sort="date">Joining Date</th>
                            <th class="sort" data-sort="action">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list form-check-all">
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                    </div>
                                </th>
                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                <td class="customer_name">{{ $user->name }}</td>
                                <td class="email">{{ $user->email }}</td>
                                <td class="email">{{ $user->number }}</td>
                                <td class="date">{{ date('d m, Y',strtotime($user->created_at)) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        {{-- <div class="edit">
                                            <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                        </div> --}}
                                        <div class="remove">
                                            <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="return confirm('هل تريد فعلا مسح هدا العنصر؟');" data-bs-toggle="modal" type="submit" data-bs-target="#deleteRecordModal">Remove</button>
                                            </form>
                                         
                                        </div>
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
@endsection