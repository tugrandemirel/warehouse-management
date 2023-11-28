@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <x-admin.page-title :title="isset($currency) ? 'Para BİRİMİ Düzenle' : 'Para BİRİMİ Ekle'"/>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     Para Birimi {{ isset($currency) ? 'Düzenle' : 'Ekle' }}
                </div>
                <div class="card-body">
                        <form action="{{ isset($currency) ? route('admin.settings.product.currency.update', ['currency' => $currency]) : route('admin.settings.product.currency.store') }}" method="POST" id="currenyForm">
                            @csrf
                            @isset($currency)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Para Birimi Adı</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ isset($currency) ? $currency->name : old('name') }}" id="name" placeholder="Dolar">
                                        @error('name')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Para Birimi Kodu</label>
                                        <input type="text" class="form-control  @error('symbol') is-invalid @enderror" name="symbol" value="{{ isset($currency) ? $currency->symbol : old('symbol') }}" id="symbol" placeholder="$">
                                        @error('symbol')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">
                                            Varsayılan Para Birimi
                                        </label>
                                        <select name="is_default" class="form-select" id="">
                                            <option value="{{ \App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum::FALSE }}"
                                            {{ isset($currency) && $currency->is_default == \App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum::FALSE ? 'selected' :'' }}
                                            >Hayır</option>
                                            <option value="{{ \App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum::TRUE }}"
                                            {{ isset($currency) && $currency->is_default == \App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum::TRUE ? 'selected' :'' }}
                                            >Evet</option>
                                        </select>

                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Kaydet</button>
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
        let currenyForm = document.getElementById('currenyForm');
        let name = document.getElementById('name');
        let nameControl = false;
        name.addEventListener('keyup', function(){
            const length = name.value.length;
            if(length < 2){
                name.classList.add('is-invalid');
                name.classList.remove('is-valid');
            }
            else{
                name.classList.add('is-valid');
                name.classList.remove('is-invalid');
                nameControl = true
            }
        });
        currenyForm.addEventListener('submit', function(e){
            if(nameControl === false ){
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lütfen gerekli alanları doldurunuz!',
                })
            }
        });
    </script>
@endsection
