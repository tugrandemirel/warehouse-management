@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Varyant Grupları</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ADMİN</a></li>
                        <li class="breadcrumb-item active">VARYANT GRUPLARI</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     VARYANT GRUP {{ isset($variantGroup) ? 'GÜNCELLE' : 'EKLE' }}
                </div>
                <div class="card-body">
                        <form action="{{ isset($variantGroup) ? route('admin.product.variant.group.update', ['variantGroup' => $variantGroup]) : route('admin.product.variant.group.store') }}" id="group" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Grup Adı</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ isset($variantGroup) ? $variantGroup->name : old('name') }}" id="name" placeholder="Grup Adı">
                                        @error('name')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>

                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">{{ isset($variantGroup) ? 'Güncelle' : 'Kaydet' }}</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            let nameControl = false;

            let group = document.getElementById('group');
            let name = document.getElementById('name');
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

            group.addEventListener('submit', function(e){
                if(nameControl == false ){
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Lütfen formu eksiksiz doldurunuz!',
                    })
                }
            });
        });
    </script>
@endsection
