@extends('layouts.alumni.app')
@section('title', 'ACLC Alumni Tracker | Profile')
@section('content')


<div class="az-content az-content-profile">
    <div class="container mn-ht-100p">
        <div class="az-content-left az-content-left-profile">
            <div class="az-profile-overview">
                <div class="az-img-user">
                    <img src="{{ auth()->guard('alumni')->user()->profile_picture 
                                    ? asset('storage/' . auth()->guard('alumni')->user()->profile_picture) 
                                    : asset('storage/profile_pictures/default.png') }}" 
                         alt="Alumni Profile" class="rounded-circle img-fluid">
                </div>

                <div class="d-flex justify-content-between mg-b-20">
                    <div>
                        <h5 class="az-profile-name">{{ $alumni->fullname }}</h5>
                        <p class="az-profile-name-text"><strong>College ID</strong>: {{ $alumni->college_id }}</p>
                        <p class="az-profile-name-text"><strong>Batch:</strong> {{ $alumni->batch }}</p>
                        <p class="az-profile-name-text"><strong>Course:</strong> {{ $alumni->graduated_course }}</p>
                        <p class="az-profile-name-text">
                            <strong>Status:</strong> 
                            <span class="badge bg-{{ $alumni->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($alumni->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="btn-icon-list">
                        @if(auth()->guard('alumni')->check() && $is_edit)
                            <button class="btn btn-indigo btn-icon" id="editAlumniBtn">
                                <i class="typcn typcn-edit"></i>
                            </button>
                        @endif
                    </div>
                </div>

                <div class="az-profile-bio">
                    <p><strong>Employability Status:</strong> {{ ucfirst($alumni->employability_status) }}</p>
                    @if($alumni->employability_status !== 'unemployed')
                        <p><strong>Company:</strong> {{ $alumni->company_name }}</p>
                    @endif
                </div>

                <hr class="mg-y-30">
                <label class="az-content-label tx-13 mg-b-20">Social Profiles</label>
                <div class="az-profile-social-list">
                    @foreach (['facebook' => 'facebook', 'linkedin' => 'linkedin', 'twitter' => 'twitter', 'github' => 'github'] as $platform => $icon)
                        @if($alumni->{$platform . '_link'})
                            <div class="media">
                                <div class="media-icon"><i class="icon ion-logo-{{ $icon }}"></i></div>
                                <div class="media-body">
                                    <span>{{ ucfirst($platform) }}</span>
                                    <a href="{{ $alumni->{$platform . '_link'} }}" target="_blank">{{ $alumni->{$platform . '_link'} }}</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="az-content-body az-content-body-profile">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab">
                        <i class="typcn typcn-chart-area-outline"></i> Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                        <i class="fas fa-briefcase"></i> Posted Jobs
                    </button>
                </li>
            </ul>
            <div class="tab-content mt-3">
                <div class="az-profile-body tab-pane fade show active" id="home" role="tabpanel">
                    <div class="row mg-b-20">
                        <div class="col-md-8">
                            <div class="az-content-label tx-13 mg-b-25">Posted Jobs</div>
                            <div class="az-profile-work-list">
                                @forelse( $alumni->jobs()->latest()->take(1)->orderBy('id', 'desc')->get() as $job)
                                    @php
                                        $start = \Carbon\Carbon::parse($job->start_date);
                                        $end = $job->end_date ? \Carbon\Carbon::parse($job->end_date) : now();
                                        $years = $start->diffInYears($end);
                                    @endphp
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>
                                                {{ $job->position }} at 
                                                <a href="{{ $job->company_site ?? 'javascript://;' }}" target="_blank">
                                                    {{ $job->company_name }}
                                                </a>
                                            </h6>
                                            <span>
                                                {{ $start->format('M Y') }} - {{ $job->end_date ? $end->format('M Y') : 'Present' }} 
                                                ({{ $years }} {{ Str::plural('year', $years) }})
                                            </span>
                                            <p>{!! Str::limit(strip_tags($job->job_description), 150) !!}</p>
                                            <p><strong>Salary:</strong> {{ $job->salary ? '$' . number_format($job->salary, 2) : 'Not Disclosed' }}</p>
                                            <p><span class="badge bg-{{ $job->status == 'approved' ? 'success' : 'danger' }}">
                                                {{ ucfirst($job->status) }}
                                            </span></p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No job posted added yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Contact Information -->
                            <div class="az-content-label tx-13 mg-b-20">Contact Information</div>
                            <div class="az-profile-contact-list">
                                <div class="media">
                                    <div class="media-icon"><i class="icon ion-md-mail"></i></div>
                                    <div class="media-body">
                                        <span>Email</span>
                                        <a href="mailto:{{ $alumni->email }}">{{ $alumni->email }}</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon"><i class="icon ion-md-call"></i></div>
                                    <div class="media-body">
                                        <span>Phone</span>
                                        <a href="tel:{{ $alumni->contact }}">{{ $alumni->contact }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mg-y-40">
                        <!-- Profile Status -->
                        <div class="az-content-label tx-13 mg-b-20">Profile Details</div>
                        <ul class="list-group" style="margin:0px;padding:0px;width:100%;">
                            <li class="list-group-item"><strong>Gender:</strong> {{ ucfirst($alumni->gender) }}</li>
                            <li class="list-group-item"><strong>Civil Status:</strong> {{ ucfirst($alumni->civil_status) }}</li>
                            <li class="list-group-item">
                                <strong>Date of Birth:</strong> 
                                {{ $alumni->dob ? \Carbon\Carbon::parse($alumni->dob)->format('F d, Y') : 'N/A' }}
                            </li>
                            <li class="list-group-item"><strong>Address:</strong> {{ $alumni->address ?? 'Not provided' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="az-profile-body tab-pane fade" id="profile" role="tabpanel">
                    <h3>Posted Jobs</h3>
                     <!-- Add Job Button -->
                    <button class="btn btn-danger btn-sm mb-3" id="addJobBtn">
                        <i class="typcn typcn-plus"></i> Add Job
                    </button>
                    <table class="table table-bordered mg-b-0" id="postedTable">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Salary</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
<!-- Edit Alumni Profile Modal -->
@include('modals.alumni.profile_modal')
@include('modals.alumni.jobs_modal')
@endsection
@section('scripts')
<script src="{{asset('bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('quill.snow/quill.min.js') }}"></script>
{{-- <script src="{{ asset('custom/admin.career.js') }}"></script> --}}
<script>
    $(document).ready(function(){

        var quill = new Quill('#job_description', {
            theme: 'snow',
            placeholder: 'Enter job description...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link']
                ]
            }
        });

        quill.on('text-change', function () {
            $('#job_description_input').val(quill.root.innerHTML);
        });

        $(document).on('click', '#addJobBtn', function() {
            quill.setText("")
            $("#addEditJobModallLabel").html("Add Job");
            $("#jobForm").trigger('reset')
            $("#addEditJobModal").modal("show")
        });

        $('#jobForm').submit(function (e) {
            e.preventDefault();


            let formData = new FormData(this);

            let jobDescription = quill.getText().trim().length ? quill.root.innerHTML : '';

            formData.set('job_description', jobDescription);

            $.ajax({
                url: "{{route('alumni.profile.store')}}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#jobForm button[type="submit"]').prop('disabled', true).text('Submitting...');
                },
                success: function (response) {
                    if (response.success) {
                        $('#addEditJobModal').modal('hide');
                        alert(response.message);
                        fetchJobs()
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = "Please fix the following errors:\n\n";

                        $.each(errors, function (field, messages) {
                            errorMessage += "- " + messages.join("\n") + "\n";
                        });

                        alert(errorMessage);
                    } else {
                        alert('An unexpected error occurred. Please try again.');
                    }
                },
                complete: function () {
                    $('#jobForm button[type="submit"]').prop('disabled', false).text('Submit');
                }
            });
        });

        $(document).on('click', '.editJobBtn', function () {
            let jobId = $(this).data('id');
        
            $.ajax({
                url: "profile/" + jobId + "/show-jobs",
                type: "GET",
                success: function (response) {
                    if (response.success) {
                        let job = response.job;
        
                        $('#id').val(job.id);
                        $('#category').val(job.category);
                        $('#company_name').val(job.company_name);
                        $('#position').val(job.position);
                        $('#salary').val(job.salary);
                        $('#company_site').val(job.company_site);
                        $('#location').val(job.location);
                        $('#office_address').val(job.office_address);
                        $('#company_established').val(job.company_established);
                        $('#company_size').val(job.company_size);
                        $('#is_featured').val(job.is_featured ? '1' : '0');
                        $('#start_date').val(job.start_date ? job.start_date.split('T')[0] : '');
                        $('#end_date').val(job.end_date ? job.end_date.split('T')[0] : '');
                        $('#google_map').val(job.google_map);
                        $('#experience_level').val(job.experience_level);
                        $('#qualification').val(job.qualification);
                        $('#status').val(job.status);
                        
                        // Set job description content inside Quill Editor
                        quill.root.innerHTML = job.job_description;
        
                        // Update Modal Title and Show Modal
                        $("#addEditJobModallLabel").text("Edit Job");
                        $("#addEditJobModal").modal('show');
                    } else {
                        alert("Job not found!");
                    }
                },
                error: function () {
                    alert("Error fetching job details. Please try again.");
                }
            });
        });    
        
        // ================================ job posted =====================
        function fetchJobs() {
            $.ajax({
                url: "{{route('alumni.profile.jobs')}}",
                type: "GET",
                success: function (response) {
                    let jobs = response.jobs;
                    let jobRows = "";

                    jobs.forEach(function (job) {
                    let startDate = job.start_date ? new Date(job.start_date).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }) : 'N/A';
                    let endDate = job.end_date ? new Date(job.end_date).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }) : 'N/A';

                    jobRows += `
                        <tr>
                            <td>${job.position}</td>
                            <td>${job.company_name}</td>
                            <td>${job.salary ? '₱' + parseFloat(job.salary).toLocaleString() : 'Not specified'}</td>
                            <td>${startDate}</td>
                            <td>${endDate}</td>
                            <td><span class="badge bg-${getStatusClass(job.status)}">${job.status}</span></td>
                            <td>
                                <button class="btn btn-sm btn-dark editJobBtn" data-id='${job.id}'><i class="typcn typcn-edit"></i> Edit</button>
                            </td>
                        </tr>
                    `;
                });

                    $("#postedTable").find('tbody').html(jobRows);
                },
                error: function () {
                    $("#postedTabletable").find('tbody').html("<tr><td colspan='7' class='text-danger text-center'>Failed to load jobs.</td></tr>");
                }
            });
        }


        function getStatusClass(status) {
            switch (status) {
                case "approved": return "success";
                case "pending": return "warning";
                case "rejected": return "danger";
                case "closed": return "secondary";
                case "draft": return "dark";
                default: return "primary";
            }
        }

        $('#profile-tab').on('click', function () {
            fetchJobs();
        });
        // ===========================================
















        $("#editAlumniBtn").click(function() {
            let alumniId = {{auth()->guard('alumni')->user()->id}};

            $.ajax({
                url: "profile/" + alumniId + '/show',
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.message === "success") {
                        let data = response.data;
                        $("#edit-alumni-id").val(data.id);
                        $("#edit-alumni-email").val(data.email);
                        $("#edit-alumni-college-id").val(data.college_id);
                        $("#edit-alumni-fullname").val(data.fullname);
                        $("#edit-alumni-contact").val(data.contact);
                        $("#edit-alumni-dob").val(data.dob);
                        $("#edit-alumni-address").val(data.address);
                        $("#edit-alumni-gender").val(data.gender.toLowerCase());
                        $("#edit-alumni-civil-status").val(data.civil_status.toLowerCase());
                        $("#edit-alumni-batch").val(data.batch);
                        $("#edit-alumni-course").val(data.graduated_course);
                        $("#edit-alumni-employability-status").val(data.employability_status.replace(" ", "_").toLowerCase());
                        $("#edit-alumni-company").val(data.company_name);

                        $("#github-link").val(data.github_link);
                        $("#facebook-link").val(data.facebook_link);
                        $("#twitter-link").val(data.twitter_link);
                        $("#linkedin-link").val(data.linkedin_link);

                        $("#edit-alumni-email-verified").val(data.email_verified_at);
                        $("#edit-alumni-status").val(data.status.toLowerCase());
                        $("#edit-alumni-profile").attr("src", data.profile_picture ?? "default.jpg");

                        // Show modal
                        $("#editAlumniModal").modal("show");
                    }
                },
                error: function(xhr) {
                    alert("Failed to retrieve data. Please try again.");
                }
            });
        });

        $(document).on('click', '.btn-close', function(){
            $("#editAlumniModal").modal("hide");
        })

        $("#editAlumniForm").submit(function (e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            let alumniId = $("#edit-alumni-id").val();

            $.ajax({
                url: "profile/update/" + alumniId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#editAlumniForm button[type='submit']").prop("disabled", true).text("Updating...");
                },
                success: function (response) {
                    alert("Profile updated successfully!");
                    $("#editAlumniModal").modal("hide");
                    location.reload();
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = "";

                    $.each(errors, function (key, value) {
                        errorMessages += value[0] + "\n";
                    });

                    alert("Update failed:\n" + errorMessages);
                    $("#editAlumniForm button[type='submit']").prop("disabled", false).text("Save Changes");
                }
            });
        });
    })
</script>
@endsection
