<div class="modal fade" id="viewJobModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Job Details -->
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Company Name:</strong> <span id="viewCompanyName"></span></p>
                        <p><strong>Position:</strong> <span id="viewPosition"></span></p>
                        <p><strong>Category:</strong> <span id="viewCategory"></span></p>
                        <p><strong>Company Site:</strong> <span id="viewCompanySite"></span></p>
                        <p><strong>Location:</strong> <span id="viewLocation"></span></p>
                        <p><strong>Office Address:</strong> <span id="viewOfficeAddress"></span></p>
                        <p><strong>Company Established:</strong> <span id="viewCompanyEstablished"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Company Size:</strong> <span id="viewCompanySize"></span></p>
                        <p><strong>Is Featured:</strong> <span id="viewIsFeatured"></span></p>
                        <p><strong>Start Date:</strong> <span id="viewStartDate"></span></p>
                        <p><strong>End Date:</strong> <span id="viewEndDate"></span></p>
                        <p><strong>Salary:</strong> <span id="viewSalary"></span></p>
                        <p><strong>Experience Level:</strong> <span id="viewExperienceLevel"></span></p>
                        <p><strong>Qualification:</strong> <span id="viewQualification"></span></p>
                        <p><strong>Status:</strong> <span id="viewStatus"></span></p>
                    </div>
                </div>
                <hr>
                <!-- Job Description -->
                <h6>Job Description:</h6>
                <p id="viewJobDescription"></p>

                <hr>
                <!-- Google Maps Preview -->
                <h6>Google Maps Preview:</h6>
                <div id="map-container" class="custom-container" style="width: 100%; height: 435px;">
                    <iframe id="map-canvas" width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>