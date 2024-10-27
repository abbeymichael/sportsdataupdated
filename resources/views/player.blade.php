@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <!-- Section 1: Player Bio -->
        <div class="stats-card shadow-lg border-0 mb-4">
            <div class="card-body p-4 p-md-5">
                <!-- Player Image and Name Section -->
                <div class="text-center mb-4">
                    <div class="position-relative d-inline-block mb-3">
                        <div class="rounded-circle player-image" style="width: 160px; height: 160px;">
                            <img 
                            src="{{ $player->image ? asset('storage/' . $player->image) : 'https://placehold.co/120x120' }}" 
                            alt="{{ $player->name }}"
                            class="rounded-circle img-fluid"
                            style="width: 150px; height: 150px; object-fit: cover;"
                        >
                        
                        </div>
                    </div>
                    <h2 class="fw-bold mb-4">{{ $player->name }}</h2>
                </div>
        
                <!-- Player Stats Grid -->
                <div class="row justify-content-center g-3">
                    <!-- Position -->
                    <div class="col-6 col-md-4 col-lg">
                        <div class="teammate-card h-100  border-0">
                            <div class="card-body text-center p-3">
                                <div class=" small text-uppercase fw-semibold mb-2">Position</div>
                                <div class="fw-bold">{{ $player->position }}</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Age -->
                    <div class="col-6 col-md-4 col-lg">
                        <div class="teammate-card h-100 border-0">
                            <div class="card-body text-center p-3">
                                <div class="small text-uppercase fw-semibold mb-2">Age</div>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($player->dob)->age }}</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Height -->
                    <div class="col-6 col-md-4 col-lg">
                        <div class="teammate-card h-100 border-0">
                            <div class="card-body text-center p-3">
                                <div class="small text-uppercase fw-semibold mb-2">Height</div>
                                <div class="fw-bold">{{ $player->height }} cm</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Weight -->
                    <div class="col-6 col-md-4 col-lg">
                        <div class="teammate-card h-100 border-0">
                            <div class="card-body text-center p-3">
                                <div class=" small text-uppercase fw-semibold mb-2">Weight</div>
                                <div class="fw-bold">{{ $player->weight }} kg</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Preferred Foot -->
                    <div class="col-6 col-md-4 col-lg">
                        <div class="teammate-card h-100 border-0">
                            <div class="card-body text-center p-3">
                                <div class="small text-uppercase fw-semibold mb-2">Preferred Foot</div>
                                <div class="fw-bold">{{ ucfirst($player->preferred_foot) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Charts (2 columns) -->
       
        <!-- Section 2: Player Analysis Charts -->
<div class="row mb-4">
    <!-- Physical Analysis Chart -->
    <div class="col-md-6 mb-4">
        <div class="stats-card">
          
            <div class="card-body">
                <div id="physicalChart"></div>
            </div>
        </div>
    </div>

    <!-- Technical Analysis Chart -->
    <div class="col-md-6 mb-4">
        <div class="stats-card">
       
            <div class="card-body">
                <div id="technicalChart"></div>
            </div>
        </div>
    </div>

    <!-- Tactical Analysis Chart -->
    <div class="col-md-6 mb-4">
        <div class="stats-card">
          
            <div class="card-body">
                <div id="tacticalChart"></div>
            </div>
        </div>
    </div>

    <!-- Mental Analysis Chart -->
    <div class="col-md-6 mb-4">
        <div class="stats-card">
          
            <div class="card-body">
                <div id="mentalChart"></div>
            </div>
        </div>
    </div>
</div>


     






    <!-- Section 3: Teammates -->
    <div class="stats-card">
        <h5 class="mb-4">Teammates</h5>
        <div class="row">
            @foreach ($teammates as $teammate)
                <div class="col-md-3 mb-3">
                    <div class="teammate-card p-3">
                        <div class="d-flex align-items-center gap-2">
                            <img 
                            src="{{ $teammate->image ? asset('storage/' . $teammate->image) : 'https://placehold.co/40x40' }}" 
                            alt="{{ $teammate->name }}"
                            class="rounded-circle"
                            style="width: 40px; height: 40px; object-fit: cover;"
                        >
                        
                        
                            <div>
                                <a href="{{ route('player.show', $teammate->id) }}"
                                    class="text-decoration-none text-white">
                                    {{ $teammate->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    <!-- ApexCharts Script -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Shared Tooltip Style
      // Shared Tooltip Style
const tooltipStyle = {
    theme: 'dark',
    backgroundColor: '#333333',
    style: {
        fontSize: '12px',
        fontFamily: 'Arial, sans-serif',
        color: '#f8f9fa'
    },
    x: {
        show: false
    },
};

// Shared Chart Options
const baseOptions = {
    chart: {
        type: 'polarArea',
        toolbar: {
            show: false
        },
        dropShadow: {
            enabled: true,
            blur: 3,
            left: 2,
            top: 2
        }
    },
    legend: {
        position: 'bottom',
        horizontalAlign: 'center',
        fontSize: '12px',
        fontFamily: 'Arial, sans-serif',
        labels: {
            colors: '#f8f9fa'
        }
    },
    stroke: {
        width: 2,
        colors: ['#ffffff']
    },
    fill: {
        opacity: 0.8
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: '100%',
                height: 300
            }
        }
    }],
    plotOptions: {
        polarArea: {
            rings: {
                strokeWidth: 1,
                strokeColor: '#555555'
            },
            spokes: {
                strokeWidth: 1,
                connectorColors: '#555555'
            }
        }
    },
    yaxis: {
        show: false
    },
    tooltip: tooltipStyle
};

// Technical Chart
var technicalOptions = {
    ...baseOptions,
    series: @json($technicalData['data']),
    labels: @json($technicalData['labels']),
    colors: ['#FF6384', '#FF9F40', '#FFCD56', '#4BC0C0', '#36A2EB', '#9966FF'],
    title: {
        text: 'Technical Analysis',
        align: 'center',
        style: {
            fontSize: '16px',
            color: '#f8f9fa'
        }
    }
};
var technicalChart = new ApexCharts(document.querySelector("#technicalChart"), technicalOptions);
technicalChart.render();

// Tactical Chart
var tacticalOptions = {
    ...baseOptions,
    series: @json($tacticalData['data']),
    labels: @json($tacticalData['labels']),
    colors: ['#36A2EB', '#4BC0C0', '#FFCD56', '#FF9F40', '#FF6384', '#9966FF'],
    title: {
        text: 'Tactical Analysis',
        align: 'center',
        style: {
            fontSize: '16px',
            color: '#f8f9fa'
        }
    }
};
var tacticalChart = new ApexCharts(document.querySelector("#tacticalChart"), tacticalOptions);
tacticalChart.render();

// Physical Chart
var physicalOptions = {
    ...baseOptions,
    series: @json($physicalData['data']),
    labels: @json($physicalData['labels']),
    colors: ['#4BC0C0', '#FFCD56', '#FF9F40', '#FF6384', '#36A2EB', '#9966FF'],
    title: {
        text: 'Physical Analysis',
        align: 'center',
        style: {
            fontSize: '16px',
            color: '#f8f9fa'
        }
    }
};
var physicalChart = new ApexCharts(document.querySelector("#physicalChart"), physicalOptions);
physicalChart.render();

// Mental Chart
var mentalOptions = {
    ...baseOptions,
    series: @json($mentalData['data']),
    labels: @json($mentalData['labels']),
    colors: ['#FF6384', '#FF9F40', '#FFCD56', '#4BC0C0', '#36A2EB', '#9966FF', '#ff8a65', '#ba68c8'],
    title: {
        text: 'Mental Analysis',
        align: 'center',
        style: {
            fontSize: '16px',
            color: '#f8f9fa'
        }
    },
    tooltip: {
        ...tooltipStyle,
        y: {
            formatter: function(value) {
                return value + ' / 10';
            }
        }
    }
};
var mentalChart = new ApexCharts(document.querySelector("#mentalChart"), mentalOptions);
mentalChart.render();
    </script>
@endsection
