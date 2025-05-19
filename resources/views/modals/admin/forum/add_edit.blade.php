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
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Pick a topic" required>
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <div id="description" class="quill-editor" placeholder="e.g. what is in your mind?"></div>
                                <input type="hidden" name="description_input" id="description_input">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="float: left;">Status</label>
                                <select id="edit-alumni-status" name="status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="published">Published</option>
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