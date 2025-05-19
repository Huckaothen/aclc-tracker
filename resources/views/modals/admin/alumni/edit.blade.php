<!-- Edit Alumni Profile Modal -->
<div class="modal fade" id="editAlumniModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditAlumniModallLabel">Edit Alumni Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAlumniForm" method="POST">
                @csrf
                <input type="hidden" id="edit-alumni-id" name="id">
                <div class="modal-body" style="padding-top: 2px;">
                    <div class="az-content az-content-profile">
                        <div class="container mn-ht-100p">
                            <div class="az-content-left az-content-left-profile" style="width:200px;border:0px;">
                                <div class="az-profile-overview text-center">
                                    <div class="az-img-user">
                                        <img id="edit-alumni-profile" src="" alt="Profile Picture" class="rounded-circle" width="120">
                                    </div>
                                    <input type="file" id="edit-profile-picture" name="profile_picture" class="form-control mt-2">
                                    
                                    <div class="mt-2">
                                        <label class="form-label" style="float: left;">College ID</label>
                                        <input type="text" id="edit-alumni-college-id" name="college_id" class="form-control" required>
    
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" style="float: left;">Full Name</label>
                                        <input type="text" id="edit-alumni-fullname" name="fullname" class="form-control" required>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" style="float: left;">Email</label>
                                        <input type="email" id="edit-alumni-email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mt-1">
                                        <label class="form-label" style="float: left;">Email Verified</label>
                                        <input type="text" id="edit-alumni-email-verified" class="form-control" readonly>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="az-content-body az-content-body-profile">
                                <div class="row mg-b-20">
                                    <div class="col-md-6">
                                        <div class="card p-3">
                                            <h5 class="text-primary"><i class="fas fa-user"></i> Personal Information</h5>
                                            <hr>
                                            <div class="mt-1">
                                            <label>Contact</label>
                                            <input type="text" id="edit-alumni-contact" name="contact" class="form-control" required>
                                            </div>
                                            <div class="mt-1">
                                            <label>Date of Birth</label>
                                            <input type="date" id="edit-alumni-dob" name="dob" class="form-control">
                                            </div>
                                            <div class="mt-1">
                                            <label>Gender</label>
                                            <select id="edit-alumni-gender" name="gender" class="form-control">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            </div>
                                            <div class="mt-1">
                                            <label>Civil Status</label>
                                            <select id="edit-alumni-civil-status" name="civil_status" class="form-control">
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="separated">Separated</option>
                                                <option value="annulled">Annulled</option>
                                            </select>
                                            </div>
                                            <div class="mt-1">
                                            <label>Address</label>
                                            <textarea id="edit-alumni-address" name="address" class="form-control"></textarea>
                                            </div>
                                            <div class="mt-1">
                                            <label class="form-label" style="float: left;">Status</label>
                                            <select id="edit-alumni-status" name="status" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="banned">Banned</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card p-3">
                                            <h5 class="text-primary"><i class="fas fa-graduation-cap"></i> Education & Career</h5>
                                            <hr>
                                            <label>Batch</label>
                                            <input type="number" id="edit-alumni-batch" name="batch" class="form-control">

                                            <label>Course</label>
                                            <select name="graduated_course" id="edit-alumni-course" class="form-control">
                                                @foreach($courses as $code => $name)
                                                    <option value="{{ $code }}">{{ $name }}</option>
                                                @endforeach
                                            </select>

                                            <label>Employment Status</label>
                                            <select id="edit-alumni-employability-status" name="employability_status" class="form-control">
                                                <option value="employed">Employed</option>
                                                <option value="self_employed">Self Employed</option>
                                                <option value="unemployed">Unemployed</option>
                                            </select>

                                            <label>Company Name</label>
                                            <input type="text" id="edit-alumni-company" name="company_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- az-content -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
