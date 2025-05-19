<div class="modal fade" id="addEditEventModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditEventModallLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="eventForm" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="mb-3">
                                <label for="event_name" class="form-label">Event Name</label>
                                <input type="text" name="event_name" id="event_name" class="form-control" placeholder="e.g. ACLC Week" required>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="backgroundColor" class="form-label">Background Color</label>
                                <input type="text" name="backgroundColor" id="backgroundColor" value="#000000" class="form-control colorPicker" placeholder="e.g. #00cccc">
                            </div>
                            <div class="mb-3">
                                <label for="borderColor" class="form-label">Border Color</label>
                                <input type="text" name="borderColor" id="borderColor" value="#ffffff" class="form-control colorPicker" placeholder="e.g. #bff2f2">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event Description</label>
                                <div id="event_description" class="quill-editor" placeholder="e.g. aclc week"></div>
                                <input type="hidden" name="event_description_input" id="event_description_input">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="float: left;">Status</label>
                                <select id="edit-alumni-status" name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
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
@section('scripts')
<link rel="stylesheet" href="{{asset('spectrum/spectrum.min.css')}}" />
<script src="{{asset('spectrum/spectrum.min.js')}}"></script>
@endsection