@extends('layout.layout')
@php
$title='Kelola Produk';
$subTitle = 'Kelola Produk';
$script = '';
@endphp

@section('content')

<div class="card h-100 p-0 radius-12">

    <div class="card-body">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Id</th>
                        <th scope="col" class="text-center">Kategori</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-center">Harga Beli</th>
                        <th scope="col" class="text-center">Harga Jual</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table">
                    @foreach($produk as $i => $produk)
                    <tr>
                        <td class="text-center">{{$produk->id}}</td>
                        <td class="text-center">{{$produk->kategori->nama_kategori}}</td>
                        <td class="text-center">{{$produk->nama}}</td>
                        <td class="text-center">{{$produk->stok}}</td>
                        <td class="text-center">{{format_uang($produk->harga_beli)}}</td>
                        <td class="text-center">{{format_uang($produk->harga_jual)}}</td>
                        <td class="text-center">
                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                <button type="button"
                                    class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{$produk->id}}">
                                    <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                </button>
                                <button type="button"
                                    class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{$produk->id}}">
                                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Update -->
                    <div class="modal fade" id="editModal{{$produk->id}}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel">Tambah Produk</h1>
                                </div>
                                <div class="modal-body p-24">
                                    <form action="{{ route('produk.update',$produk->id) }}" method="post"
                                        class="needs-validation" novalidate>
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="id" class="form-label">ID Produk</label>
                                                <input type="text" id="id" name="id" name="#0"
                                                    class="form-control" value="{{$produk->id}}"
                                                    placeholder="Masukkan Kode Produk" maxlength="13" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" id="nama" name="nama" name="#0" class="form-control"
                                                    value="{{$produk->nama}}" placeholder="Masukkan Nama Produk" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Harga</label>
                                                <div class="input-group">
                                                    <input type="number" id="harga_beli" name="harga_beli" name="#0"
                                                        class="form-control" value="{{$produk->harga_beli}}"
                                                        placeholder="Harga Beli" required>
                                                    <input type="number" id="harga_jual" name="harga_jual" name="#0"
                                                        class="form-control" value="{{$produk->harga_jual}}"
                                                        placeholder="Harga Jual" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Kategori</label>
                                                <select id="id_kategori" name="id_kategori"
                                                    class="form-control radius-8 form-select" required>
                                                    @foreach ($kategori as $key => $item)
                                                    <option value="{{ $key }}"
                                                        {{ $produk->id_kategori == $key ? 'selected' : '' }}>
                                                        {{ $item }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Stok</label>
                                                <input id="stok" name="stok" type="number" name="#0"
                                                    class="form-control" value="{{$produk->stok}}"
                                                    placeholder="Masukkan Stok" required>
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
                    <!-- Modal Update -->

                    <!-- Modal Warning-->
                    <div class="modal fade" id="deleteModal{{$produk->id}}" data-bs-backdrop="static"
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
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-danger">Iya</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Warning End-->
                    @endforeach
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
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Produk</h1>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('produk.store') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    @method('post') 
                    <div class="row">
                        <div class="col-12">
                            <label for="id" class="form-label">ID Produk</label>
                            <input type="text" id="id" name="id" name="#0" class="form-control"
                                placeholder="Masukkan Kode Produk" maxlength="13" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" id="nama" name="nama" name="#0" class="form-control"
                                placeholder="Masukkan Nama Produk" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <input type="number" id="harga_beli" name="harga_beli" name="#0" class="form-control"
                                    placeholder="Harga Beli" required>
                                <input type="number" id="harga_jual" name="harga_jual" name="#0" class="form-control"
                                    placeholder="Harga Jual" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Kategori</label>
                            <select id="id_kategori" name="id_kategori" class="form-control radius-8 form-select" required>
                                @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Stok</label>
                            <input id="stok" name="stok" type="number" name="#0" class="form-control"
                                placeholder="Masukkan Stok" required>
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
            topStart: ['search', 'buttons'],
            topEnd: {
                div: {
                    html: '<button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal"><iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>Tambah Produk</button>'
                }
            }
        },
        responsive: true

    });

</script>
@endpush
