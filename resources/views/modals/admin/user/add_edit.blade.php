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
                                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="e.g. john@yahoo.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="e.g. ******" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="float: left;">Status</label>
                                <select id="edit-alumni-status" name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
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