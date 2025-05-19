<div class="modal fade" id="addEditJobModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditJobModallLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="jobForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label for="category" class="form-label">Job Category</label>
                                <select id="category" name="category" class="form-control" required>
                                    <option value="" disabled selected>Select a Category</option>
                                    <option value="Accounting / Finance">Accounting / Finance</option>
                                    <option value="Admin / Office / Clerical">Admin / Office / Clerical</option>
                                    <option value="Agriculture / Veterinary">Agriculture / Veterinary</option>
                                    <option value="Airline / Airport">Airline / Airport</option>
                                    <option value="Arts / Media / Design">Arts / Media / Design</option>
                                    <option value="Call Center / BPO">Call Center / BPO</option>
                                    <option value="Domestic / Caretaker">Domestic / Caretaker</option>
                                    <option value="Education / Schools">Education / Schools</option>
                                    <option value="Engineering / Architecture">Engineering / Architecture</option>
                                    <option value="Food / Restaurant">Food / Restaurant</option>
                                    <option value="Foreign Language">Foreign Language</option>
                                    <option value="Government / Non-profit">Government / Non-profit</option>
                                    <option value="HR / Recruitment / Training">HR / Recruitment / Training</option>
                                    <option value="Health / Medical / Science">Health / Medical / Science</option>
                                    <option value="Hotel / Spa / Salon">Hotel / Spa / Salon</option>
                                    <option value="IT / Computers">IT / Computers</option>
                                    <option value="Legal / Documentation">Legal / Documentation</option>
                                    <option value="Logistics / Warehousing">Logistics / Warehousing</option>
                                    <option value="Maritime / Seabased">Maritime / Seabased</option>
                                    <option value="Production / Manufacturing">Production / Manufacturing</option>
                                    <option value="Purchasing / Buyer">Purchasing / Buyer</option>
                                    <option value="Sales / Marketing / Retail">Sales / Marketing / Retail</option>
                                    <option value="Skilled Work / Technical">Skilled Work / Technical</option>
                                    <option value="Sports / Athletics">Sports / Athletics</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="e.g. Tech Corp" required>
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" name="position" id="position" class="form-control" placeholder="e.g. Software Engineer" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="e.g. Cebu City" required>
                            </div>
                            <div class="mb-3">
                                <label for="company_site" class="form-label">Company Website</label>
                                <input type="text" name="company_site" id="company_site" class="form-control" placeholder="e.g http://www.company.com">
                            </div>
                            <div class="mb-3">
                                <label for="experience_level" class="form-label">Experience Level</label>
                                <input type="text" name="experience_level" id="experience_level" class="form-control" placeholder="e.g. 1 Year or Less">
                            </div>
                            <div class="mb-3">
                                <label for="qualification" class="form-label">Qualification</label>
                                <input type="text" name="qualification" id="qualification" class="form-control" placeholder="e.g. High School Graduates are Welcome">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Leave empty if current job">
                            </div>
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" name="salary" id="salary" class="form-control" placeholder="e.g. 75000" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="company_established" class="form-label">Year Established</label>
                                <input type="number" name="company_established" id="company_established" class="form-control" placeholder="e.g. 2016">
                            </div>
                            <div class="mb-3">
                                <label for="company_size" class="form-label">Company Size</label>
                                <input type="text" name="company_size" id="company_size" class="form-control" placeholder="e.g. 1001-5000 employees">
                            </div>
                            <div class="mb-3">
                                <label for="office_address" class="form-label">Office Address</label>
                                <input type="text" name="office_address" id="office_address" class="form-control" placeholder="e.g. 16th Floor, One Montage">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="google_map" class="form-label">Google Map <a href="https://www.google.com/maps">Google Map</a></label>
                                <textarea class="form-control" name="google_map" id="google_map" placeholder="Add Google map"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Job Description</label>
                                <div id="job_description" class="quill-editor" placeholder="e.g. Responsible for developing and maintaining web applications."></div>
                                <input type="hidden" name="job_description_input" id="job_description_input">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
