@extends('layout.layout')
@php
$title='Transaksi Pembelian';
$subTitle = 'Transaksi Pembelian';
$script = '<script>
    $(".remove-item-btn").on("click", function () {
        $(this).closest("tr").addClass("d-none")
    });

</script>';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-3 d-flex justify-content-center gap-3">
                    <button type="button"
                        class="btn btn-lg btn-success w-100 d-flex justify-content-center align-items-center gap-2 fs-1"
                        id="tmbbyr">
                        Bayar
                    </button>
                </div>
                <div class="col-3 d-flex justify-content-center gap-3">
                    <button type="button"
                        class="btn btn-lg btn-danger w-100 d-flex justify-content-center align-items-center gap-2 fs-1 text-white"
                        data-bs-toggle="modal" data-bs-target="#deleteWarning">
                        Hapus
                    </button>
                </div>
                <div class="col-6">
                    <div class="card bg-black text-primary p-3">
                        <h1 class="display-1 text-white text-end" id="totalHarga">Rp. 0</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 align-items-center gap-3 justify-content-between">
                <div class="row ">
                    <div class="d-flex col-6 align-items-center gap-3">
                        <span class="text-md fw-medium text-secondary-light mb-0">Kode</span>
                        <div class="input-group">
                            <input type="text" id="kode_produk" class="form-control" placeholder="Masukkan Kode Barang"
                                aria-label="Kode Barang" aria-describedby="basic-addon2" autofocus>
                            <button class="btn btn-outline-primary" type="button" id="button-addon2"
                                onclick="tambahProduk()">
                                <iconify-icon icon="uil:enter" class="menu-icon"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-secondary text-white w-50" data-bs-toggle="modal"
                            data-bs-target="#produkModal">
                            Cari barang
                        </button>
                    </div>
                    <div class="d-flex col-3 align-items-center gap-3">
                        <span class="text-md fw-medium text-secondary-light mb-0">ID</span>
                        <div class="input-group">
                            <input type="text" id="id_pembelian" class="form-control" placeholder="ID Pembelian"
                                aria-label="id_pembelian" aria-describedby="basic-addon2" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-24">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table sm-table mb-0" id="tableOrder" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">
                                    ID
                </div>
                </th>
                <th scope="col" class="text-center">Nama Produk</th>
                <th scope="col" class="text-center">Stok saat ini</th>
                <th scope="col" class="text-center">Harga Beli</th>
                <th scope="col" class="text-center">Qty</th>
                <th scope="col" class="text-center">Subtotal</th>
                <th scope="col" class="text-center">Action</th>
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

<!-- Modal Pay-->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Bayar</h1>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('orderbeli.checkout') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Total Harga</label>
                            <input type="number" id="totalbayar" name="totalbayar" class="form-control"
                                placeholder="Total" disabled>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bayar</label>
                            <input type="number" id="bayar" name="bayar" class="form-control" placeholder="Bayar"
                                required autofocus>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Metode Pembayaran</label>
                            <select id="metode" name="metode" class="form-control radius-8 form-select" required>
                                <option value="cash">Cash</option>
                                <option value="qris">Qris</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                            <button type="reset"
                                class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit"
                                class="btn btn-primary border border-primary-600 text-md px-48 py-12 radius-8" id="submitbyr">
                                Bayar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Pay End-->

<!-- Modal Warning-->
<div class="modal fade" id="deleteWarning" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Peringatan</h5>
            </div>
            <div class="modal-body">
                Apakah anda yakin data ingin dihapus?
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" id="hapusSemua">Iya</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Warning End-->

