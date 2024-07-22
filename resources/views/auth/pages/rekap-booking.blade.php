@extends('auth.layouts.dashboard')
@section('title_page', 'Rekap Booking')
@section('breadcrumb', 'Rekap Booking')

@section('content')
<div class="container">


    <!-- Chart Section -->
    {{-- <div class="mt-3" style="margin-bottom: 50px">
        <h2>Grafik Perkembangan Booking per Tahun Semua Layanan</h2>
        <div class="form-group">
            <label for="year">Pilih Tahun</label>
            <select id="year" class="form-control">
                @for ($i = 2020; $i <= date('Y') + 5; $i++) <!-- Tambahkan tahun hingga 5 tahun ke depan -->
                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <canvas id="bookingChartByServicePerMonth" style="max-width: 100%; max-height: 400px;"></canvas>
    </div> --}}

    <!-- Chart Section -->
    <div class="mt-3" style="margin-bottom: 50px">
        <h2>Grafik Perkembangan Booking per Bulan Berdasarkan Layanan</h2>
        <div class="form-group">
            <label for="layanan">Pilih Layanan</label>
            <select id="layanan" class="form-control">
                <option value="">Semua Layanan</option>
                @foreach($layanans as $layanan)
                    <option value="{{ $layanan->id_layanan }}">{{ $layanan->nama_layanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="year">Pilih Tahun</label>
            <select id="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="month">Pilih Bulan</label>
            <select id="month" class="form-control">
                <option value="">Semua Bulan</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                @endforeach
            </select>
        </div>
        <canvas id="bookingChart" style="max-width: 100%; max-height: 400px;"></canvas>
    </div>

    <h1>Rekap Booking Tanggal: {{ $tanggal }}</h1>

    <form action="{{ route('rekap.booking') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="tanggal">Pilih Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal }}">
        </div>
        <button type="submit" class="btn btn-primary">Lihat Rekap</button>
    </form>

    @if($acceptedBookings->isEmpty() && $rejectedBookings->isEmpty())
        <p>Tidak ada booking untuk tanggal ini.</p>
    @else
        <h2>Booking Diterima</h2>
        @if($acceptedBookings->isEmpty())
            <p>Tidak ada booking diterima untuk tanggal ini.</p>
        @else
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Cabang Klinik</th>
                        <th>Dokter</th>
                        <th>Layanan</th>
                        <th>Tanggal Booking</th>
                        <th>Waktu Booking</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($acceptedBookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->nama_user }}</td>
                        <td>{{ $booking->email_user }}</td>
                        <td>{{ $booking->telepon_user }}</td>
                        <td>{{ $booking->cabangKlinik->nama_cabang }}</td>
                        <td>{{ $booking->dokterKlinik->nama_dokter }}</td>
                        <td>{{ $booking->layanans->nama_layanan }}</td>
                        <td>{{ $booking->tanggal_booking }}</td>
                        <td>{{ $booking->timeSlot->slot }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $acceptedBookings->links() }} <!-- Pagination links -->
        @endif

        <h2>Booking Ditolak</h2>
        @if($rejectedBookings->isEmpty())
            <p>Tidak ada booking ditolak untuk tanggal ini.</p>
        @else
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Cabang Klinik</th>
                        <th>Dokter</th>
                        <th>Layanan</th>
                        <th>Tanggal Booking</th>
                        <th>Waktu Booking</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rejectedBookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->nama_user }}</td>
                        <td>{{ $booking->email_user }}</td>
                        <td>{{ $booking->telepon_user }}</td>
                        <td>{{ $booking->cabangKlinik->nama_cabang }}</td>
                        <td>{{ $booking->dokterKlinik->nama_dokter }}</td>
                        <td>{{ $booking->layanans->nama_layanan }}</td>
                        <td>{{ $booking->tanggal_booking }}</td>
                        <td>{{ $booking->timeSlot->slot }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rejectedBookings->links() }} <!-- Pagination links -->
        @endif
    @endif
</div>

<!-- Chart.js -->
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const yearSelect = document.getElementById('year');
    const ctx = document.getElementById('bookingChartByServicePerMonth').getContext('2d');

    let chart;

    function fetchDataAndUpdateChart(year) {
        fetch(`{{ route('admin.bookings.data-by-service-per-month') }}?year=${year}`)
            .then(response => response.json())
            .then(data => {
                const datasets = data.map(service => ({
                    label: service.layanan,
                    data: service.data.map(entry => entry.count),
                    backgroundColor: getRandomColor()
                }));
                const labels = [...new Set(data.flatMap(service => service.data.map(entry => entry.month)))];

                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category'
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }

    yearSelect.addEventListener('change', function() {
        const year = yearSelect.value;
        fetchDataAndUpdateChart(year);
    });

    fetchDataAndUpdateChart(yearSelect.value);

    // Helper function to get random color for each dataset
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
});
</script> --}}

<!-- Chart Section -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const layananSelect = document.getElementById('layanan');
    const yearSelect = document.getElementById('year');
    const monthSelect = document.getElementById('month');
    const ctx = document.getElementById('bookingChart').getContext('2d');

    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    let chart;

    function fetchDataAndUpdateChart(layananId, year, month) {
        fetch(`{{ route('admin.bookings.data') }}?layanan_id=${layananId}&year=${year}&month=${month}`)
            .then(response => response.json())
            .then(data => {
                const labels = month ? [monthNames[month - 1]] : monthNames;
                const datasets = data.map(service => ({
                    label: service.layanan,
                    data: labels.map(label => {
                        const entry = service.data.find(d => monthNames[new Date(d.period + '-01').getMonth()] === label);
                        return entry ? entry.count : 0;
                    }),
                    backgroundColor: getRandomColor()
                }));

                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category'
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }

    layananSelect.addEventListener('change', function() {
        fetchDataAndUpdateChart(layananSelect.value, yearSelect.value, monthSelect.value);
    });

    yearSelect.addEventListener('change', function() {
        fetchDataAndUpdateChart(layananSelect.value, yearSelect.value, monthSelect.value);
    });

    monthSelect.addEventListener('change', function() {
        fetchDataAndUpdateChart(layananSelect.value, yearSelect.value, monthSelect.value);
    });

    fetchDataAndUpdateChart(layananSelect.value, yearSelect.value, monthSelect.value);

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
});
</script>
@endsection
