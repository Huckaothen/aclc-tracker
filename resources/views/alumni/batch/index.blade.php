@extends('layouts.alumni.app')

@section('title', 'ACLC Alumni Tracker | Alumni')

@section('content')
<div class="az-content az-content-profile">
    <div class="container">
        <div class="content-wrapper w-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex pb-4 mb-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    <h5 class="page-title mb-n2">Alumni Listings</h5>
                                    <p class="mt-2 mb-n1 ms-3 text-muted">
                                        <span id="alumniCount">{{$alumniCount}}</span> Alumni
                                    </p>
                                </div>

                                <form class="ms-auto d-flex pt-2 pt-md-0 align-items-stretch w-75">
                                    <input type="text" id="search" class="form-control me-3" placeholder="Search names..">
                                    &nbsp;
                                    <select id="batchFilter" class="form-control">
                                        <option value="">All Batches</option>
                                        @foreach($batches as $batch)
                                            <option value="{{ $batch }}" {{ request('batch') == $batch ? 'selected' : '' }}>
                                                Batch {{ $batch }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-danger no-wrap ms-4 btn-sm search-btn" style="height: 20px;">Search</button>
                            </div>

                            <div id="alumni-list-container" class="row row project-list-showcase">
                                @include('alumni.batch.alumni_list', ['alumni' => $alumni, 'groupedAlumni' => $groupedAlumni])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#search').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault();
            }
        });

        $(document).on('click', '.search-btn', function() {
            let batchFilter = $('#batchFilter').val();
            let search = $('#search').val();
            loadAlumni(batchFilter, 1, search); 
        })

        function loadAlumni(batchFilter, page, search = '') {
            $.ajax({
                url: '{{ route('alumni.batch.fetch') }}',
                type: 'GET',
                data: {
                    batch: batchFilter,
                    page: page,
                    search: search
                },
                success: function(data) {
                    $('#alumni-list-container').html(data.html);
                    $('#pagination-container').html(data.pagination);
                    $("#alumniCount").html(data.alumniCount)
                },
                error: function() {
                    alert("Error loading alumni data.");
                }
            });
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let batchFilter = $('#batchFilter').val();
            let search = $('#search').val();
            loadAlumni(batchFilter, page, search);
        });
    });

</script>
@endsection