@extends('layout.layout')
@php
$title='Riwayat Penjualan';
$subTitle = 'Riwayat Penjualan';
$script = '';
@endphp

@section('content')

<div class="card h-100 p-0 radius-12">

    <div class="card-body">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Total Item</th>
                        <th scope="col" class="text-center">Total Harga</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Produk -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0" id="detailTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Kode</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Harga</th>
                                <th scope="col" class="text-center">QTY</th>
                                <th scope="col" class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Produk End -->


@endsection

@push('scripts')
<script>
    var table, table1;
    $(document).ready(function () {
        $(document).on("click", ".hapus-barang", function () {
            let id_penjualan = $(this).data("id");
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.ajax({
                    url: "#",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_penjualan : id_penjualan
                    },
                    success: function (response) {
                        if (response.success) {
                            alert("Data Dihapus!");
                            table.ajax.reload(null,
                            false); // Reload tabel tanpa reset halaman
                        } else {
                            alert("Tidak dapat menghapus data");
                        }
                    }
                });
            }
        });
        let orderJualIndexURL = "#";
        table = $('#dataTable').DataTable({
            paging: true, // Aktifkan pagination
            autoWidth: true, // Sesuaikan lebar kolom secara otomatis
            fixedHeader: false, // Nonaktifkan fixed header
            order: [
                [0, 'desc']
            ],
            buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print', ],
            initComplete: function () {
                var btns = $('.dt-button');
                btns.addClass('btn btn-success btn-sm');
                btns.removeClass('dt-button');

            },
            layout: {
                topStart: ['search', 'buttons'],
                topEnd: {
                    div: {
                        html: '<a type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" href="'+ orderJualIndexURL +'"><iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>Tambah Penjualan</a>'
                    }
                }
            },
            responsive: true,
            ajax: {
                url: "#"
            },
            type: "GET", // Mengambil data dari Controller
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'total_item',
                    name: 'total_item'
                },
                {
                    data: 'total_harga',
                    name: 'total_harga'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [{
                className: 'text-center',
                targets: [0, 1, 2, 3, 4, 5]
            }, ]

        });

        table1 = $('#detailTable').DataTable({
            paging: true, // Aktifkan pagination
            processing: true,
            bSort: false,
            serverSide: true,
            layout: {
                topStart: null,
                topEnd: null,
                bottomStart: null,
                bottomEnd: null
            }, // Jika datanya berasal dari Ajax, tambahkan ini
            ajax: {
                url: ""
            },
            type: "GET",
            columns: [{
                    data: 'produk.id',
                    name: 'produk.id'
                },
                {
                    data: 'produk.nama',
                    name: 'produk.nama'
                },
                {
                    data: 'produk.harga_jual',
                    name: 'produk.harga_jual'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                }
            ],
            columnDefs: [{
                className: 'text-center',
                targets: [0, 1, 2, 3, 4]
            }, ]

        });
    });

    function showDetail(url) {
        $('#detailModal').modal('show');

        table1.ajax.url(url);
        table1.ajax.reload();
    }

    function struk(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
            .documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
            .documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft
        const top = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow = window.open(url, title,
            `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    }

</script>
@endpush
