@extends('welcome')

@section('title', 'Booking Klinik')

@section('content')
{{-- Section Booking --}}
<section class="booking-section">
    {{-- booking header --}}
    <div class="header-booking">
        <h1><span>Booking Klinik</span> <br>Anda Sekarang!</h1>
    </div>
    {{-- form booking --}}
    <div class="container booking-form-container">
        <div class="row justify-content-center">
            <!-- Kolom Kanan (Formulir Booking) -->
            <div class="col-md-12">
                <form class="booking-form" action="{{ route('submitBooking') }}" method="POST">
                    <!-- CSRF Token -->
                    @csrf
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama Lengkap <span style="color: rgb(255, 49, 49)">*</span></label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email_user" class="form-label">Alamat Email <span style="color: rgb(255, 49, 49)">*</span></label>
                        <p style="color: rgb(255, 119, 119); font-size: 12px">* Mohon untuk masukkan email yang aktif untuk mendapatkan konfirmasi booking anda!</p>
                        <input type="email" class="form-control" id="email_user" placeholder="contoh: user@gmail.com" name="email_user" required>
                    </div>
                    <!-- Nomor Telepon -->
                    <div class="mb-3">
                        <label for="telepon_user" class="form-label">Nomor Telepon <span style="color: rgb(255, 49, 49)">*</span></label>
                        <p style="color: rgb(255, 119, 119); font-size: 12px">* Masukkan nomor whatsapp aktif (08XX)</p>
                        <input type="tel" class="form-control" id="telepon_user" placeholder="contoh: 08XX-XXXX-XXXX" name="telepon_user" required>
                    </div>
                    <!-- Informasi Cabang Klinik -->
                    <div class="mb-3">
                        <label for="cabang_klinik" class="form-label">Cabang PetClinic <span style="color: rgb(255, 49, 49)">*</span></label>
                        <select class="form-select" id="cabang_klinik" name="cabang_klinik" required>
                            <option value="">Pilih Cabang Klinik</option>
                            @foreach($cabangs as $cabang)
                                <option value="{{ $cabang->id_cabang_klinik }}">{{ $cabang->nama_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Informasi Dokter -->
                    <div class="mb-3">
                        <label for="dokter_klinik" class="form-label">Dokter PetClinic <span style="color: rgb(255, 49, 49)">*</span></label>
                        <select class="form-select" id="dokter_klinik" name="dokter_klinik" required>
                            <option value="">Pilih Dokter</option>
                        </select>
                    </div>
                    <!-- Layanan -->
                    <div class="mb-3">
                        <label for="layanans" class="form-label">Layanan yang Dipilih <span style="color: rgb(255, 49, 49)">*</span></label>
                        <select class="form-select" id="layanans" name="layanans" required>
                            <option value="">Pilih Layanan</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id_layanan }}">{{ $layanan->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Informasi Pembayaran -->
                    {{-- <div class="mb-3 pembayaran-info-form">
                        <label for="pembayaran-name" class="form-label">Pembayaran</label>
                        <input type="text" class="form-control" id="pembayaran-name" value="Di tempat" readonly style="font-weight: bolder">
                    </div> --}}
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal_booking" class="form-label">Tanggal Booking <span style="color: rgb(255, 49, 49)">*</span></label>
                        <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <!-- Waktu -->
                    <div class="mb-3">
                        <label for="time_slot_id">Pilih Slot Waktu</label>
                        <p style="color: rgb(255, 119, 119); font-size: 12px">* Satu slot waktu untuk 1 hewan, jika anda ingin melakukan booking untuk 2 hewan maka lakukan 2x booking sesuai dengan waktu yang tersedia!</p>
                        <select name="slots" id="time_slot_id" class="form-control">
                            <option value="">Pilih Waktu</option>
                            <!-- Slot waktu akan diisi oleh JavaScript -->
                        </select>
                    </div>
                    <!-- Catatan -->
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan Tambahan <span style="color: rgb(252, 249, 249)">(Opsional)</span></label>
                        <textarea class="form-control" id="catatan" placeholder="Tambahkan jika diperlukan..." name="catatan" rows="3"></textarea>
                    </div>
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <!-- Pesan Sukses dan Error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>




{{-- popup submit booking klinik --}}
{{-- <section class="popup-booking" id="popupBooking">
    <div class="booking-card">
        <div class="card_detail" id="bookingCardDetail">
            <h1 id="h3contentBooking">Booking berhasil!</h1>
            <p>Booking anda akan di segera proses. <br>Harap cek email Anda untuk <span style="color: #153243; font-weight: bolder">Informasi Konfirmasi Booking.</span><br>Kami akan segera mengirimkan detail lebih lanjut!</p>
        </div>
        <div class="detail_btn">
            <a href="#" class="btn">Tutup</a>
        </div>
    </div>
</section> --}}


{{-- JS untuk memilih dokter berdasarkan cabang klinik --}}
<script>
    document.getElementById('cabang_klinik').addEventListener('change', function() {
        var idCabang = this.value;
        console.log('Cabang klinik dipilih:', idCabang); // Debugging

        if (idCabang) {
            fetch('/get-dokters/' + idCabang)
                .then(response => {
                    console.log('Status response:', response.status); // Debugging
                    return response.json();
                })
                .then(data => {
                    console.log('Data diterima:', data); // Debugging
                    var dokterSelect = document.getElementById('dokter_klinik');
                    dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>'; // Reset options

                    data.forEach(function(dokter) {
                        var option = document.createElement('option');
                        option.value = dokter.id_dokter;
                        option.text = dokter.nama_dokter;
                        dokterSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error); // Debugging
                });
        } else {
            document.getElementById('dokter_klinik').innerHTML = '<option value="">Pilih Dokter</option>'; // Reset options
        }
    });
</script>

{{-- JS agar slot waktu tidak dobel --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layananSelect = document.getElementById('layanans');
        const tanggalInput = document.getElementById('tanggal_booking');
        const timeSlotSelect = document.getElementById('time_slot_id');

        function fetchAvailableTimeSlots() {
            const layananId = layananSelect.value;
            const tanggalBooking = tanggalInput.value;

            if (layananId && tanggalBooking) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `/available-time-slots?tanggal_booking=${tanggalBooking}&id_layanan=${layananId}`, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const slots = JSON.parse(xhr.responseText);
                        console.log('Received slots:', slots); // Debugging
                        timeSlotSelect.innerHTML = '';
                        if (slots.length > 0) {
                            slots.forEach(slot => {
                                const option = document.createElement('option');
                                option.value = slot.id;
                                option.textContent = slot.slot;
                                timeSlotSelect.appendChild(option);
                            });
                        } else {
                            const option = document.createElement('option');
                            option.value = '';
                            option.textContent = 'Tidak ada slot waktu tersedia';
                            timeSlotSelect.appendChild(option);
                        }
                    }
                };
                xhr.send();
            }
        }

        layananSelect.addEventListener('change', fetchAvailableTimeSlots);
        tanggalInput.addEventListener('change', fetchAvailableTimeSlots);
    });
</script>



@endsection
