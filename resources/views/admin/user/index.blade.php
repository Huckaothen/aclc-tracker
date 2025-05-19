@extends('layouts.admin.app')
@section('title', 'ACLC - ATS Admin - Alumni Users')
@section('content')
<style>
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>

<div class="az-content-header d-block d-md-flex justify-content-between align-items-center">
    <div>
        <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">
            Hi, <u>{{ ucwords(auth()->user()->name) }}</u>
        </h2>
        <p class="mg-b-0">Users Management</p>
    </div>
    <button class="btn btn-danger btn-sm" id="btnEventAddEdit">
        Add User
    </button>
</div>

<div class="az-content-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Users Management</h6>
        </div>
        <div class="table-responsive p-3">
          
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($user->status === 'inactive')
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                        <td>
                            <button class="btn btn-dark btn-sm editEventBtn" data-id="{{ $user->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('modals.admin.user.add_edit')
@endsection
