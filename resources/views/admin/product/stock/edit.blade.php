@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')

    <x-admin.page-title :title="'Ürün Tanımlama Düzenleme'"></x-admin.page-title>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.product.stock.update', ['stock' => $stock]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fatura Kodu</label>
                                    <input type="text" class="form-control" name="data[invoice_number]" placeholder="Ürün Kodu" value="{{ $stock->invoice_number }}" required>
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
                                    <input type="date" class="form-control" name="data[invoice_date]" placeholder="Ürün Kodu" value="{{ $stock->invoice_date->format('Y-m-d') }}" required>
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
                                        <th>Ürün Adet</th>
                                        <th>Ürün Fiyat</th>
                                        <th>Ürün KDV</th>
                                        <th>Ürün Toplam</th>
                                        <th>Ürün Açıklama</th>
                                    </tr>
                                    </thead>
                                    <tbody class="marketPlaces">
                                     @php($i = 1)
                                     @foreach($stock->productStocks as $key => $productStock)
                                        <tr id="addProductTable{{ $i }}">
                                            <td>
                                                <select name="option[productStock][{{ $i }}][product_id]" id="marketPlace" class="form-select">
                                                    <option value="">Ürün Seçiniz</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->productOptionsIsActive[0]->id }}"
                                                                @if($productStock->product_id == $product->productOptionsIsActive[0]->id) selected @endif
                                                        >{{ $product->productOptionsIsActive[0]->product_code }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="input-group">
                                                <input type="number" class="form-control quantity" name="option[productStock][{{ $i }}][quantity]" value="{{ $productStock->quantity }}" min="0">
                                                <div class="input-group-append">
                                                    <select name="option[productStock][{{ $i }}][measurement_unit_id]" id="" class="form-select">
                                                        <option value="">Seçiniz</option>
                                                        @foreach($measurementUnits as $measurementUnit)
                                                            <option value="{{ $measurementUnit->id }}"
                                                                    @if($productStock->measurement_unit_id == $measurementUnit->id) selected @endif
                                                            >{{ $measurementUnit->symbol }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control is-numeric price" name="option[productStock][{{ $i }}][price]" value="{{ $productStock->price }}"
                                                       placeholder="Ürün Birim Fiyat">

                                            </td>
                                            <td>
                                                <input type="number" class="form-control is-numeric vat" name="option[productStock][{{ $i }}][vat]" placeholder="Ürün KDV" value="{{ $productStock->vat }}" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control is-numeric total" name="option[productStock][{{ $i }}][product_total]" placeholder="Ürün Toplam" value="{{ $productStock->product_total }}" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="option[productStock][1][description]" placeholder="Ürün Açıklama" value="{{ $productStock->description }}" required>
                                            </td>
                                            <td>
                                                @if( $i === 1 )
                                                <button type="button" class="btn btn-success addProductTable">Ekle</button>
                                                @else
                                                    <button type="button" class="btn btn-danger removeProductTable" data-id="{{ $i }}" >Sil</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @php($i++)
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                Toplam Fiyat: <span class="text-danger">0</span>
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
                        <select name="data[store_id]" class="form-select" id="">
                            <option value="">Seçiniz</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}"
                                    @if($store->id === $stock->store_id) selected @endif
                                >{{ $store->name }}</option>
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
                        <select name="data[company_id]" class="form-select" id="">
                            <option value="">Seçiniz</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                    @if($company->id === $stock->company_id) selected @endif
                                >{{ $company->name }}</option>
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
                        <select name="data[currency_id]" class="form-select" id="">
                            <option value="">Seçiniz</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}"
                                    @if($currency->id === $stock->currency_id) selected @endif
                                >{{ $currency->name }}</option>
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
            var i = {{ $i - 1 }};
            $('.addProductTable').click(function () {
                i++;
                var html = '<tr id="addProductTable'+i+'">';

                html += '<td><select name="option[productStock]['+i+'][product_id]" id="marketPlace" class="form-select"><option value="">Ürün Seçiniz</option>@foreach($products as $product)<option value="{{ $product->productOptionsIsActive[0]->id }}">{{ $product->productOptionsIsActive[0]->product_code }}</option>@endforeach</select></td>';
                html += '<td class="input-group"><input type="number" class="form-control quantity" name="option[productStock]['+i+'][quantity]" value="0" min="0"><div class="input-group-append"><select name="option[productStock]['+i+'][measurement_unit_id]" id="" class="form-select"><option value="">Seçiniz</option>@foreach($measurementUnits as $measurementUnit)<option value="{{ $measurementUnit->id }}" @if($measurementUnit->is_default === \App\Enum\Settings\Product\MeasurementUnit\MeasurementUnitIsDefaultEnum::TRUE) selected @endif>{{ $measurementUnit->symbol }}</option>@endforeach</select></div></td>';
                html += '<td><input type="number" class="form-control is-numeric price" name="option[productStock]['+i+'][price]" placeholder="Ürün Birim Fiyat" required></td>';
                html += '<td><input type="number" class="form-control is-numeric vat" name="option[productStock]['+i+'][vat]" placeholder="Ürün KDV" required></td>';
                html += '<td><input type="number" class="form-control is-numeric total" name="option[productStock]['+i+'][product_total]" placeholder="Ürün Toplam" required></td>';
                html += '<td><input type="text" class="form-control" name="option[productStock]['+i+'][description]" placeholder="Ürün Açıklama" required></td>';
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
    <script>
        $(document).ready(function () {
            $('.quantity').on('keyup', function () {
                var quantity = $(this).val();
                var price = $(this).closest('tr').find('.price').val();
                if(quantity === ''){
                    quantity = 0;
                }
                if (price === ''){
                    price = 0;
                }
                var vat = $(this).closest('tr').find('.vat').val();
                var total = quantity * price;
                var totalVat = total * vat / 100;
                var totalAmount = total + totalVat;
                $(this).closest('tr').find('.total').val(totalAmount);
            });
            $('.price').on('keyup', function () {
                var price = $(this).val();
                var quantity = $(this).closest('tr').find('.quantity').val();
                var vat = $(this).closest('tr').find('.vat').val();
                if(quantity === ''){
                    quantity = 0;
                }
                if (vat === ''){
                    vat = 0;
                }
                var total = quantity * price;
                var totalVat = total * vat / 100;
                var totalAmount = total + totalVat;
                $(this).closest('tr').find('.total').val(totalAmount);
            });
            $('.vat').on('keyup', function () {
                var vat = $(this).val();
                var price = $(this).closest('tr').find('.price').val();
                var quantity = $(this).closest('tr').find('.quantity').val();
                if(quantity === ''){
                    quantity = 0;
                }
                if (price === ''){
                    price = 0;
                }
                var total = quantity * price;
                var totalVat = total * vat / 100;
                var totalAmount = total + totalVat;
                $(this).closest('tr').find('.total').val(totalAmount);
            });
        });
    </script>
@endsection
