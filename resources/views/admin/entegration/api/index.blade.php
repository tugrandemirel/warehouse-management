@extends('admin.layouts.app')
@section('css')

    <link href="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">API</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ADMİN</a></li>
                        <li class="breadcrumb-item active">API</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="apiKeyList">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">API Keys</h5>
                    <div class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        <a href="{{ route('admin.api.create') }}" class="btn btn-success create-btn"><i class="ri-add-line align-bottom me-1"></i> API Ekle</a>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            @if($apis->count() > 0)
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="sort d-none" data-sort="id" scope="col">Id</th>
                                    <th class="sort" data-sort="image" scope="col">Resim</th>
                                    <th class="sort" data-sort="image" scope="col">Oluşturan Kullanıcı</th>
                                    <th class="sort" data-sort="shipping_account" scope="col">Shipping Account</th>
                                    <th class="sort" data-sort="apikey" scope="col">API Key</th>
                                    <th class="sort" data-sort="apisecret" scope="col">API Secret</th>
                                    <th class="sort" data-sort="create_date" scope="col">Oluşturulma Tarihi</th>
                                    <th scope="col">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($apis as $key => $value)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </th>
                                        <td class="image" >
                                                <img src="{{ asset('assets/admin/images/cargo/'.($key + 1).'.png') }}" alt="" class="avatar-sm">
                                        </td>
                                        <td class="name">{{ $value->user->name }}</td>
                                        <td class="createBy">{{ $value->shipping_account }}</td>
                                        <td class="apikey">
                                            <input type="text" class="form-control apikey-value" readonly value="{{ $value->key }}">
                                        </td>
                                        <td class="apisecret">
                                            <input type="text" class="form-control apikey-value" readonly value="{{ $value->secret }}">
                                        </td>
                                        <td class="create_date">
                                            {{ $value->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item disable-btn" href="{{ route('admin.api.edit', ['api' => $value]) }}">Düzenle</a></li>
                                                    <li><a class="dropdown-item remove-item-btn" data-id="{{ $value->id }}" data-bs-toggle="modal" href="#deleteApiKeyModal">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="noresult">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Üzgünüz! Sonuç Bulunamadı</h5>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body p-5 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                    <div class="mt-4 text-center">
                        <h4 class="fs-semibold">API'yi silmek istediğinize emin misiniz?</h4>
                        <p class="text-muted fs-14 mb-4 pt-1">Sildiğiniz API'ye bağlı diğer verilerde silinecektir.</p>
                        <div class="hstack gap-2 justify-content-center remove">

                            <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Silme</button>
                            <button class="btn btn-danger" id="delete-record">Evet, Eminim!!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->


@endsection

@section('js')
    <script src="{{ asset('assets/admin/libs/list.js/list.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/crm-leads.init.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.remove-item-btn').click(function () {
                let id = $(this).data('id');
                $('#deleteRecordModal').modal('show');
                $('#delete-record').click(function () {
                    let url = "{{ route('admin.api.destroy', ['api' => 'id']) }}";
                    url  = url.replace('id', id);
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status === true) {
                                $('#deleteRecordModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Başarılı!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Hata!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        },
                    })
                })
            })
        })
    </script>
@endsection
