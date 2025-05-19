@extends('layouts.alumni.app')

@section('title', $job->position . ' - ' . $job->company_name)

@section('content')
<div class="az-content az-content-mail">
    <div class="container">
        <div class="content-wrapper w-100">
            <div class="row">
                    <div class="card p-4 mb-4">
                            <h2 class="fw-bold">{{ $job->position }}</h2>
                            <h5 class="text-muted">{{ ucfirst($job->experience_level ?? 'Not specified') }}</h5>
                            <h4 class="mt-3">{{ $job->company_name }}</h4>
                        <div class="tw-flex tw-flex-row tw-space-x-2">
                        <span class="badge bg-primary">{{ $job->company_size ?? 'Company Size Not Specified' }}</span>
                        <span class="badge bg-dark">{{ $job->category ?? 'Category Not Specified' }}</span>
                        <span class="badge bg-success">Established in {{ $job->company_established ?? 'N/A' }}</span>
                    </div>

                    <p class="text-muted">{{ $job->office_address ?? 'Location Not Provided' }}</p>
                    <p class="text-muted fw-bold">Posted On: {{ \Carbon\Carbon::parse($job->created_at)->format('F d, Y') }}</p>
                    <p class="text-muted fw-bold">Job ID: {{ $job->id }}</p>
                    
                    <hr>

                    <h3 class="fw-bold">Details</h3>
                    <h5 class="fw-bold text-uppercase">{{ $job->position }}</h5>
                    
                    <p><strong>Work Station:</strong> {{ $job->office_address }}</p>
                    <p><strong>Salary Range:</strong> {{ $job->salary ? '₱' . number_format($job->salary, 2) : 'Depends on the applicant’s qualification' }}</p>

                    <h4 class="fw-bold mt-4">Job Brief</h4>
                    <p>{!! $job->job_description ?? 'No description available.' !!}</p>
                    

                    
                    @if($job->company_site)
                        <p><strong>Company Website:</strong> <a href="{{ $job->company_site }}" target="_blank">Visit Website</a></p>
                    @endif
                    
                    @if($job->google_map)
                    <div class="mt-4">
                        <h5>Location Map</h5>
                        <div style="width: 100%;">
                            {!! str_replace('<iframe', '<iframe style="width:100%; height:400px; border:0;"', $job->google_map) !!}
                        </div>
                    </div>
                @endif
                
                </div>
                <div id="disqus_thread"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
<script>
  /**
  *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
  *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
  
  var disqus_config = function () {
  this.page.url = '{{ url()->current() }}';  // Replace PAGE_URL with your page's canonical URL variable
  this.page.identifier = '{{ $job->id }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
  };

  (function() { // DON'T EDIT BELOW THIS LINE
  var d = document, s = d.createElement('script');
  s.src = 'https://aclc-tracker-system.disqus.com/embed.js';
  s.setAttribute('data-timestamp', +new Date());
  (d.head || d.body).appendChild(s);
  })();
</script>
{{-- <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> --}}
@endsection
