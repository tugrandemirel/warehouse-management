@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="" autocomplete="off" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Ürün Başlığı</label>
                            <input type="text" class="form-control" name="title" value="{{old('title') }}" placeholder="Ürün Başlığı Giriniz" required>
                            <div class="invalid-feedback">Ürün Başlığı Giriniz</div>
                        </div>
                        <div>
                            <label>Ürün Açıklaması</label>

                                <textarea name="description" class="form-control" id="ckeditor-classic">{!! old('description') !!}</textarea>

                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ürün Resmi</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="text-muted">Ana Resim Ekleyiniz</p>
                            <div class="text-center">
                                <input class="form-control" name="image" value=""  type="file">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">
                                    Genel Bilgiler
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">
                                    Meta Bilgiler
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
                                            <label class="form-label" for="manufacturer-name-input">Üretici Adı</label>
                                            <input type="text" class="form-control" name="manufacturer_name" value="{{ old('manufacturer_name') }}" placeholder="Lütfen üretici adı giriniz">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-brand-input">Üretici Marka</label>
                                            <input type="text" class="form-control" name="manufacturer_brand" value="{{ old('manufacturer_brand') }}" placeholder="Lütfen üretici marka giriniz">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Fiyat</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">$</span>
                                                <input type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Fiyat Giriniz" aria-label="Price" aria-describedby="product-price-addon" required>
                                                <div class="invalid-feedback">Lütfen fiyat giriniz.</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Ürün Kodu</label>
                                            <input type="text" class="form-control" name="code" placeholder="Ürün Kodu" value="{{ old('code') }}" required>
                                            <div class="invalid-feedback">Lütfen ürün kodunu giriniz.</div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end tab-pane -->

                            <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-title-input">Meta Başlık</label>
                                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter meta title" >
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Anahtar Kelimeler</label>
                                            <input type="text" class="form-control" name="meta_keywords" placeholder="Lütfen meta Anahtar kelime giriniz">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Açıklama</label>
                                    <textarea class="form-control" name="meta_description" placeholder="Lütfen meta açıklama giriniz" rows="3"></textarea>
                                </div>
                            </div>
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Yayınlama</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Durum</label>

                            <select class="form-select" name="publish" data-choices data-choices-search-false>
                                <option value="Published" selected>Yayınla</option>
                                <option value="Scheduled">Yayınlama</option>
                            </select>
                        </div>

                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Görünürlük</label>
                            <select class="form-select" name="visibility" data-choices data-choices-search-false>
                                <option value="Public" selected>Herkese Açık</option>
                                <option value="Hidden">Gizli</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ürün Kısa Açıklaması</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Ürün Kısa açıklaması giriniz</p>
                        <textarea class="form-control" name="short_description" placeholder="Minimum 50 karakter giriniz." rows="3">{{ old('short_description') }}</textarea>
                    </div>
                    <!-- end card body -->
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
@endsection
