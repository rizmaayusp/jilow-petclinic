@extends('auth.layouts.dashboard')
@section('title_page', 'Konfirmasi Booking')
@section('breadcrumb', 'Konfirmasi Booking')

@section('content')
<div class="container">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Button untuk Tambah Booking -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBookingModal">
        Tambah Booking
    </button>



    <h1>Daftar Booking</h1>

    <div class="row align-items-center">
        <div class="col-md-6">
            <!-- Filter Dropdown -->
            <form action="{{ route('bookings.filter') }}" method="GET" id="filterForm">
                <select name="status" id="statusFilter" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Semua Status</option>
                    <option value="PENDING">Pending</option>
                    <option value="DITERIMA">Diterima</option>
                    <option value="DITOLAK">Ditolak</option>
                </select>

                <select name="layanan_id" id="layananFilter" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Semua Layanan</option>
                    @foreach($layanans as $layanan)
                        <option value="{{ $layanan->id_layanan }}">{{ $layanan->nama_layanan }}</option>
                    @endforeach
                </select>

                <select name="sort" id="sortFilter" onchange="document.getElementById('filterForm').submit();">
                    <option value="desc">Terbaru</option>
                    <option value="asc">Terlama</option>
                </select>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route ('admin.bookings') }}" method="get">
                <div class="col-md-12 pb-0">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-search fa-xs opacity-7"></i>
                            </span>
                            <input type="text" class="form-control form-control-sm" name="search"
                                id="search" value="{{ request('search') }}" placeholder="Search...">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @if($bookings->isEmpty())
        <p>Tidak ada booking yang sesuai dengan filter yang dipilih.</p>
    @else
    <table class="table">
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}</td>
                <td>{{ $booking->nama_user }}</td>
                <td>{{ $booking->email_user }}</td>
                <td>{{ $booking->telepon_user }}</td>
                <td>{{ optional($booking->cabangKlinik)->nama_cabang }}</td>
                <td>{{ optional($booking->dokterKlinik)->nama_dokter }}</td>
                <td>{{ optional($booking->layanans)->nama_layanan }}</td>
                <td>{{ $booking->tanggal_booking }}</td>
                <td>{{ optional($booking->timeSlot)->slot }}</td>
                <td>{{ $booking->catatan }}</td>
                <td style="color: red; font-weight:bolder">{{ $booking->status }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBookingModal{{ $booking->id_booking }}">
                        <i class="fa fa-edit"></i>
                    </button>

                    <!-- Tombol Hapus -->
                    <button style="margin-left: 10px" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBookingModal{{ $booking->id_booking }}">
                        <i class="fa fa-trash"></i>
                    </button>

                    <!-- Tombol Konfirmasi -->
                    <button style="margin-top: 15px" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirmBookingModal{{ $booking->id_booking }}">
                        Konfirmasi
                    </button>
                </td>
            </tr>

            <!-- Modal Edit Booking -->
            <div class="modal fade" id="editBookingModal{{ $booking->id_booking }}" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.updateBooking', $booking->id_booking) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Form input untuk edit booking -->
                                <div class="form-group">
                                    <label for="nama_user">Nama User</label>
                                    <input type="text" id="nama_user" name="nama_user" class="form-control" value="{{ old('nama_user', $booking->nama_user) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email_user">Email User</label>
                                    <input type="email" id="email_user" name="email_user" class="form-control" value="{{ old('email_user', $booking->email_user) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="telepon_user">Telepon User</label>
                                    <input type="text" id="telepon_user" name="telepon_user" class="form-control" value="{{ old('telepon_user', $booking->telepon_user) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="layanans">Layanan</label>
                                    <select id="layanans" name="layanans" class="form-control" required>
                                        @foreach($layanans as $layanan)
                                            <option value="{{ $layanan->id_layanan }}">{{ $layanan->nama_layanan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_booking">Tanggal Booking</label>
                                    <input type="date" id="tanggal_booking" name="tanggal_booking" class="form-control" value="{{ old('tanggal_booking', \Carbon\Carbon::parse($booking->tanggal_booking)->format('Y-m-d')) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="slots">Waktu Booking</label>
                                    <select id="slots" name="slots" class="form-control" required>
                                        @foreach($timeSlots as $slot)
                                            <option value="{{ $slot->id }}" {{ $booking->slots == $slot->id ? 'selected' : '' }}>{{ $slot->slot }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan', $booking->catatan) }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal Hapus Booking -->
            <div class="modal fade" id="deleteBookingModal{{ $booking->id_booking }}" tabindex="-1" role="dialog" aria-labelledby="deleteBookingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteBookingModalLabel">Hapus Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.deleteBooking', $booking->id_booking) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus booking ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Booking -->
            <div class="modal fade" id="confirmBookingModal{{ $booking->id_booking }}" tabindex="-1" role="dialog" aria-labelledby="confirmBookingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmBookingModalLabel">Konfirmasi Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.updateStatus', $booking->id_booking) }}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id_booking }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option style="color: black; font-weight:bolder" value="PENDING" {{ $booking->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                        <option style="color: rgb(118, 198, 255); font-weight:bolder" value="DITERIMA" {{ $booking->status == 'DITERIMA' ? 'selected' : '' }}>DITERIMA</option>
                                        <option style="color: red; font-weight:bolder" value="DITOLAK" {{ $booking->status == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="note" class="form-label">Catatan Admin</label>
                                    <textarea class="form-control" id="note" name="note" rows="3">{{ $booking->admin_note }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    {{ $bookings->links() }}
    @endif
</div>

<!-- Modal Tambah Booking -->
<div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="addBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookingModalLabel">Tambah Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.addBooking') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form input untuk tambah booking -->
                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text" id="nama_user" name="nama_user" class="form-control" value="{{ old('nama_user') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email_user">Email User</label>
                        <input type="email" id="email_user" name="email_user" class="form-control" value="{{ old('email_user') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telepon_user">Telepon User</label>
                        <input type="text" id="telepon_user" name="telepon_user" class="form-control" value="{{ old('telepon_user') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="layanans">Layanan</label>
                        <select id="layanans" name="layanans" class="form-control" required>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id_layanan }}" {{ old('layanans') == $layanan->id_layanan ? 'selected' : '' }}>{{ $layanan->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_booking">Tanggal Booking</label>
                        <input type="date" id="tanggal_booking" name="tanggal_booking" class="form-control" value="{{ old('tanggal_booking', \Carbon\Carbon::parse($booking->tanggal_booking)->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="slots">Waktu Booking</label>
                        <select id="slots" name="slots" class="form-control" required>
                            @foreach($timeSlots as $slot)
                                <option value="{{ $slot->id }}" {{ old('slots') == $slot->id ? 'selected' : '' }}>{{ $slot->slot }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('statusFilter').value = "{{ request('status') }}";
    document.getElementById('layananFilter').value = "{{ request('layanan_id') }}";
    document.getElementById('sortFilter').value = "{{ request('sort', 'desc') }}";
</script>



@endsection
