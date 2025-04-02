@extends('layout.layout')
@php
$title='Riwayat Penjualan';
$subTitle = 'Laporan Penjualan';
$script = '<script>
    let table = new DataTable("#dataTable");

</script>';
@endphp

@section('content')

<div class="card basic-data-table">
    <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Item</th>
                    <th scope="col">Jumlah Nominal</th>
                    <th scope="col">Kasir</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SL421314</td>
                    <td>25 Jan 2024</td>
                    <td>3</td>
                    <td>Rp. 1.000</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Kathryn Murphy</h6>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="material-symbols:print-outline"></iconify-icon>
                        </a>
                        <a href="#"
                            class="w-32-px h-32-px bg-danger-focus bg-hover-danger-200 text-danger-600 rounded-circle d-inline-flex align-items-center justify-content-center"
                            data-bs-toggle="modal" data-bs-target="#deleteWarning">
                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal Warning-->
<div class="modal fade" id="deleteWarning" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin data ingin dihapus?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger">Iya</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Warning End-->
@endsection
