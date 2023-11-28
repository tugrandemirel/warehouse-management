@extends('admin.layouts.app')
@section('css')

    <link href="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

    <x-admin.page-title :title="'PARA BİRİMLERİ'"/>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="leadsList">
                <div class="card-header border-0">

                    <div class="row g-4 align-items-center">
                        <div class="col-sm-3">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Search for...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="hstack gap-2">
                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiples()"><i class="ri-delete-bin-2-line"></i></button>
{{--                                <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" href="#offcanvasExample"><i class="ri-filter-3-line align-bottom me-1"></i> Fliters</button>--}}
                                <a href="{{ route('admin.settings.product.number.create') }}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i> Numara Ekle</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card">
                            @if($numbers->count() > 0)
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                        </div>
                                    </th>
                                    <th class="sort" data-sort="name">Numara</th>
                                    <th class="sort" data-sort="date">Oluşturulma Tarihi</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($numbers as $number)
                                    <tr>
                                        <th scope="row" >
                                            <div class="form-check">
                                                <input class="form-check-input remove-action" type="checkbox" name="chk_child" value="{{ $number->id }}">
                                            </div>
                                        </th>
                                        <td class="name">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 ms-2 name">{{ $number->number }}</div>
                                            </div>
                                        </td>
                                        <td class="date">
                                            {{ $number->created_at->format('d M, Y') }}
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a class="edit-item-btn" href="{{ route('admin.settings.product.number.edit', ['number' => $number]) }}">
                                                        <i  class="ri-pencil-fill align-bottom text-muted"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                    <a class="remove-item-btn" data-id="{{ $number->id }}">
                                                        <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="noresult" >
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Üzgünüz! Sonuç Bulunamadı</h5>
                                    <p class="text-muted mb-0">Lütfen Depo ekleyiniz.</p>
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
                                        <h4 class="fs-semibold">Grubu silmek istediğinize emin misiniz?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Sildiğiniz gruba bağlı diğer verilerde silinecektir.</p>
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
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

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
                    let url = "{{ route('admin.settings.product.number.destroy', ['number' => 'id']) }}";
                    url  = url.replace('id', id);
                    $.ajax({
                        url: url,
                        type: "DELETE",
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
        $(document).ready(function () {
            $('.remove-action').click(function () {
                if ($(this).is(':checked')) {
                    $('#remove-actions').css('display', 'block');
                } else {
                    $('#remove-actions').css('display', 'none');
                }
            })
        })
    </script>

    <script>
        function deleteMultiples() {
            let allVals = [];
            $(".form-check-input:checked").each(function() {
                allVals.push($(this).attr('value'));
            });
            if(allVals.length <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hata!',
                    text: 'Lütfen en az bir tane seçiniz.',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                $('#deleteRecordModal').modal('show');
                $('#delete-record').click(function () {
                    let join_selected_values = allVals.join(",");
                    $.ajax({
                        url: "{{ route('admin.settings.product.number.deleteMultiple') }}",
                        type: 'DELETE',
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: join_selected_values
                        },
                        success: function(response) {
                            if (response.status === true) {
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
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                })
            }
        }
    </script>
@endsection
