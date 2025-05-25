@extends('layout.layout')
@php
    $title='POS & Inventory';
    $subTitle = 'POS & Inventory';
    $script = '';

@endphp

@section('content')

    <div class="row gy-4">
        <div class="col-12">
            <div class="card radius-12">
                <div class="card-body p-16">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-1 left-line line-bg-primary position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Laba</span>
                                        <h6 class="fw-semibold mb-1">Rp. {{ format_uang($totalpendapatan) }}</h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-primary-100 text-primary-600">
                                        <i class="ri-shopping-cart-fill"></i>
                                    </span>
                                </div>
                                <!-- <p class="text-sm mb-0"><span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i class="ri-arrow-right-up-line"></i> 80%</span> From last month </p> -->
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-2 left-line line-bg-lilac position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Pembelian</span>
                                        <h6 class="fw-semibold mb-1">Rp. {{ format_uang($pembelian) }}</h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-lilac-200 text-lilac-600">
                                        <i class="ri-handbag-fill"></i>
                                    </span>
                                </div>
                                <!-- <p class="text-sm mb-0"><span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i class="ri-arrow-right-up-line"></i> 95%</span> From last month </p> -->
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-3 left-line line-bg-success position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Penjualan</span>
                                        <h6 class="fw-semibold mb-1">Rp. {{ format_uang($penjualan) }}</h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-success-200 text-success-600">
                                        <i class="ri-shopping-cart-fill"></i>
                                    </span>
                                </div>
                                <!-- <p class="text-sm mb-0"><span class="bg-danger-focus px-1 rounded-2 fw-medium text-danger-main text-sm"><i class="ri-arrow-right-down-line"></i> 30%</span> From last month </p> -->
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                            <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-4 left-line line-bg-warning position-relative overflow-hidden">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-md">Total Pengeluaran</span>
                                        <h6 class="fw-semibold mb-1">Rp. {{ format_uang($pengeluaran) }}</h6>
                                    </div>
                                    <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-warning-focus text-warning-600">
                                        <i class="ri-shopping-cart-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-8">
            <div class="card h-100">
                <div class="card-body p-24 mb-8">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Pendapatan vs Pengeluaran</h6>
                    </div>
                    <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-24">
                        <li class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px rounded-pill bg-primary-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Pendapatan </span>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <h6 class="mb-0">Rp. {{ format_uang($penjualan) }}</h6>

                            </div>
                        </li>
                        <li class="d-flex flex-column gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-8-px h-8-px rounded-pill bg-warning-600"></span>
                                <span class="text-secondary-light text-sm fw-semibold">Pengeluaran </span>
                            </div>
                            <div class="d-flex align-items-center gap-8">
                                <h6 class="mb-0">Rp. {{ format_uang($totalexpense) }}</h6>

                            </div>
                        </li>
                    </ul>
                    <div id="incomeExpense" class="apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Laporan Keseluruhan</h6>
                        <select disabled class="form-select form-select-sm w-auto bg-base border text-secondary-light" value="month">
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-24">
                    <div class="mt-32">
                        <div id="userOverviewDonutChart" class="mx-auto apexcharts-tooltip-z-none"></div>
                    </div>
                    <div class="d-flex flex-wrap gap-20 justify-content-center mt-48">
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-lilac-600"></span>
                            <span class="text-secondary-light">Pembelian</span>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-warning-600"></span>
                            <span class="text-secondary-light">Pengeluaran</span>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <span class="w-16-px h-16-px radius-2 bg-success-600"></span>
                            <span class="text-secondary-light">Penjualan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Transaksi Penjualan Terbaru</h6>
                        <a  href="{{route('riwayatjual.index')}}" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            Lihat Semua
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal </th>
                                    <th scope="col">Total Item</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Kasir</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trankjual as $i => $jual)
                                <tr>
                                    <td>
                                        <span class="text-secondary-light">{{$i + 1}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{tanggal_indonesia($jual->updated_at)}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{$jual->total_item}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{format_uang($jual->total_harga)}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{ $jual->user ? $jual->user->name : '-'}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">
                                            @if($jual->status == 'Selesai')
                                                <span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">Selesai</span>
                                            @elseif($jual->status == 'Pending')
                                            <span class="badge text-sm fw-semibold rounded-pill bg-warning-600 px-20 py-9 radius-4 text-white">Pending</span>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Transaksi Pembelian Terbaru</h6>
                        <a  href="{{route('riwayatbeli.index')}}" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            Lihat Semua
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal </th>
                                    <th scope="col">Total Item</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Kasir</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trankbeli as $i => $beli)
                                <tr>
                                    <td>
                                        <span class="text-secondary-light">{{$i + 1}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{tanggal_indonesia($beli->updated_at)}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{$beli->total_item}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{format_uang($beli->total_harga)}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">{{ $jual->user ? $jual->user->name : '-'}}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary-light">
                                            @if($beli->status == 'Selesai')
                                                <span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">Selesai</span>
                                            @elseif($beli->status == 'Pending')
                                            <span class="badge text-sm fw-semibold rounded-pill bg-warning-600 px-20 py-9 radius-4 text-white">Pending</span>
                                            @endif
                                        </span>
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

@endsection
@push('scripts')
<script>
            // ===================== Income VS Expense Start =============================== 
            function createChartTwo(chartId, color1, color2) {
                var labels =  @json($data_tanggal);
                var penjualan =  @json($data_penjualan);
                var pengeluaran =   @json($data_pengeluaran);
                var options = {
                    series: [{
                        name: "Penjualan",
                        data: penjualan
                    }, {
                        name: "Pengeluaran",
                        data: pengeluaran
                    }],
                    legend: {
                        show: false
                    },
                    chart: {
                        type: "area",
                        width: "100%",
                        height: 270,
                        toolbar: {
                            show: false
                        },
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: "smooth",
                        width: 3,
                        colors: [color1, color2], // Use two colors for the lines
                        lineCap: "round"
                    },
                    grid: {
                        show: true,
                        borderColor: "#D1D5DB",
                        strokeDashArray: 1,
                        position: "back",
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: true
                            }
                        },
                        row: {
                            colors: undefined,
                            opacity: 0.5
                        },
                        column: {
                            colors: undefined,
                            opacity: 0.5
                        },
                        padding: {
                            top: -20,
                            right: 0,
                            bottom: -10,
                            left: 0
                        },
                    },
                    fill: {
                        type: "gradient",
                        colors: [color1, color2], // Use two colors for the gradient
                        // gradient: {
                        //     shade: "light",
                        //     type: "vertical",
                        //     shadeIntensity: 0.5,
                        //     gradientToColors: [`${color1}`, `${color2}00`], // Bottom gradient colors with transparency
                        //     inverseColors: false,
                        //     opacityFrom: .6,
                        //     opacityTo: 0.3,
                        //     stops: [0, 100],
                        // },
                        gradient: {
                            shade: "light",
                            type: "vertical",
                            shadeIntensity: 0.5,
                            gradientToColors: [undefined, `${color2}00`], // Apply transparency to both colors
                            inverseColors: false,
                            opacityFrom: [0.4, 0.6], // Starting opacity for both colors
                            opacityTo: [0.3, 0.3], // Ending opacity for both colors
                            stops: [0, 100],
                        },
                    },
                    markers: {
                        colors: [color1, color2], // Use two colors for the markers
                        strokeWidth: 3,
                        size: 0,
                        hover: {
                            size: 10
                        }
                    },
                    xaxis: {
                        labels: {
                            show: false
                        },
                        categories: labels,
                        tooltip: {
                            enabled: false
                        },
                        labels: {
                            formatter: function(value) {
                                return value;
                            },
                            style: {
                                fontSize: "14px"
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return "Rp." + value;
                            },
                            style: {
                                fontSize: "14px"
                            }
                        },
                    },
                    tooltip: {
                        x: {
                            format: "dd/MM/yy HH:mm"
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
                chart.render();
            }

            createChartTwo("incomeExpense", "#487FFF", "#FF9F29");
            // ===================== Income VS Expense End =============================== 

            // ================================ Users Overview Donut chart Start ================================ 
            var options = {
                series: @json($data_piechart),
                colors: ["#45B369", "#9935FE", "#FF9F29"],
                labels: ["Penjualan", "Pembelian", "Pengeluaran"],
                legend: {
                    show: false
                },
                chart: {
                    type: "donut",
                    height: 270,
                    sparkline: {
                        enabled: true // Remove whitespace
                    },
                    margin: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                },
                stroke: {
                    width: 0,
                },
                dataLabels: {
                    enabled: true
                },
                
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }],
                
            };

            var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
            chart.render();
            // ================================ Users Overview Donut chart End ================================ 
            </script>
@endpush