@extends('layout.layout')
@php
$title='Laporan Pendapatan';
$subTitle = 'Laporan Pendapatan';
@endphp

@section('content')

<div class="card h-100 p-0 radius-12">
    <div
        class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Tampilkan dari tanggal </span>
            <input type="date" name="from" class="form-control bg-base h-40-px w-auto">
            <span class="text-md fw-medium text-secondary-light mb-0"> sampai tanggal </span>
            <input type="date" name="to" class="form-control bg-base h-40-px w-auto">
            <button type="button"
                class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Add New Role
            </button>
        </div>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table table-hover bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Penjualan</th>
                        <th scope="col">Pembelian</th>
                        <th scope="col">Pengeluaran</th>
                        <th scope="col">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2022-01-01</td>
                        <td>1000</td>
                        <td>2000</td>
                        <td>1000</td>
                        <td>-1000</td>
                    </tr>
                    <tr class="table-active">
                        <td colspan="4"> </td>
                        <td>Total Pendapatan :</td>
                        <td>Banyak</td>
                    </tr>
                </tbody>
            </table>
        </div>

        
    </div>
</div>

@endsection
