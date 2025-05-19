@extends('layouts.admin.app')
@section('title', 'ACLC - ATS Admin - Alumni')
@section('content')
<div class="az-content-header d-block d-md-flex justify-content-between align-items-center">
    <div>
        <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">
            Hi, <u>{{ ucwords(auth()->user()->name) }}</u>
        </h2>
        <p class="mg-b-0">ACLC Alumni Tracker System</p>
    </div>
    {{-- <button class="btn btn-primary" id="btnCareerAddEdit">
        Add Alumni
    </button> --}}
</div>
<div class="az-content-body">
    <div class="card-dashboard-seven">
        <div class="row mg-b-15 mg-sm-b-20">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Alumni List</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table id="dataTable" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Batch</th>
                                    <th>Course</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Employability</th>
                                    <th>Verified At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumni as $alumnus)
                                <tr>
                                    <td>{{ $alumnus->fullname }}</td>
                                    <td>{{ $alumnus->batch }}</td>
                                    <td>{{ $alumnus->graduated_course }}</td>
                                    <td>{{ $alumnus->email }}</td>
                                    <td>{{ $alumnus->contact }}</td>
                                    <td>{{ $alumnus->employability_status }}</td>
                                    <td>
                                        @if($alumnus->email_verified_at)
                                            <span class="badge bg-success">{{ \Carbon\Carbon::parse($alumnus->email_verified_at)->format('M d, Y') }}</span>
                                        @else
                                            <span class="badge bg-danger">Not Verified</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($alumnus->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($alumnus->status === 'inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @elseif($alumnus->status === 'banned')
                                            <span class="badge bg-danger">Banned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm viewAlumniBtn" data-id="{{$alumnus->id}}">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <button class="btn btn-dark btn-sm editAlumniBtn" data-id="{{$alumnus->id}}">
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
        </div>
    </div>
</div>
@include('modals.admin.alumni.view')
@include('modals.admin.alumni.edit')
@endsection
