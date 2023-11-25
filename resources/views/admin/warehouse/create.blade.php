@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Depolar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ADMİN</a></li>
                        <li class="breadcrumb-item active">DEPOLAR</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     DEPO EKLE
                </div>
                <div class="card-body">
                        <form action="{{ route('admin.warehouse.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Depo Adı</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Depo Adı" id="firstNameinput">
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div><!--end col-->

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Depo Yetkilisi</label>
                                        <select name="user_id[]" multiple id="" class="form-select">
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div><!--end col-->

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="compnayNameinput" class="form-label">Depo Açıklaması</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                    </div>

                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
        let nameControl = false;
        let descControl = false;
        name.addEventListener('keyup', function(){
            const length = name.value.length;
            if(length < 5){
                name.classList.add('is-invalid');
                name.classList.remove('is-valid');
            }
            else{
                name.classList.add('is-valid');
                name.classList.remove('is-invalid');
                nameControl = true
            }
        });
        description.addEventListener('keyup', function(){
            const length = description.value.length;
            if(length < 5){
                description.classList.add('is-invalid');
                description.classList.remove('is-valid');
            }
            else{
                description.classList.add('is-valid');
                description.classList.remove('is-invalid');
                descControl = true
            }
        });
    </script>
@endsection
