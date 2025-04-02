@extends('layout.layout')
@php
$title='Transaksi Penjualan';
$subTitle = 'Transaksi Penjualan';
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
                        class="btn btn-lg btn-primary w-100 d-flex justify-content-center align-items-center gap-2 fs-1"
                        data-bs-toggle="modal" data-bs-target="#bayar">
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
                        <h1 class="display-1 text-white text-end">Rp. 99.999.999</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="card h-100 p-0 radius-12">
            <div
                class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                    <form class="navbar-search ">
                        <input type="text" class="bg-base h-40-px w-auto form-control" name="search"
                            placeholder="Search">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                </div>
            </div>

            <div class="card-body p-24">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table sm-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">
                                    ID
                </div>
                </th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
                <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>qwiojeqoijqow</td>
                        <td>Vape askdas;ldkas;ldkas;ldk</td>
                        <td>Rp. 100,000</td>
                        <td><input type="number" name="#0" class="form-control w-auto" required></td>
                        <td>Rp.2.000</td>
                        <td class="text-center"> <a href="javascript:void(0)"
                                class="remove-item-btn w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Warning-->
<div class="modal fade" id="bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-20">
                    <label for="Total" class="form-label fw-semibold text-primary-light text-sm mb-8">Total harga</label>
                    <input type="number" class="form-control radius-8" id="totalharga" placeholder="Total" disabled
                        readonly>
                </div>
                <div class="mb-20">
                    <label for="Amount" class="form-label fw-semibold text-primary-light text-sm mb-8">Bayar <span
                            class="text-danger-600">*</span></label>
                    <input type="number" class="form-control radius-8" id="amount" placeholder="Masukkan nominal">
                </div>
                <div class="mb-20">
                    <label for="Return" class="form-label fw-semibold text-primary-light text-sm mb-8">Kembalian</label>
                    <input type="number" class="form-control radius-8" id="kembalian" placeholder="Kembalian" disabled
                        readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Bayar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Warning End-->

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
