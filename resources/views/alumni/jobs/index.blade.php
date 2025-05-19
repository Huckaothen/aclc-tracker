@extends('layouts.alumni.app')

@section('title', 'ACLC Alumni Tracker | Job Listings')

@section('content')
<div class="az-content az-content-mail">
    <div class="container">
        <div class="content-wrapper w-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex pb-4 mb-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    <h5 class="page-title mb-n2">Job Listings</h5>
                                    <p class="mt-2 mb-n1 ms-3 text-muted">
                                        <span id="jobCount">0</span> Jobs
                                    </p>
                                </div>

                                <!-- Widened Search Form -->
                                <form class="ms-auto d-flex pt-2 pt-md-0 align-items-stretch w-75">
                                    <input type="text" id="searchJob" class="form-control me-3" placeholder="Search Jobs">
                                    <button type="button" class="btn btn-danger no-wrap ms-4 btn-sm search-btn" style="height: 20px;">Search</button>
                                </form>
                            </div>

                            <div id="jobsContainer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
