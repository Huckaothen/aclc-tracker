@extends('layouts.admin.app')
@section('title', 'ACLC - ATS Admin - Alumni Announcement')
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
        <p class="mg-b-0">ACLC Alumni Forum Management</p>
    </div>
    <button class="btn btn-danger btn-sm" id="btnEventAddEdit">
        Add Forum
    </button>
</div>

<div class="az-content-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Alumni Forum Listings</h6>
        </div>
        <div class="table-responsive p-3">
            @php
                function getStatusClass($status) {
                    switch($status) {
                        // case 'approved':
                        //     return 'success'; 
                        case 'pending':
                            return 'warning';
                        // case 'rejected':
                        //     return 'danger';
                        case 'published':
                            return 'success';
                        default:
                            return 'dark';
                    }
                }
            @endphp
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forums as $forum)
                    <tr>
                        <td>{{ $forum->name }}</td>
                        <td>{!! Str::limit(strip_tags($forum->description), 150) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($forum->created_at)->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ getStatusClass($forum->status) }}">{{ ucfirst($forum->status) }}</span>
                        </td>
                        
                        <td>
                            <button class="btn btn-dark btn-sm editEventBtn" data-id="{{ $forum->id }}">
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
@include('modals.admin.forum.add_edit')
@endsection