<!-- Modal Produk -->
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Kode</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Harga</th>
                                <th scope="col" class="text-center">Stok</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table">
                            @foreach($produk as $i => $produk)
                            <tr>
                                <td class="text-center">{{$i + 1}}</td>
                                <td class="text-center">{{$produk->id_produk}}</td>
                                <td class="text-center">{{$produk->nama}}</td>
                                <td class="text-center">{{format_uang($produk->harga_beli)}}</td>
                                <td class="text-center">{{$produk->stok}}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <button type="button"
                                            class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                            data-bs-toggle="modal" onclick="pilihProduk('{{ $produk->id_produk}}')"
                                            data-bs-dismiss="modal">
                                            <iconify-icon icon="icon-park-solid:correct" class="menu-icon"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
    var table;
    new DataTable('#dataTable', {
        paging: true, // Aktifkan pagination
        autoWidth: true, // Sesuaikan lebar kolom secara otomatis
        responsive: true

    });

    function pilihProduk(id) {
        $('#kode_produk').val(id);
        tambahProduk();
    }

    function updateTotalHarga() {
        $.ajax({
            url: "{{ route('orderbeli.totalHarga') }}", // Panggil route yang telah dibuat
            method: "GET",
            success: function (response) {
                $("#totalHarga").text("Rp " + response.total_harga.toLocaleString("id-ID"));
                $("#totalbayar").val(response.total_harga);
                $("#id_pembelian").val(response.id_pembelian.toLocaleString("id-ID"));
            },
            error: function () {
                console.error("Gagal mengambil total harga");
            }
        });
    }

    function tambahProduk() {
        let id_produk = $("#kode_produk").val(); // Ambil ID produk dari input
        $.ajax({
            url: "{{ route('orderbeli.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id_produk: id_produk
            },
            success: function (response) {
                if (response.success) {
                    table.ajax.reload(null, false); // Reload tabel tanpa reset halaman
                    updateTotalHarga();
                    setTimeout(() => {
                        $('#kode_produk').val('');
                        $('#kode_produk').focus();
                        }, 200); // Beri delay kecil agar perubahan tampak lebih natural

                } else {
                    alert("Produk tidak ditemukan atau ID salah.");
                    setTimeout(() => {
                        $('#kode_produk').val('');
                        $('#kode_produk').focus();
                        }, 200); // Beri delay kecil agar perubahan tampak lebih natural
                }
            }
        });
    }

    $(document).ready(function () {
        updateTotalHarga();

        table = $('#tableOrder').DataTable({
            paging: false,
            autoWidth: false,
            processing: true,
            layout: {
                topStart: null,
                topEnd: null,
                bottomStart: null,
                bottomEnd: null
            },
            ajax: {
                url: "{{ route('orderbeli.data') }}"
            },
            type: "GET", // Mengambil data dari Controller
            columns: [{
                    data: 'id_produk',
                    name: 'id_produk'
                },
                {
                    data: 'produk.nama',
                    name: 'produk.nama'
                },
                {
                    data: 'produk.stok',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'produk.harga_beli',
                    name: 'produk.harga_beli',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $(document).on("input", ".quantity", function () {
            let id_orderbeli = $(this).data("id");
            let new_quantity = $(this).val();
            console.log(new_quantity);
            $.ajax({
                url: "{{ route('orderbeli.updateQuantity') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id_orderbeli: id_orderbeli,
                    quantity: new_quantity
                },
                success: function (response) {
                    if (response.success) {
                        setTimeout(() => {
                            table.ajax.reload(null,
                            false); // Reload tabel tanpa reset halaman
                            updateTotalHarga();
                        }, 1000); // Beri delay kecil agar perubahan tampak lebih natural
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        $(document).on("click", ".hapus-barang", function () {
            let id_orderbeli = $(this).data("id");

            $.ajax({
                url: "{{ route('orderbeli.deleteItem') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id_orderbeli: id_orderbeli
                },
                success: function (response) {
                    if (response.success) {
                        alert("Produk berhasil dihapus!");
                        table.ajax.reload(null, false); // Reload tabel tanpa reset halaman
                        updateTotalHarga();
                    } else {
                        alert("Produk gagal dihapus");
                    }
                }
            });
        });
    });

    document.getElementById("kode_produk").addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            tambahProduk();
        }
    });

    document.getElementById("submitbyr").addEventListener("click", function (event) {
        const totalBayar = document.getElementById("totalbayar").value || 0;
        const bayar = document.getElementById("bayar").value || 0;

        if (bayar < totalBayar) {
            alert("Uang Anda kurang!");
            event.preventDefault(); // Cegah submit form
            bayar.focus(); // Fokuskan kembali ke input bayar
        } else {
            // Tampilkan konfirmasi jika jumlah bayar cukup
            const konfirmasi = confirm('Konfirmasi pembayaran sebesar Rp ' + document.getElementById("totalbayar").value + ' ?');
            if (!konfirmasi) {
                event.preventDefault(); // Batalkan submit jika user membatalkan
            }
        }
    });
        document.getElementById("tmbbyr").addEventListener("click", function() {
            if(table.rows().count() === 0){
                alert("Masukkan barang terlebih dahulu");
            } else{
                $('#payModal').modal('show');
            }
        });
    document.getElementById("hapusSemua").addEventListener("click", function() {
        if(table.rows().count() === 0){
            alert("Tidak ada data untuk dihapus!");
            $('#deleteWarning').modal('hide');
        } else {
            $.ajax({
            url: "{{ route('orderbeli.deleteAll') }}",
            method: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    alert("Semua item berhasil dihapus!");
                    table.ajax.reload(); // Reload tabel jika menggunakan DataTables
                } else {
                    alert("Gagal menghapus item!");
                }
            }
            });
        }
    });
</script>
@endpush
