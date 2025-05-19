@extends('layouts.admin.app')
@section('title', 'ACLC - ATS Admin - Alumni Jobs')
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
        <p class="mg-b-0">ACLC Alumni Job Management</p>
    </div>
    <button class="btn btn-danger btn-sm" id="btnCareerAddEdit">
        Add Job
    </button>
</div>

<div class="az-content-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Alumni Job Listings</h6>
        </div>
        <div class="table-responsive p-3">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Salary</th>
                        <th>Start Date</th>
                        <th>Posted By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->position }}</td>
                        <td>{{ $job->company_name }}</td>
                        <td>{{ $job->salary ? '₱' . number_format($job->salary, 2) : 'Not disclosed' }}</td>
                        <td>{{ \Carbon\Carbon::parse($job->start_date)->format('M d, Y') }}</td>
                        <td>
                            @if ($job->alumni)
                                <span class="badge bg-primary">Alumni: {{ $job->alumni->fullname }}</span>
                            @elseif ($job->admin)
                                <span class="badge bg-warning">Admin: {{ $job->admin->name }}</span>
                            @endif
                        </td>
                        <td>
                            <select class="form-select updateStatus" data-id="{{ $job->id }}">
                                <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $job->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $job->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="draft" {{ $job->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="closed" {{ $job->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </td>
                        <td>
                           
                            <button class="btn btn-info btn-sm viewJobBtn" data-id="{{ $job->id }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn btn-dark btn-sm editJobBtn" data-id="{{ $job->id }}">
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
@include('modals.admin.career.add_edit')
@include('modals.admin.career.view_modal')
@endsection
