@extends('panel.app')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">

                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('user.settings.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <h5 class="card-header">Profile Details</h5>
                            <!-- Account -->
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ empty(auth()->user()->image) ? asset('assets/img/avatars/default.jpg') : asset(auth()->user()->image) }}"
                                        alt="user-avatar" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input required type="file" name="image" id="upload" class="account-file-input"
                                                hidden accept="image/png, image/jpeg" />
                                        </label>

                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <br>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Name</label>
                                <input required class="form-control" type="text" id="firstName" name="name"
                                    value="{{ auth()->user()->name }}" autofocus />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input required class="form-control" type="text" id="email" name="email"
                                    value="{{ auth()->user()->email }}" placeholder="john.doe@example.com" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <input required type="text" id="phoneNumber" name="phone" class="form-control"
                                        placeholder="" value="{{ auth()->user()->phone ?? '' }}" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input required type="text" class="form-control" id="address" name="address" value="{{ auth()->user()->address }}"
                                    placeholder="Address" />
                            </div>



                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                    
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
@endsection
<!-- Page JS -->
@section('js')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>

@endsection
