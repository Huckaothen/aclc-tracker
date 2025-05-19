@if($groupedAlumni->isEmpty())
    <div class="row">
        <div class="col-md-12 project-grid" style="margin-bottom: 5px;">
            <div class="alert alert-warning text-center mt-3">
                No alumni available at the moment. Please check back later.
            </div>
        </div>
    </div>
@else
    @foreach($groupedAlumni as $batch => $alumniGroup)
        <div class="row">
            <div class="col-md-12 project-grid" style="margin-bottom: 5px;">
                <h4>Batch: {{ $batch }}</h4>
            </div>
            @foreach($alumniGroup as $alumnus)
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 project-grid">
                    <div class="project-grid-inner">
                        <div class="d-flex align-items-start">
                            <div class="wrapper">
                                <h5 class="project-title">{{ $alumnus->fullname }}</h5>
                                <p class="project-location">{{ $alumnus->college_id }}</p>
                            </div>
                            <div class="badge badge-dark ms-auto">{{ $alumnus->batch }}</div>
                        </div>
                        <p class="project-description">{{ $alumnus->address }}</p>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2 font-weight-medium">{{ ucfirst($alumnus->gender) }}</p>
                            <p class="mb-2 font-weight-medium">{{ ucfirst($alumnus->graduated_course) }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="action-tags d-flex flex-row">
                                <div class="project-actions d-flex justify-content-between">
                                    <a href="{{ route('alumni.profile', $alumnus->id) }}" class="btn btn-danger btn-sm">View Profile</a>
                                </div>
                            </div>
                            <div class="image-grouped">
                                <img class="img-xs rounded-circle" src="{{ $alumnus->profile_picture 
                                    ? asset('storage/' . $alumnus->profile_picture) 
                                    : asset('storage/profile_pictures/default.png') }}" alt="profile image">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endif

<!-- Pagination Links -->
<div class="row">
    <div class="col-md-12 project-grid" style="margin-bottom: 5px;">
        <div class="pagination-container">
            {!! $alumni->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
