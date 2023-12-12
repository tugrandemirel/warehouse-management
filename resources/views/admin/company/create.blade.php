@extends('admin.layouts.app')
@section('css')
<meta name="getState" content="{{ route('admin.ajax.get.state') }}">
@endsection
@section('content')

    <x-admin.page-title :title="'Firma Tanımlama'"></x-admin.page-title>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.company.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Firma Adı</label>
                                <input type="text" class="form-control" name="name" placeholder="Firma Adı" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Firma Unvanı</label>
                            <input type="text" class="form-control" name="degree" value="{{old('degree') }}" placeholder="Firma Unvanı Giriniz">
                            @error('degree')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Firma Açıklaması</label>
                            <textarea name="description" class="form-control" id="ckeditor-classic">{!! old('description') !!}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                            Adres Bilgileri
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row justify-content-between">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Ülke</label>
                                                    <select name="country_id" class="form-select" id="changeCountry">
                                                        <option value="0">Seçiniz</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country_id')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 states">

                                                </div>
                                            </div>
                                            <div class="col-lg-2 postCode">
                                                <div class="mb-3">
                                                    <label class="form-label">Posta Kodu</label>
                                                    <input type="text" class="form-control" name="post_code" value="{{ old('post_code') }}">
                                                    @error('post_code')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Açık Adres</label>
                                                    <textarea name="address" class="form-control" id="" cols="30" rows="3">{{ old('address') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="choices-publish-status-input" class="form-label">Durum</label>

                                                    <select class="form-select" name="is_active">
                                                        <option value="{{ \App\Enum\Company\CompanyIsActiveEnum::ACTIVE }}" selected>Aktif</option>
                                                        <option value="{{ \App\Enum\Company\CompanyIsActiveEnum::PASSIVE }}">Pasif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- end tab-pane -->
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>

                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Kaydet</button>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Firma Logosu</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="text-muted">Logo Ekleyiniz</p>
                            <div class="text-center">
                                <input class="form-control" name="logo" value=""  type="file">
                            </div>
                            @error('option.image')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Firma Bilgileri</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="text-muted">Firma Vergi Dairesi</p>
                            <div class="text-center">
                                <input class="form-control" name="tax_administration" value="{{ old('tax_administration') }}"  type="text">
                            </div>
                            @error('tax_administration')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="text-muted">Firma Vergi Numarası</p>
                            <div class="text-center">
                                <input class="form-control" name="tax_number" value="{{ old('tax_number') }}"  type="text">
                            </div>
                            @error('tax_number')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="text-muted">Firma Oda Sicil No</p>
                            <div class="text-center">
                                <input class="form-control" name="room_registration_number" value="{{ old('room_registration_number') }}"  type="text">
                            </div>
                            @error('room_registration_number')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="text-muted">Firma Web Sitesi</p>
                            <div class="text-center">
                                <input class="form-control" name="website" value="{{ old('website') }}"  type="text">
                            </div>
                            @error('website')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Firma İletişim Bilgileri</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="text-muted">Telefon Numarası</p>
                            <div class="text-center">
                                <input class="form-control is-numeric" name="phone" value="{{ old('phone') }}"  type="text">
                            </div>
                            @error('phone')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="text-muted">Firma E-Posta Adresi</p>
                            <div class="text-center">
                                <input class="form-control" name="email" value="{{ old('email') }}"  type="email">
                            </div>
                            @error('email')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
@endsection
@section('js')
    <!-- ckeditor -->
    <script src="{{ asset('assets/admin/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    <script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/ecommerce-product-create.init.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.is-numeric').on('keypress', function (event) {
                var regex = new RegExp("^[0-9.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#changeCountry').change(function () {
                var countryID = $(this).val();
                var url = $('meta[name="getState"]').attr('content');
                if (countryID) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            country: countryID
                        },
                        success: function (res) {
                            if (res) {
                                $(".states").empty();
                                $("#form-label").remove()
                                $(".states").append('<label class="form-label" id="form-label">Şehir</label>');
                                $(".states").append('<select name="state_id" class="form-select" id="changeState"><option value="0">Seçiniz</option></select>');
                                $.each(res.data, function (key, value) {
                                    $("#changeState").append('<option value="' + value.id + '">' + value.name + '</option>');
                                });

                            } else {
                                $("#changeState").empty();
                            }
                        },
                        error: function (res) {
                            $("#changeState").remove()
                            $("#form-label").remove()

                            alert("hata")
                        }
                    });
                } else {
                    $("#changeState").empty();
                }
            });
        })
    </script>
@endsection
