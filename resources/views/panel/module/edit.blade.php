@extends('panel.app')
@section('content')
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">

                    <form method="post" action="{{ route('module.update', $module->id) }}">
                        @csrf
                        <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Tên module:</label>

                            <input required type="text" id="name" class="form-control" value="{{ $module->name }}" name='name'
                                placeholder="Tên module" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="">Thời gian (phút):</label>
                            <div class="input-group my-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="timeInputGroupPrepend">
                                        <i class='bx bx-sm bxs-time'></i>
                                    </span>
                                </div>
                                <input required type="text" name="duration" value="{{ $module->duration }}"
                                    class="form-control @error('duration')  is-invalid @enderror" />
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary">Lưu và tiếp tục</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
