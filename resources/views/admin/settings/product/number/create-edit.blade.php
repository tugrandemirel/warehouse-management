@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <x-admin.page-title :title="isset($number) ? 'Ayakkabı Numarası Düzenle' : 'Ayakkabı Numarası Ekle'"/>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     Ayakkabı Numarası {{ isset($number) ? 'Düzenle' : 'Ekle' }}
                </div>
                <div class="card-body">
                        <form action="{{ isset($number) ? route('admin.settings.product.number.update', ['number' => $number]) : route('admin.settings.product.number.store') }}" method="POST" id="numberForm">
                            @csrf
                            @isset($number)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Ayakkabı Numarası</label>
                                        <input type="text" class="form-control  @error('number') is-invalid @enderror"  name="number" value="{{ isset($number) ? $number->number : old('number') }}" id="number" placeholder="54">
                                        @error('number')
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
        let name = document.querySelector('input[name="number"]');
        name.addEventListener('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
    <script>
        let numberForm = document.getElementById('numberForm');
        let name = document.getElementById('number');
        let nameControl = false;
        name.addEventListener('keyup', function(){
            const length = name.value.length;
            if(length < 1){
                name.classList.add('is-invalid');
                name.classList.remove('is-valid');
            }
            else{
                name.classList.add('is-valid');
                name.classList.remove('is-invalid');
                nameControl = true
            }
        });
        numberForm.addEventListener('submit', function(e){
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
