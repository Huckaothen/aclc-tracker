@extends('layouts.alumni.app')
@section('title', 'ACLC Alumni Tracker | Home')
@section('content')

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <!-- Welcome Section -->
      <div class="az-dashboard-one-title d-flex justify-content-between align-items-center">
        <div>
          <h2 class="az-dashboard-title">Welcome Back, <u style="color:#cf1441;">{{ \Str::before(auth()->guard('alumni')->user()->fullname ?? 'Guest', ' ') }}</u> !</h2>
          <p class="az-dashboard-text">Reconnect with your fellow alumni, explore opportunities, and stay updated.</p>
        </div>
        <a href="{{route('alumni.profile')}}" class="btn btn-dark btn-sm"><i class="fas fa-edit"></i> Edit Profile</a>
      </div>

      <!-- Quick Stats -->
      <div class="row row-sm mg-b-20">
        <div class="col-lg-3">
          <div class="card card-dashboard-one text-center">
            <h6 class="card-title" style="color:#cf1441;padding-top:12px;">Total Alumni</h6>
            <h2>{{ $totalAlumni ?? 0 }}</h2>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card card-dashboard-one text-center">
            <h6 class="card-title" style="color:#cf1441;padding-top:12px;">Alumni Events</h6>
            <h2>{{ $events_count ?? 0 }}</h2>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card card-dashboard-one text-center">
            <h6 class="card-title" style="color:#cf1441;padding-top:12px;">Job Opportunities</h6>
            <h2>{{ $jobs_count ?? 0 }}</h2>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card card-dashboard-one text-center">
            <h6 class="card-title" style="color:#cf1441;padding-top:12px;">Active Alumni</h6>
            <h2>{{ $activeUsers ?? 0 }}</h2>
          </div>
        </div>
      </div>

      <!-- Alumni Engagement Chart -->
      <div class="row row-sm mg-b-20">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h6 class="card-title" style="color:#cf1441;">📈 Alumni Engagement Overview</h6>
            </div>
            <div class="card-body">
              <canvas id="alumniChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Latest Announcements & Job Postings -->
      <div class="row row-sm mg-b-20">
        <div class="col-lg-6">
          <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 style="color:#cf1441;">📢 Latest Announcements</h6>
                  <a href="{{route('alumni.announcement')}}" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i> View All</a>
              </div>
              <div class="card-body">
                  <ul class="list-group">
                      @foreach($announcements as $announcement)
                          <li class="list-group-item">
                              <strong>{{ $announcement['title'] }}</strong><br>
                              📅 {{ date('F d, Y', strtotime($announcement['date_announce'])) }}<br>
                              <small>{!! Str::limit(strip_tags($announcement['message']), 100) !!}</small>
                          </li>
                      @endforeach
                  </ul>
              </div>
          </div>
        
        </div>

        <div class="col-lg-6">
          <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 style="color:#cf1441;">💼 Featured Job Opportunities</h6>
                  <a href="{{ route('alumni.job') }}" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i> View All</a>
              </div>
              <div class="card-body">
                  <ul class="list-group">
                      @foreach($jobs as $job)
                          <li class="list-group-item">
                              <strong>{{ $job->position }}</strong> at <em>{{ $job->company_name }}</em><br>
                              📍 {{ $job->alumni ? $job->alumni->address : 'N/A' }} |
                              📅 Posted: {{ date('F d, Y', strtotime($job->created_at)) }}<br>
                              <small>{!! Str::limit(strip_tags($job->job_description), 100) !!}</small>
                          </li>
                      @endforeach
                  </ul>
              </div>
          </div>
      </div>      
      
      </div>

      <!-- Upcoming Events -->
      <div class="row row-sm mg-b-20">
        <div class="col-lg-12">
          <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h6 style="color:#cf1441;">✅ Alumni Events</h6>
                  <a href="{{route('alumni.event')}}" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i> View All</a>
              </div>
              <div class="card-body">
                  <ul class="list-group">
                      @foreach($events as $event)
                          <li class="list-group-item">
                              <strong>{{ $event['event_name'] }}</strong><br>
                              📅 {{ date('F d, Y', strtotime($event['start_date'])) }} | 📍 {{ date('F d, Y', strtotime($event['end_date'])) }}<br>
                              <small>{!! $event['description'] !!}</small>
                          </li>
                      @endforeach
                  </ul>
              </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("alumniChart").getContext("2d");
    var alumniChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: @json($chartLabels),
        datasets: [{
          label: "Registered Alumni Per Year",
          data: @json($chartData),
          borderColor: "#4e73df",
          backgroundColor: "rgba(78, 115, 223, 0.2)",
          pointRadius: 5,
          pointBackgroundColor: "#4e73df",
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              display: true
            }
          }
        }
      }
    });
  });
</script>

@endsection
