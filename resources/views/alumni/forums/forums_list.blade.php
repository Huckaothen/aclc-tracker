@if($groupedForums->isEmpty())
    <div class="alert alert-warning text-center mt-3">
        No forums found.
    </div>
@else
@foreach($groupedForums as $date => $jobGroup)
    @foreach ($jobGroup as $forum)
        <a href="forums/{{ $forum->id }}" class="tickets-card row" style="border-radius: 0px;">
            <div class="tickets-details col-lg-8 col-12">
                <div class="wrapper">
                    <h5>{{ $forum->name }}</h5>
                    @if ($forum->created_at->isToday())
                        <div class="badge badge-success">New</div>
                    @endif
                </div>
                <div class="wrapper text-muted d-none d-md-block">
                    <span><strong>Posted on:</strong> {{ $forum->created_at->format('Y m, d h:i A') }}</span>
                    </div>
                <div class="wrapper text-muted d-none d-md-block">
                    <span>{!! $forum->description !!}</span>
                </div>
            </div>
        </a>
    @endforeach
@endforeach

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    {{ $forums->links('pagination::bootstrap-4') }}
</div>
@endif
