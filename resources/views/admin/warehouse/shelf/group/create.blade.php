@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Gruplar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ADMİN</a></li>
                        <li class="breadcrumb-item active">GRUPLAR</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     GRUP EKLE
                </div>
                <div class="card-body">
                        <form action="{{ route('admin.shelfGroup.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Grup Adı</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" placeholder="Grup Adı">
                                        @error('name')
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
        let warehouseStoreForm = document.getElementById('warehouseStoreForm');
        let name = document.getElementById('name');
        let description = document.getElementById('description');
        let is_active = document.getElementById('is_active');
        let code = document.getElementById('code');
        let nameControl = false;
        let descControl = false;
        let is_activeControl = false;
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

        warehouseStoreForm.addEventListener('submit', function(e){
            if(nameControl === false || descControl === false || is_activeControl === false || codeControl === false){
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
