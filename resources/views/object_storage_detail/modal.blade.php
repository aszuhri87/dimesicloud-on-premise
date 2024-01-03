<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">Create Object</h2>
                        <form action="/object-storage/{{ Request::segment(2) }}/create-object" method="post"
                            class="dropzone" id="object-dropzone">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="details" class="">Object Files</label>
                                        <div class="dz-message needsclick">
                                            Drop Files or Click to Upload
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="switch">
                                    <input type="checkbox" class="switch-input" name="type" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label">Private</span>
                                </label>
                            </div>
                        </form>
                        <div class="mb-3 form-place">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary btn-save-object">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="modalShare" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">Share project</h2>
                        {{-- <p class="text-center mb-4">Create new alert for notifications</p> --}}
                        <form name="form-submit" class="form-share" method="POST" id="form-share"
                            enctype="multipart/form-data">
                            @csrf
                            <label for="timeout"> Set Timeout</label>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <input type="number" class="form-control mb-2" name="timeout" id="timeout">
                                </div>
                                <div class="col-6">
                                    <select name="time" id="time" class="form-control">
                                        <option value=""> -- Select Time --</option>
                                        <option value="minute"> Minute </option>
                                        <option value="hour"> Hour </option>
                                        <option value="day"> Day </option>
                                        <option value="month"> Month </option>
                                        <option value="year"> Year </option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary btn-generate">Generate Link</button>
                            <div class="generated-link">

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
