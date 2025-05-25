@extends('layout.layout')
@php
$title='Kategori Produk';
$subTitle = 'Kategori Produk';
$script = '';
@endphp

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card h-100 p-0 radius-12">

    <div class="card-body">
        <!-- 
        <form action="" method="post" class="needs-validation" novalidate>
            @csrf
            @method('post') 
                <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label class="col-form-label">Date</label>
            </div>
            <div class="col-auto">
                <input type="date" id="date-start" class="form-control" required>
            </div>
            <div class="col-auto">
                <label class="col-form-label">-</label>
            </div>
            <div class="col-auto">
                <input type="date" id="date-end" class="form-control" required>
            </div>
            <div class="col-auto">
                <button type="submit"
                    class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#addModal">
                    <iconify-icon icon="mdi:filter-outline" class="icon text-xl line-height-1"></iconify-icon>Filter
                </button>
            </div>
        </div> 
</form>-->
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Penjualan</th>
                        <th scope="col" class="text-center">Pembelian</th>
                        <th scope="col" class="text-center">Pengeluaran</th>
                        <th scope="col" class="text-center">Pendapatan</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">2</td>
                        <td class="text-center">3</td>
                        <td class="text-center">4</td>
                        <td class="text-center">5</td>
                        <td class="text-center">6</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Kategori Produk</h1>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('kategoriproduk.store') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-12">
                            <label for="nama_kategori" class="form-label">Nama Kategori Produk</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"
                                placeholder="Masukkan Kategori Produk" required>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                            <button type="reset"
                                class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit"
                                class="btn btn-primary border border-primary-600 text-md px-48 py-12 radius-8">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add -->



@endsection

@push('scripts')
<script>
    let datatable;
    $(document).ready(function () {
        datatable = $('#dataTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            paging: false, // Aktifkan pagination
            autoWidth: true, // Sesuaikan lebar kolom secara otomatis
            fixedHeader: false, // Nonaktifkan fixed header
            ajax: {
                url: '{{ route("laporan.data", [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tanggal',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'penjualan',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'pembelian',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'pengeluaran',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'pendapatan',
                    searchable: false,
                    sortable: false
                }
            ],

            buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print', ],
            initComplete: function () {
                var btns = $('.dt-button');
                btns.addClass('btn btn-success btn-sm');
                btns.removeClass('dt-button');

            },
            layout: {
                topStart: {
                    div: {
                        html: `<div class="row g-3 align-items-center"> <div class="col-auto"> <label class="col-form-label">Filter : </label> </div> <div class="col-auto"> <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required> <div class="invalid-feedback">Please fill out this field.</div> </div> <div class="col-auto"> <label class="col-form-label">-</label> </div> <div class="col-auto"> <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required> <div class="invalid-feedback">Please fill out this field.</div> </div> <div class="col-auto"> <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" id="filterin"> <iconify-icon icon="mdi:filter-outline" class="icon text-xl line-height-1"></iconify-icon></button> </div> </div>`
                    }
                },
                topEnd: ['buttons']
            }

        });

        $(document).on("click", "#filterin", function () {
            let tanggal_awal = $("#tanggal_awal").val();
            let tanggal_akhir = $("#tanggal_akhir").val();

            if (!tanggal_awal || !tanggal_akhir) {
                alert("Silahkan isi kedua tanggal terlebih dahulu!")
            } else {
                let url = "/laporan/data/" + tanggal_awal + "/" + tanggal_akhir;
                datatable.ajax.url(url).load(); // Langsung reload DataTable pakai URL baru
            }
        });
    });

</script>
@endpush
