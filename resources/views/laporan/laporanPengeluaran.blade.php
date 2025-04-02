@extends('layout.layout')
@php
$title='Riwayat Pembelian';
$subTitle = 'Laporan Pembelian';
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
                    <th scope="col">Kategori</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SL421314</td>
                    <td>25 Jan 2024</td>
                    <td>Listrik</td>
                    <td>Habisaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                    <td>Rp. 1.000</td>
                    <td>
                        <button type="button"
                            class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal Warning-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
