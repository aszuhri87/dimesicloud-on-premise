<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">Create Bucket</h2>
                        {{-- <p class="text-center mb-4">Create new alert for notifications</p> --}}
                        <form name="form-submit" action="/object-storage/create-bucket" method="POST" id="form-submit">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md mb-md-0 mb-2">
                                            <label for="name" class="form-label">Bucket Name</label>
                                            <input name="name" class="form-control" type="text" id="name" placeholder="Enter bucket name ..."/>
                                            <br>
                                            {{-- <label for="sshkey" class="form-label">SSH Key</label>
                                            <textarea name="sshkey" class="form-control" type="text" id="sshkey" placeholder="Enter SSH key ..." cols="30" rows="7"></textarea> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 form-place">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
