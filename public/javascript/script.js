// javascript slider layanan kami di tentang kami
$(document).ready(function () {
    function autoSlide() {
        $(".carousel").carousel("next");
    }

    $(".carousel")
        .on("mouseenter", function () {
            interval = setInterval(autoSlide, 2000); // Ganti slide setiap 2 detik
        })
        .on("mouseleave", function () {
            clearInterval(interval); // Hentikan auto-slide ketika mouse meninggalkan carousel
        });
});

// script untuk popup subscribe email
document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash === "#subscribe-section") {
        document.getElementById("subscribe-section").scrollIntoView();
    }

    if (document.querySelector("#popup")) {
        document.querySelector("#popup").style.display = "block";
    }
});

// script untuk memilih dokter klinik yg sesuai dengan daftar cabang
// Event listener untuk perubahan dropdown cabang klinik
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


