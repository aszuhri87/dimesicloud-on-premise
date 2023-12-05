@extends('layouts.app')

@section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-body">
                    <form name="form-submit" method="POST" id="form-submit">
                        @csrf
                        <div class="mb-3">
                            {{-- <label class="form-label" for="basic-default-fullname">Full Name</label> --}}
                            <div class="row">
                                <div class="col-md mb-md-0 mb-2">
                                  <div class="form-check custom-option custom-option-icon">
                                    <label class="form-check-label custom-option-content" for="sendTele">
                                      <span class="custom-option-body">
                                        <i class="ti ti-brand-telegram"></i>
                                        <span class="custom-option-title">Telegram</span>
                                        <small> Send alert to Telegram.</small>
                                      </span>
                                      <input
                                        name="type"
                                        class="form-check-input"
                                        type="radio"
                                        value="telegram"
                                        id="sendTele"
                                        />
                                    </label>
                                  </div>
                                </div>
                                <div class="col-md mb-md-0 mb-2">
                                  <div class="form-check custom-option custom-option-icon">
                                    <label class="form-check-label custom-option-content" for="sendEmail">
                                      <span class="custom-option-body">
                                        <i class="ti ti-mail-share"></i>
                                        <span class="custom-option-title"> Email </span>
                                        <small> Send alert to Email. </small>
                                      </span>
                                      <input
                                        name="type"
                                        class="form-check-input"
                                        type="radio"
                                        value="email"
                                        id="sendEmail" />
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <div class="mb-3 form-place">
                          {{-- <div class="form-text">You can use letters, numbers & periods</div> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @include('management_alert.script')
    {{-- @include('dashboard.script-table') --}}
@endpush
