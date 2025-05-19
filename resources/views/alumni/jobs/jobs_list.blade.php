@if($groupedJobs->isEmpty())
    <div class="alert alert-warning text-center mt-3">
        No jobs available at the moment. Please check back later.
    </div>
@else
@foreach($groupedJobs as $date => $jobGroup)
    @foreach($jobGroup as $job)
        <a href="jobs/{{ $job->id }}" style="border-radius: 0px;">
            <div class="job-card row p-3 mb-3 border rounded shadow-sm">
                <div class="col-md-8">
                    <h5 class="mb-1 text-dark">{{ $job->position }}</h5>
                    <p class="fw-bold text-dark">{{ $job->company_name }}</p>
                    <p class="text-muted">{{ $job->location ?? 'Location not provided' }}</p>
                    <p class="text-muted">{!! Str::limit(strip_tags($job->job_description), 150) !!}</p>
                    
                    <!-- Display Category, Company Size, and Established Year as Badges -->
                    <div class="tw-flex tw-flex-row tw-space-x-2 mt-2">
                        <span class="badge bg-primary">{{ $job->category ?? 'Category Not Specified' }}</span>
                        <span class="badge bg-dark">{{ $job->company_size ?? 'Company Size Not Specified' }}</span>
                        <span class="badge bg-success">Established in {{ $job->company_established ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="col-md-4 text-md-end">
                    <p class="fw-bold text-danger">
                        {{ $job->salary ? 'PHP ' . number_format($job->salary, 2) . ' per month' : 'Salary not disclosed' }}
                    </p>
                    <p class="text-muted">
                        {{ $job->experience_level ?? 'No Experience Required' }}
                    </p>
                    <small class="text-muted">
                        Posted On: {{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}
                    </small>
                </div>
            </div>
        </a>
    @endforeach
@endforeach

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    {{ $jobs->links('pagination::bootstrap-4') }}
</div>
@endif
