@extends('layout.layout')
@php
$title='Kategori Produk';
$subTitle = 'Kategori Produk';
$script = '';
@endphp

@section('content')

<div class="card h-100 p-0 radius-12">

    <div class="card-body">

        <div class="table-responsive scroll-sm">
        <table class="table bordered-table sm-table mb-0" id="dataTable" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No.</th>
                    <th scope="col" class="text-center">Nama Kategori</th>
                </tr>
            </thead>
            <tbody id="table">
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
                <form action="#" method="post" class="needs-validation" novalidate>
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
    new DataTable('#dataTable', {
        paging: true, // Aktifkan pagination
        autoWidth: true, // Sesuaikan lebar kolom secara otomatis
        fixedHeader: false, // Nonaktifkan fixed header

        buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print', ],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-success btn-sm');
            btns.removeClass('dt-button');

        },
        layout: {
            topStart:
                ['search', 'buttons']
            ,
            topEnd: {
                div: {
                html: '<button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal"><iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>Tambah Kategori Produk</button>'
            }
            }
        },
        responsive: true

    });

</script>
@endpush
