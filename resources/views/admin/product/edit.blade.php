@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')

    <x-admin.page-title :title="'Ürün Tanımlama Düzenle'"></x-admin.page-title>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Ürün Kodu</label>
                            <input type="text" class="form-control" name="option[product_code]" placeholder="Ürün Kodu" value="{{ $product->productOptions[0]->product_code }}" required>
                            @error('option.product_code')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Ürün Başlığı</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Ürün Başlığı Giriniz" required>
                            @error('name')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div>
                            <label>Ürün Açıklaması</label>
                            <textarea name="option[description]" class="form-control" id="ckeditor-classic">{!! $product->productOptions[0]->description !!}</textarea>
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
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#product-general-info" role="tab">
                                    Ürün Ölçü Bilgiler
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
                                            <input type="text" class="form-control" name="option[manufacturer_name]" value="{{ $product->productOptions[0]->manufacturer_name }}" placeholder="Lütfen üretici adı giriniz">
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
                                            <input type="text" class="form-control" name="option[manufacturer_brand]" value="{{ $product->productOptions[0]->manufacturer_brand }}" placeholder="Lütfen üretici marka giriniz">
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
                                            <div class="input-group  mb-3">
                                                <input type="hidden" class="form-control" name="option[currency_id]" value="{{  $product->productOptions[0]->currency_id  }}" required>
                                                <input type="text" class="form-control is-numeric" name="option[price]" value="{{ $product->productOptions[0]->price }}" placeholder="Fiyat" aria-label="Price" aria-describedby="product-price-addon" required>
                                                <span class="input-group-text">{{ $currency->symbol }}</span>
                                                <input type="number" class="form-control is-numeric" name="option[vat]" value="{{ $product->productOptions[0]->vat }}" placeholder="KDV Oranı" aria-label="vat" aria-describedby="product-price-addon" required>
                                                <span class="input-group-text ml-3">%</span>
                                                @error('option.vat')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
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
                                            <input type="color" class="form-control form-control-color w-100" name="option[color]" placeholder="Ürün Rengi" value="{{ $product->productOptions[0]->color }}" required>
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
                                                    <option value="{{ $number->id }}" @if($number->id == $product->productOptions[0]->number_id) selected @endif>{{ $number->number }}</option>
                                                @endforeach
                                            </select>
                                            @error('option.number_id')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end tab-pane -->
                            <div class="tab-pane" id="product-general-info" role="tabpanel">
                                <div class="row">

                                    <div class="col-lg-2 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Ağırlığı</label>
                                            <input type="text" class="form-control is-numeric" name="option[weight]" placeholder="Ürün Ağırlığı" value="{{ $product->productOptions[0]->weight }}" required>
                                            @error('option.weight')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4">
                                        <div class="mb-3">
                                            <label for="form-label">Ölçü Birimi Seçiniz</label>
                                            <select name="option[measurement_unit_id]" id="" class="form-select">
                                                @foreach($measurementUnits as $measurementUnit)
                                                    <option value="{{ $measurementUnit->id }}"
                                                            @if($measurementUnit->id == $product->productOptions[0]->measurement_unit_id) selected @endif
                                                    >{{ $measurementUnit->symbol }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-group  mb-3">
                                            <input type="text" class="form-control is-numeric" name="option[width]" value="{{ $product->productOptions[0]->width }}" placeholder="Ürün Genişliği" aria-label="width" aria-describedby="product-width-addon" required>
                                            <span class="input-group-text">x</span>
                                            <input type="text" class="form-control is-numeric" name="option[height]" value="{{ $product->productOptions[0]->height }}" placeholder="Ürün Yüksekliği" aria-label="height" aria-describedby="product-height-addon" required>
                                            <span class="input-group-text">x</span>
                                            <input type="text" class="form-control is-numeric" name="option[length]" value="{{ $product->productOptions[0]->length }}" placeholder="Ürün Uzunluğu" aria-label="length" aria-describedby="product-height-addon" required>

                                            @error('option.width')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                            @error('option.height')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
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
                        <textarea class="form-control" name="option[short_description]" placeholder="Minimum 50 karakter giriniz." rows="3">{{ $product->productOptions[0]->short_description }}</textarea>
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
                        <div class="mb-4">
                            <div class="text-center">
                                <img src="{{ asset($product->main_image)  }}" alt="No Data" width="50px" height="50px">
                            </div>
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
                            <label for="choices-publish-status-input" class="form-label">Pazar Yeri Seçiniz</label>
                            <select class="form-select" id="marketPlace">
                                <option value="0">Seçiniz</option>
                                @foreach($marketPlaces as $marketPlace)
                                    <option value="{{ $marketPlace->id }}">
                                        {{ $marketPlace->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 marketPlaces">
                            @foreach($product->productOptions[0]->productMarketPlaces as $mP)
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="" class="form-label">{{ $mP->marketPlace->name }}</label>
                                        <input type="text" class="form-control" name="option[market_place][{{ $mP->marketPlace->id }}][code]" value="{{ $mP->stock_code }}" placeholder="Amazon Kodu Giriniz" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger" style="margin-top: 27px" onclick="$(this).parent().parent().remove()">Kaldır</button>
                                </div>
                            </div>
                            @endforeach
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
                                <option value="{{ \App\Enum\Product\ProductOption\ProductOptionIsActiveEnum::ACTIVE }}" {{ \App\Enum\Product\ProductOption\ProductOptionIsActiveEnum::ACTIVE == $product->productOptions[0]->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="{{ \App\Enum\Product\ProductOption\ProductOptionIsActiveEnum::PASSIVE }}" {{ \App\Enum\Product\ProductOption\ProductOptionIsActiveEnum::PASSIVE == $product->productOptions[0]->is_active ? 'selected' : '' }}>Pasif</option>
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
    <script>
        $(document).ready(function () {
            $('#marketPlace').on('change', function () {
                var marketPlaceId = $(this).val();
                var marketPlaceName = $(this).find('option:selected').text();
                let newInput = '<div class="row">' +
                    '<div class="col-lg-8">' +
                        '<div class="mb-3">' +
                            '<label class="form-label" for="product-title-input">'+marketPlaceName+' Kodu</label>' +
                            '<input type="text" class="form-control" name="option[market_place]['+marketPlaceId+'][code]" value="" placeholder="'+marketPlaceName+' Kodu Giriniz" required>' +
                        '</div>' +
                    '</div>'+
                    '<div class="col-lg-4">' +
                        '<div class="mb-3">' +
                            '<button type="button" class="btn btn-danger" style="margin-top: 27px" onclick="$(this).parent().parent().parent().remove()">Kaldır</button>'
                        '</div>' +
                    '</div>' +
                '</div>';
                $('.marketPlaces').append(newInput)
            });
        })
    </script>
@endsection
