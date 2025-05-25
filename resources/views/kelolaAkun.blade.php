@extends('layout.layout')
@php
$title='Users Grid';
$subTitle = 'Users Grid';
$script ='<script>
    $(".remove-item-btn").on("click", function () {
        $(this).closest("tr").addClass("d-none")
    });

</script>';
@endphp

@section('content')

<div class="card h-100 p-0 radius-12">

    <div class="card-body">
        <div class="table-responsive scroll-sm">
            <table id="dataTable" class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col" class="text-center">Tanggal Dibuat</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="table">
                    @foreach($user as $i => $user)
                    <tr>
                        <td class="text-center">{{$i + 1}}</td>
                        <td class="text-center">{{$user->name}}</td>
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center">{{$user->role}}</td>
                        <td class="text-center">{{tanggal_indonesia($user->created_at)}}</td>
                        <td class="text-center">
                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                <button type="button"
                                    class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{$user->id}}">
                                    <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                </button>
                                <button type="button"
                                    class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id}}">
                                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Update -->
                    <div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel">Tambah Kategori Produk</h1>
                                </div>
                                <div class="modal-body p-24">
                                    <form action="{{ route('manageakun.update', $user->id) }}" method="post"
                                        class="needs-validation" novalidate>
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="mb-20">
                                                <label for="name"
                                                    class="form-label fw-semibold text-primary-light text-sm mb-8">Nama
                                                    Lengkap <span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" id="nama" name="nama"
                                                    placeholder="Masukkan Nama Lengkap" value="{{$user->name}}" required>
                                            </div>
                                            <div class="mb-20">
                                                <label for="email"
                                                    class="form-label fw-semibold text-primary-light text-sm mb-8">Email
                                                    <span class="text-danger-600">*</span></label>
                                                <input type="email" class="form-control radius-8" id="email"
                                                    name="email" placeholder="Masukkan Alamat Email" value="{{$user->email}}" required>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="mb-20">
                                                <label for="number"
                                                    class="form-label fw-semibold text-primary-light text-sm mb-8">Kata
                                                    Sandi</label>
                                                <input type="password" class="form-control radius-8" id="password"
                                                    name="password" placeholder="Masukkan Kata Sandi" required>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="mb-20">
                                                <label for="depart"
                                                    class="form-label fw-semibold text-primary-light text-sm mb-8">Role
                                                    <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" id="role" name="role">
                                                    <option value="Manajer" {{ $user->role == 'Manager' ? 'selected' : '' }}>Manajer</option>
                                                    <option value="Kasir" {{ $user->role == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                                                    <option value="Gudang" {{ $user->role == 'Gudang' ? 'selected' : '' }}>Gudang</option>
                                                </select>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <button type="button"
                                                    class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
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
                    <div class="modal fade" id="deleteModal{{$user->id}}" data-bs-backdrop="static"
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
                                    <form action="{{ route('manageakun.destroy', $user->id) }}"
                                        method="post">
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


<!-- Modal Start -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5">Add New Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <h6 class="text-md text-primary-light mb-16">Profile Image</h6>
                <!-- Upload Image Start -->
                <!-- <div class="mb-24 mt-16">
                    <div class="avatar-upload">
                        <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                            <label for="imageUpload"
                                class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                            </label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview"> </div>
                        </div>
                    </div>
                </div> -->
                <!-- Upload Image End -->
                <form action="{{ route('manageakun.store') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="mb-20">
                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Nama Lengkap
                            <span class="text-danger-600">*</span></label>
                        <input type="text" class="form-control radius-8" id="nama" name="nama"
                            placeholder="Masukkan Nama Lengkap">
                    </div>
                    <div class="mb-20">
                        <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span
                                class="text-danger-600">*</span></label>
                        <input type="email" class="form-control radius-8" id="email" name="email"
                            placeholder="Masukkan Alamat Email">
                    </div>
                    <div class="mb-20">
                        <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Kata
                            Sandi</label>
                        <input type="password" class="form-control radius-8" id="password" name="password"
                            placeholder="Masukkan Kata Sandi">
                    </div>
                    <div class="mb-20">
                        <label for="depart" class="form-label fw-semibold text-primary-light text-sm mb-8">Role
                            <span class="text-danger-600">*</span> </label>
                        <select class="form-control radius-8 form-select" id="role" name="role">
                            <option value="Manajer">Manajer </option>
                            <option value="Kasir">Kasir </option>
                            <option value="Gudang">Gudang</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <button type="button"
                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                            Cancel
                        </button>
                        <button type="submit"
                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
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
                    html: '<button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal"><iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>Tambah Kategori Produk</button>'
                }
            }
        },
        responsive: true

    });

</script>
@endpush
