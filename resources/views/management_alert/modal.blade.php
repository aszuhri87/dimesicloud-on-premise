<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center">Create New Alert</h2>
                        <p class="text-center mb-4">Create new alert for notifications</p>
                        <form name="form-submit" method="POST" id="form-submit">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md mb-md-0 mb-2">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="sendEmail">
                                                <span class="custom-option-body">
                                                    <i class="ti ti-mail"></i>
                                                    <span class="custom-option-title">Email</span>
                                                    <small> Send alert to Email.</small>
                                                </span>
                                                <input name="type" class="form-check-input" type="radio"
                                                    value="email" id="sendEmail" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-md-0 mb-2">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="sendTele">
                                                <span class="custom-option-body">
                                                    <i class="ti ti-brand-telegram"></i>
                                                    <span class="custom-option-title"> Telegram </span>
                                                    <small> Send alert to Telegram. </small>
                                                </span>
                                                <input name="type" class="form-check-input" type="radio"
                                                    value="telegram" id="sendTele" />
                                            </label>
                                        </div>
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
