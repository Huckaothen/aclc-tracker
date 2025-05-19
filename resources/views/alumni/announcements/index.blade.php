@extends('layouts.alumni.app')

@section('title', 'ACLC Alumni Tracker | Announcement Listing')

@section('content')
<div class="az-content az-content-profile">
  <div class="container mn-ht-100p">
    <div class="content-wrapper w-100">
      <div class="page-header">
        <h3 class="page-title"> Announcement </h3>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="faq-section">
                <div class="container-fluid bg-dark py-2">
                  <p class="mb-0 text-white">Latest Announcements</p>
                </div>

                <div id="accordion-announcements" class="accordion mt-4">
                  @forelse($announcements as $index => $announcement)
                    <div class="card">
                      <div class="card-header" id="heading{{ $index }}">
                        <h5 class="mb-0">
                          <a 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapse{{ $index }}" 
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                            aria-controls="collapse{{ $index }}"
                            class="{{ $index !== 0 ? 'collapsed' : '' }}"
                          >
                          {{ $announcement->title }}
                          <small class="text-muted d-block" style="font-size: 10px;">Published on: {{ \Carbon\Carbon::parse($announcement->date_announce)->format('F d, Y') }}</small>
                          </a>
                        </h5>
                      </div>
                      <div 
                        id="collapse{{ $index }}" 
                        class="collapse {{ $index === 0 ? 'show' : '' }}" 
                        aria-labelledby="heading{{ $index }}" 
                        data-bs-parent="#accordion-announcements"
                      >
                        <div class="card-body">
                          {!! $announcement->message !!}
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="text-center mt-4">
                      <p>No announcements available at the moment.</p>
                    </div>
                  @endforelse
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- container -->
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
@endsection
