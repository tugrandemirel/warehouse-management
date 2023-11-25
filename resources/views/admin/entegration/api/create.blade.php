@extends('admin.layouts.app')
@section('css')

    <link href="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    API EKLE
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.api.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">

                                    @for($i=1;$i<=8;$i++)
                                    <label for="" class="img-btn">
                                        <input type="radio" name="cargo_id" value="{{ $i }}">
                                        <img class="avatar-md" src="{{ asset('assets/admin/images/cargo/'.$i.'.png') }}" alt="">
                                    </label>
                                    @endfor
                                        @error('carog_id')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="lastNameinput" class="form-label">Shipping Account</label>
                                    <input type="text" class="form-control" name="shipping_account" value="{{ old('shipping_account') }}">
                                    @error('shipping_account')
                                 <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">API Key</label>
                                    <input type="text" class="form-control" name="key" value="{{ old('key') }}">
                                    @error('key')
                                  <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="lastNameinput" class="form-label">API Secret</label>
                                    <input type="text" class="form-control" name="secret" value="{{ old('secret') }}">
                                    @error('secret')
                                    <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
