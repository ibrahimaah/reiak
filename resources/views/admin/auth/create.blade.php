@extends('admin.layouts.layout')
@section('content')
<div class="page-content">
    <div class="container-fluid">
<div class="card p-4">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @if (session('message'))
            <div class="mb-3">
                <div class="bg-success">
                    <p class="p-2 text-light">{{ session('message') }}</p>
                </div>
            </div>
        @endif
        <div class="mb-3">
            <label for="employeeName" class="form-label">User Name</label>
            <input type="text" name="name" class="form-control" id="employeeName" placeholder="Enter user name">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="employeeName" class="form-label">User Email</label>
            <input type="email" name="email" class="form-control" id="employeeName" placeholder="Enter user email">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="employeeName" class="form-label">User Phone</label>
            <input type="number" name="number" class="form-control" id="employeeName" placeholder="Enter user email">
            @error('number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="employeeName" class="form-label">User Role</label>
            <select name="role" class="form-control" id="">
                <option value="user"> مستخدم </option>
                <option value="admin"> مدير </option>
            </select>
            @error('role')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="employeeUrl" class="form-label">User Password</label>
            <input type="password" name="password" class="form-control" id="employeeUrl" placeholder="Enter user password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
    </form>
</div>
    </div>
</div>
@endsection