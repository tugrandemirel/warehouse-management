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

                    <form action="{{ route('admin.api.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">

                                    @for($i=1;$i<=6;$i++)
                                    <label for="" class="img-btn">
                                        <input type="radio" name="image" value="{{ $i }}">
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
                            <div class="col-md-12">
                                <div id="imageContainer">
                                    <!-- Resimler burada gösterilecek -->
                                </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('imageForm');
            var imageContainer = document.getElementById('imageContainer');

            form.addEventListener('change', function () {
                var selectedOption = document.querySelector('input[name="option"]:checked').value;
                hideAllImages();

                if (selectedOption === '1') {
                    let arr = [];
                    for (var i = 1; i<=21; i++ )
                    {
                        arr[i] = i+'.jpg'
                    }
                    showSelectableImages(arr);
                } else if (selectedOption === '2') {
                    showSelectableImages(['image3.jpg', '21.png', '5.png']);
                }
                // Diğer durumları buraya ekleyebilirsiniz
            });

            function hideAllImages() {
                imageContainer.innerHTML = '';
            }

            function showSelectableImages(images) {
                for (var i = 0; i < images.length; i++) {
                    var img = document.createElement('img');
                    img.src = '/public/images/store/' + images[i];
                    img.classList.add('img-fluid');
                    img.addEventListener('click', function () {
                        selectImage(this.src);
                    });
                    imageContainer.appendChild(img);
                }
            }

            function selectImage(path) {
                // Seçilen resmi işleme ekleme
                var selectedImage = document.querySelector('.selected-image');
                if (selectedImage) {
                    selectedImage.classList.remove('selected-image');
                }

                var img = document.querySelector('img[src="' + path + '"]');
                img.classList.add('selected-image');

                // Veritabanına kaydetme işlemi
                var imagePath = path.replace('/public/images/store/', '');

            }

        });
    </script>
@endsection
