@extends('layouts.admin.app')
@section('title', 'ACLC - ATS - Dashboard')
@section('content')
<div class="az-content-body">
  <div class="card card-dashboard-seven">
    <div class="card-header">
      <div class="row row-sm">
        <div class="col-6 col-md-4 col-xl">
          <div class="media">
            <div><i class="icon ion-md-people"></i></div>
            <div class="media-body">
              <label>Total Alumni</label>
              <h3>{{ number_format($totalAlumni) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl">
          <div class="media">
            <div><i class="icon ion-md-checkmark-circle"></i></div>
            <div class="media-body">
              <label>Active Users</label>
              <h3>{{ number_format($activeUsers) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl mg-t-15 mg-md-t-0">
          <div class="media">
            <div><i class="icon ion-md-briefcase"></i></div>
            <div class="media-body">
              <label>Employed Alumni</label>
              <h3>{{ number_format($employedAlumni) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl mg-t-15 mg-xl-t-0">
          <div class="media">
            <div><i class="icon ion-md-school"></i></div>
            <div class="media-body">
              <label>Recently Graduated</label>
              <h3>{{ number_format($recentlyGraduated) }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row row-sm">
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header">
              <h6>Alumni Registration Trends</h6>
            </div>
            <canvas id="alumniChart" class="ht-200"></canvas>
          </div>
        </div>
        <div class="col-lg-5 mg-t-20 mg-lg-t-0">
          <div class="card">
            <div class="card-header">
              <h6>Employment Rate</h6>
            </div>
            <canvas id="employmentChart" class="ht-200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row row-sm mg-b-15 mg-sm-b-20">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h6>Latest Registered Alumni ({{count($latestAlumni)}})</h6>
        </div>
        <div class="table-responsive p-2">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>College ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Batch</th>
                <th>Course</th>
                <th>Registration Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($latestAlumni as $alumni)
                <tr>
                  <td>{{ $alumni->college_id }}</td>
                  <td>{{ $alumni->fullname }}</td>
                  <th>{{ ucfirst($alumni->gender) }}</th>
                  <td>{{ $alumni->contact }}</td>
                  <td>{{ $alumni->batch }}</td>
                  <td>{{ $alumni->graduated_course }}</td>
                  <td>{{ \Carbon\Carbon::parse($alumni->created_at)->format('F d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('raphael.min.js') }}"></script>
<script src="{{ asset('morris.min.js') }}"></script>
<script src="{{ asset('jquery.vmap.min.js') }}"></script>
<script src="{{ asset('jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('jquery.cookie.js') }}"></script>
<script>
  $(function(){
    'use strict';
  
    const registrationLabels = {!! json_encode($registrationTrends->keys()) !!};
    const registrationData = {!! json_encode($registrationTrends->values()) !!};
  
    new Chart(document.getElementById("alumniChart"), {
      type: 'line',
      data: {
        labels: registrationLabels,
        datasets: [{
          label: 'Alumni Registrations',
          data: registrationData,
          borderColor: '#007bff',
          fill: false
        }]
      }
    });
  
    new Chart(document.getElementById("employmentChart"), {
      type: 'doughnut',
      data: {
        labels: ['Employed', 'Self-Employed', 'Unemployed'],
        datasets: [{
          data: [{{ $employedAlumni }}, {{ $selfEmployed }}, {{ $unemployed }}],
          backgroundColor: ['#28a745', '#115bb4','#dc3545']
        }]
      }
    });
  });
  </script>
@endsection
