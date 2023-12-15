@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')

    <x-admin.page-title :title="'Ürün Tanımlama'"></x-admin.page-title>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fatura Kodu</label>
                                    <input type="text" class="form-control" name="data[invoice_number]" placeholder="Ürün Kodu" value="" required>
                                    @error('option.product_code')
                                    <div class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fatura Tarihi</label>
                                    <input type="date" class="form-control" name="data[invoice_number]" placeholder="Ürün Kodu" value="" required>
                                    @error('option.product_code')
                                    <div class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Ürün Kodu</th>
                                        <th>Ürün Adı</th>
                                        <th>Ürün Adet</th>
                                        <th>Ürün Fiyat</th>
                                        <th>Ürün KDV</th>
                                        <th>Ürün Toplam</th>
                                    </tr>
                                    </thead>
                                    <tbody class="marketPlaces">
                                    <tr id="addProductTable">
                                        <td>
                                            <select name="option[market_place][1][market_place_id]" id="marketPlace" class="form-select">
                                                <option value="">Pazaryeri Seçiniz</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->productOptionsIsActive[0]->id }}">{{ $product->productOptionsIsActive[0]->product_code }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="option[market_place][1][product_name]" placeholder="Ürün Kodu" value="" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control is-numeric" name="option[market_place][1][product_quantity]" placeholder="Ürün Kodu" value="" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control is-numeric" name="option[market_place][1][product_price]" placeholder="Ürün Kodu" value="" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control is-numeric" name="option[market_place][1][product_kdv]" placeholder="Ürün Kodu" value="" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control is-numeric" name="option[market_place][1][product_total]" placeholder="Ürün Kodu" value="" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success addProductTable">Ekle</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Kaydet</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Mağaza Seçimi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Mağaza Seçiniz</p>
                        @if($stores->count() > 0)
                        <select name="company_id" class="form-select" id="">
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                        @else
                        <p class="text-danger">Mağaza Bulunamadı.
                            <a href="{{ route('admin.store.create') }}">Yeni Mağaza Oluştur</a>
                        </p>
                        @endif
                        @error('option.short_description')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Firma Seçimi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Firma Seçiniz</p>
                        @if($companies->count() > 0)
                        <select name="company_id" class="form-select" id="">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @else
                            <p class="text-danger">Firma Bulunamadı.
                                <a href="{{ route('admin.company.create') }}">Yeni Firma Oluştur</a>
                            </p>
                        @endif
                        @error('option.short_description')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Para Birimi Seçimi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Para Birimi Seçiniz</p>
                        @if($currencies->count() > 0)
                        <select name="currency_id" class="form-select" id="">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                            @endforeach
                        </select>
                        @else
                            <p class="text-danger">Para Birimi Bulunamadı.
                                <a href="{{ route('admin.settings.product.currency.create') }}">Yeni Para Birimi Oluştur</a>
                            </p>
                        @endif
                        @error('option.short_description')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- end col -->
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
            var i = 1;
            $('.addProductTable').click(function () {
                i++;
                var html = '<tr id="addProductTable'+i+'">';
                html += '<td><select name="option[market_place]['+i+'][market_place_id]" id="marketPlace" class="form-select"><option value="">Pazaryeri Seçiniz</option>@foreach($products as $product)<option value="{{ $product->productOptionsIsActive[0]->id }}">{{ $product->productOptionsIsActive[0]->product_code }}</option>@endforeach</select></td>';
                html += '<td><input type="text" class="form-control" name="option[market_place]['+i+'][product_name]" placeholder="Ürün Kodu" value="" required></td>';
                html += '<td><input type="text" class="form-control is-numeric" name="option[market_place]['+i+'][product_quantity]" placeholder="Ürün Kodu" value="" required></td>';
                html += '<td><input type="text" class="form-control is-numeric" name="option[market_place]['+i+'][product_price]" placeholder="Ürün Kodu" value="" required></td>';
                html += '<td><input type="text" class="form-control is-numeric" name="option[market_place]['+i+'][product_kdv]" placeholder="Ürün Kodu" value="" required></td>';
                html += '<td><input type="text" class="form-control is-numeric" name="option[market_place]['+i+'][product_total]" placeholder="Ürün Kodu" value="" required></td>';
                html += '<td><button type="button" class="btn btn-danger removeProductTable" data-id="'+i+'" >Sil</button></td>';
                html += '</tr>';
                $('.marketPlaces').append(html);
            });
            $(document).on('click', '.removeProductTable', function(){
                var id = $(this).data('id');
                $('#addProductTable'+id+'').remove();
            });
        })
    </script>
@endsection
