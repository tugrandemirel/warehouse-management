@extends('admin.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Raflar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ADMİN</a></li>
                        <li class="breadcrumb-item active">RAFLAR</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                     RAF EKLE
                </div>
                <div class="card-body">
                        <form action="{{ route('admin.warehouseShelf.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Raf Adı</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" placeholder="Raf Adı">
                                        @error('name')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>

                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Raf Kodu</label>
                                        <input type="text" class="form-control  @error('code') is-invalid @enderror" name="code" id="code" placeholder="Raf Kodu" >
                                        @error('code')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Raf Aktifliği</label>
                                        <select name="is_active" id="is_active" class="form-select  @error('is_active') is-invalid @enderror">
                                            <option value="">SEÇİNİZ</option>
                                            <option value="1">AKTİF</option>
                                            <option value="0">PASİF</option>
                                        </select>
                                        @error('is_active')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Depo</label>
                                        <select name="warehouse_id" id="" class="form-select  @error('warehouse_id') is-invalid @enderror">
                                            @foreach($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('warehouse_id')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="compnayNameinput" class="form-label">Raf Açıklaması</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"></textarea>
                                        @error('description')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>

                                </div><!--end col-->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="firstNameinput" class="form-label">Grup Olacak mı?
                                            <input type="checkbox" id="shelfGroupControl" name="group" class="" ></label>
                                        </div>

                                        <div class="col-md-6" id="shelf_group_id" style="visibility: hidden">
                                            <label for="firstNameinput" class="form-label">Gruplar?</label>
                                            <select name="shelf_group_id" id="" class="form-select">
                                                @foreach($shelfGroups as $shelfGroup)
                                                    <option value="{{ $shelfGroup->id }}">{{ $shelfGroup->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
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
        let shelfGroupControl = document.getElementById('shelfGroupControl');
        let groupId = document.getElementById('shelf_group_id');
        shelfGroupControl.addEventListener('change', function () {
            if(shelfGroupControl.checked){
                groupId.style.visibility = 'visible';
            }
            else{
                groupId.style.visibility = 'hidden';
            }
        })
    </script>
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
        is_active.addEventListener('change', function(){
            if(is_active.value === ''){
                is_active.classList.add('is-invalid');
                is_active.classList.remove('is-valid');
            }
            else{
                is_active.classList.add('is-valid');
                is_active.classList.remove('is-invalid');
                is_activeControl = true
            }
        });
        code.addEventListener('keyup', function(){
            const length = code.value.length;
            if(length < 5){
                code.classList.add('is-invalid');
                code.classList.remove('is-valid');
            }
            else{
                code.classList.add('is-valid');
                code.classList.remove('is-invalid');
                codeControl = true
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
