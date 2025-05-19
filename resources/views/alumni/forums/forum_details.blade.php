@extends('layouts.alumni.app')
@section('title', 'ACLC Alumni Tracker |'. $forum->name . '')
@section('content')
<div class="az-content az-content-mail">
    <div class="container">
        <div class="content-wrapper w-100">
            <div class="row">
                <div class="card p-4 mb-4">
                        <h2 class="fw-bold">{{ $forum->name }}  @if ($forum->created_at->isToday())
                            <div class="badge badge-success">New</div>
                        @endif
                        </h2>
                        
                        <div class="tw-flex tw-flex-row tw-space-x-2">
                            <span>
                                <span class="badge bg-dark"><strong>Posted on:</strong></span>
                                {{ $forum->created_at->format('Y m, d h:i A') }}
                            </span>
                        </div>
                    <hr>
                    {{-- <h4 class="fw-bold">Job Brief</h4> --}}
                    <p>{!! $forum->description ?? 'No description available.' !!}</p>
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
  this.page.identifier = '{{ $forum->id }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
