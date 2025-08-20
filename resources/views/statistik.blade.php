@extends('layouts.app')

@section('title', 'STATISTIK')

@section('content')
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .title {
            text-align: center;
            color: #333333;
            margin: 100px 0 40px 0;
            font-size: 36px;
            font-weight: 600;
        }

        .charts {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .chart-container {
            background: white;
            padding: 30px 20px;
            border-radius: 16px;
            width: 420px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .chart-container:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
        }

        .chart-title {
            text-align: center;
            font-size: 18px;
            font-weight: 500;
            color: #555;
            margin-bottom: 20px;
        }
    </style>

    <div class="title">Statistik</div>

    <div class="charts">
        <!-- Chart 1: Jabatan -->
        <div class="chart-container">
            <div class="chart-title">Jumlah Widyaiswara Berdasarkan Jabatan</div>
            <canvas id="chartJabatan"></canvas>
        </div>

        <!-- Chart 2: Jenis Kelamin -->
        <div class="chart-container">
            <div class="chart-title">Jumlah Widyaiswara Berdasarkan Jenis Kelamin</div>
            <canvas id="chartGender"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Jabatan
        const ctx1 = document.getElementById('chartJabatan').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: [
                    'WIDYAISWARA AHLI MADYA',
                    'WIDYAISWARA AHLI UTAMA',
                    'WIDYAISWARA AHLI MUDA',
                    'WIDYAISWARA AHLI PERTAMA'
                ],
                datasets: [{
                    data: [30, 15, 7, 1],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#444'
                        }
                    }
                }
            }
        });

        // Chart Gender
        const ctx2 = document.getElementById('chartGender').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [36, 17],
                    backgroundColor: ['#4e73df', '#f6c23e'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#444'
                        }
                    }
                }
            }
        });
    </script>
@endsection
