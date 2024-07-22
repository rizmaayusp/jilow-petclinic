@extends('auth.layouts.dashboard')
@section('title_page', 'Dashboard Admin')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="container-fluid" style="padding: 0 10px 0 10px">
    <!-- Section atas untuk Charts -->
    <div class="mt-12" style="max-width: 800px; max-height: 600px;">
        <canvas id="bookingChartByStatus"></canvas>
    </div>


    <!-- Section bawah untuk Tabel Booking -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 style="margin-top: 50px">Daftar Booking Terbaru</h2>
            <table id="bookingTable" class="table table-striped table-bordered" style="width:100%">
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
                        <th>Catatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
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
                        <td>{{ $booking->catatan }}</td>
                        <td style="color: red; font-weight:bolder">{{ $booking->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart 1: Perkembangan Booking per Hari
    // fetch('{{ route("admin.bookings.data-per-day") }}')
    //     .then(response => response.json())
    //     .then(data => {
    //         const labels = data.map(booking => booking.day);
    //         const counts = data.map(booking => booking.count);

    //         const ctx = document.getElementById('bookingChartPerDay').getContext('2d');
    //         new Chart(ctx, {
    //             type: 'line',
    //             data: {
    //                 labels: labels,
    //                 datasets: [{
    //                     label: 'Bookings per Day',
    //                     data: counts,
    //                     borderColor: 'rgba(75, 192, 192, 1)',
    //                     backgroundColor: 'rgba(75, 192, 192, 0.2)',
    //                     fill: true
    //                 }]
    //             },
    //             options: {
    //                 scales: {
    //                     x: {
    //                         type: 'time',
    //                         time: {
    //                             unit: 'day' // Ubah unit waktu ke 'day'
    //                         }
    //                     },
    //                     y: {
    //                         beginAtZero: true
    //                     }
    //                 }
    //             }
    //         });
    //     });


    // Chart 2: Jumlah Booking Berdasarkan Status
    fetch('{{ route("admin.bookings.data-by-status") }}')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(booking => booking.status);
            const counts = data.map(booking => booking.count);

            const ctx = document.getElementById('bookingChartByStatus').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Bookings by Status',
                        data: counts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
});
</script>

@endsection
