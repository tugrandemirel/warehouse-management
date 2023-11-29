@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')

    <x-admin.page-title :title="'Ürün Ekle'"></x-admin.page-title>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Ürün Başlığı</label>
                            <input type="text" class="form-control" name="name" value="{{old('name') }}" placeholder="Ürün Başlığı Giriniz" required>
                            @error('name')
                                <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                            @enderror
                        </div>
                        <div>
                            <label>Ürün Açıklaması</label>
                                <textarea name="option[description]" class="form-control" id="ckeditor-classic">{!! old('option.description') !!}</textarea>
                            @error('option.description')
                                <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                    Genel Bilgiler
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Üretici Adı</label>
                                            <input type="text" class="form-control" name="option[manufacturer_name]" value="{{ old('option.manufacturer_name') }}" placeholder="Lütfen üretici adı giriniz">
                                            @error('option[manufacturer_name]')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Üretici Marka</label>
                                            <input type="text" class="form-control" name="option[manufacturer_brand]" value="{{ old('option.manufacturer_brand') }}" placeholder="Lütfen üretici marka giriniz">
                                            @error('option.manufacturer_brand')
                                                <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label" >Fiyat</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text">{{ $currency->symbol }}</span>
                                                <input type="text" class="form-control" name="option[price]" value="{{ old('option.price') }}" placeholder="Fiyat Giriniz" aria-label="Price" aria-describedby="product-price-addon" required>
                                                @error('option.price')
                                                <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Rengi</label>
                                            <input type="color" class="form-control" name="option[color]" placeholder="Ürün Kodu" value="{{ old('option.color') }}" required>
                                            @error('option.color')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Numarası</label>
                                            <select name="option[number_id]" class="form-select" id="">
                                                @foreach($numbers as $number)
                                                    <option value="{{ $number->id }}" @if(old('option.number_id') == $number->id) selected @endif>{{ $number->number }}</option>
                                                @endforeach
                                            </select>
                                            @error('option.number_id')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Kodu</label>
                                            <input type="text" class="form-control" name="option[code]" placeholder="Ürün Kodu" value="{{ old('option.code') }}" required>
                                            @error('option.code')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Ağırlığı</label>
                                            <input type="text" class="form-control is-numeric" name="option[weight]" placeholder="Ürün Ağırlığı" value="{{ old('option.weight') }}" required>
                                            @error('option.weight')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Genişliği</label>
                                            <input type="text" class="form-control is-numeric" name="option[width]" placeholder="Ürün Genişliği" value="{{ old('option.width') }}" required>
                                            @error('option.width')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Yüksekliği</label>
                                            <input type="text" class="form-control is-numeric" name="option[height]" placeholder="Ürün Yüksekliği" value="{{ old('option.height') }}" required>
                                            @error('option.height')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Uzunluğu</label>
                                            <input type="text" class="form-control is-numeric" name="option[length]" placeholder="Ürün Uzunluğu" value="{{ old('option.length') }}" required>
                                            @error('option.length')
                                            <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
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
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Kaydet</button>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <!-- end card -->

                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ürün Kısa Açıklaması</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Ürün Kısa açıklaması giriniz</p>
                        <textarea class="form-control" name="option[short_description]" placeholder="Minimum 50 karakter giriniz." rows="3">{{ old('option.short_description') }}</textarea>
                        @error('option.short_description')
                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                        @enderror
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ürün Resmi</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="text-muted">Ana Resim Ekleyiniz</p>
                            <div class="text-center">
                                <input class="form-control" name="option[image]" value=""  type="file">

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
                        <h5 class="card-title mb-0">Pazar Yeri Kodu</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Durum</label>
                                <select class="form-select" name="option[is_active]">
                                    @foreach($marketPlaces as $marketPlace)
                                    <option value="{{ $marketPlace->id }}">
                                        {{ $marketPlace->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Yayınlama</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Durum</label>

                            <select class="form-select" name="option[is_active]">
                                <option value="{{ \App\Enum\Product\ProductOption\ProductOptionIsActiveEnum::ACTIVE }}" selected>Aktif</option>
                                <option value="{{ \App\Enum\Product\ProductOption\ProductOptionIsActiveEnum::PASSIVE }}">Pasif</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->

                </div>
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
@endsection
