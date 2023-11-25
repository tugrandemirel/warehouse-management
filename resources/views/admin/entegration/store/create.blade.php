@extends('admin.layouts.app')
@section('css')

    <link href="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    MAĞAZA EKLE
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.store.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">

                                    @for($i=1;$i<=6;$i++)
                                    <label for="" class="img-btn">
                                        <input type="radio" name="image" id="shop" value="{{ $i }}">
                                        <img class="avatar-md" src="{{ asset('assets/admin/images/store/'.$i.'.png') }}" alt="">
                                    </label>
                                    @endfor
                                        @error('carog_id')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12" id="amazon" style="display: none;">
                                @for($i=1;$i<=21;$i++)
                                    <label for="" class="img-btn">
                                        <input type="radio" name="country_id" value="{{ $i }}">
                                        <img class="avatar-md" src="{{ asset('assets/admin/images/country/'.$i.'.png') }}" alt="">
                                    </label>
                                @endfor
                            </div>
                            <div class="col-md-12" id="ebay" style="display: none;">
                                    <label for="" class="img-btn">
                                        <input type="radio" name="country_id" value="5">
                                        <img class="avatar-md" src="{{ asset('assets/admin/images/country/5.png') }}" alt="">
                                    </label>
                                    <label for="" class="img-btn">
                                        <input type="radio" name="country_id" value="21">
                                        <img class="avatar-md" src="{{ asset('assets/admin/images/country/21.png') }}" alt="">
                                    </label>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="lastNameinput" class="form-label">Mağaza Adı</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    @error('name')
                                 <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                    @error('sku')
                                  <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Aktiflik Durumu</label>
                                    <select name="is_active" class="form-select" id="">
                                        <option value="1">Aktif</option>
                                        <option value="0">Pasif</option>
                                    </select>
                                    @error('is_active')
                                      <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Link Now</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('input[name="image"]').on('change', function() {
            var value = $(this).val();
            if(value == 1){
                $('#amazon').show();
                $('#ebay').hide();
            }else if(value == 2){
                $('#amazon').hide();
                $('#ebay').show();
            }else{
                $('#amazon').hide();
                $('#ebay').hide();
            }
        });
    </script>
@endsection
