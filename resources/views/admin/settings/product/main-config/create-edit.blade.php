@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <x-admin.page-title :title="isset($mainConfig) ? 'STOK KODU BAŞLANGICI DÜZENLE' : 'STOK KODU BAŞLANGICI EKLE'"/>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     Stok Kodu Başlangıcı {{ isset($mainConfig) ? 'Düzenle' : 'Ekle' }}
                </div>
                <div class="card-body">
                        <form action="{{ isset($mainConfig) ? route('admin.settings.product.mainConfig.update', ['mainConfig' => $mainConfig]) : route('admin.settings.product.mainConfig.store') }}" method="POST" id="mainConfig">
                            @csrf
                            @isset($mainConfig)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Stok Kodu Başlangıcı</label>
                                        <input type="text" class="form-control  @error('stock_prefix') is-invalid @enderror" name="stock_prefix" value="{{ isset($mainConfig) ? $mainConfig->stock_prefix : old('stock_prefix') }}" id="name" placeholder="TD2023">
                                        @error('stock_prefix')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
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
        let mainConfig = document.getElementById('mainConfig');
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
        mainConfig.addEventListener('submit', function(e){
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
