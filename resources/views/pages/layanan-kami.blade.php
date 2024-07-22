@extends('welcome')

@section('title', 'Layanan Kami')

@section('content')
{{-- section layanan kami --}}
<section class="container-layanankami" style="width: 90%; margin: 50px auto auto auto">
    <h1>Layanan <span>Kami</span></h1>

    {{-- CARD Layanan Kami --}}
    <!-- Section 1 -->
    @foreach ($layanans as $key => $layanan)
        <section class="section d-flex align-items-center">
            <div class="row w-100">
                @if ($key % 2 == 0)
                <!-- Card 1 -->
                <div class="col-md-6 order-md-2 text-content" style="margin: auto auto;">
                    <h2 style="font-weight: bold; margin-bottom: 20px">{{ $layanan->nama_layanan }}</h2>
                    <h6 style="color: #153243; font-weight: bold">Kategori : {{ $layanan->kategori->nama_kategori }}</h6>
                    <p style="line-height: 2; text-align: justify; margin-top: 20px">{{ $layanan->deskripsi_layanan }}</p>
                </div>
                <div class="col-md-6 order-md-1">
                    @if($layanan->gambar_layanan)
                        <img src="{{ asset('images/' . $layanan->gambar_layanan) }}" alt="Gambar Layanan">
                    @else
                        <span>Tidak ada gambar</span>
                    @endif
                </div>
                @else

                <!-- Card 2 -->
                <div class="col-md-6 order-md-1 text-content" style="margin: auto auto;">
                    <h2 style="font-weight: bold; margin-bottom: 20px">{{ $layanan->nama_layanan }}</h2>
                    <h6 style="color: #153243; font-weight: bold">Kategori : {{ $layanan->kategori->nama_kategori }}</h6>
                    <p style="line-height: 2; text-align: justify; margin-top: 20px">{{ $layanan->deskripsi_layanan }}</p>
                </div>
                <div class="col-md-6 order-md-2">
                    @if($layanan->gambar_layanan)
                        <img src="{{ asset('images/' . $layanan->gambar_layanan) }}" alt="Gambar Layanan">
                    @else
                        <span>Tidak ada gambar</span>
                    @endif
                </div>
                @endif
            </div>
        </section>
    @endforeach
</section>

    {{-- <!-- Section 2 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-1 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">USG</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Layanan USG di Jilow Petclinic dilengkapi dengan teknologi ultrasonografi canggih yang memungkinkan pemeriksaan internal yang mendetail dan non-invasif untuk hewan peliharaan Anda. USG sangat berguna untuk mendiagnosis berbagai kondisi medis seperti kehamilan, penyakit organ dalam, tumor, dan kelainan lainnya. Dengan gambar yang jelas dan akurat, dokter hewan kami dapat membuat keputusan yang lebih tepat tentang perawatan yang dibutuhkan. Layanan ini juga membantu dalam pemantauan kehamilan hewan peliharaan, memberikan pemilik informasi penting tentang perkembangan janin dan kondisi kesehatan ibu.</p>
            </div>
            <div class="col-md-6 order-md-2">
                <img src="images/layanan-kami/usg-2.png" alt="Gambar Layanan 2">
            </div>
        </div>
    </section>

    <!-- Section 3 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-2 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">Dental Scaling</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Kesehatan gigi dan mulut hewan peliharaan sangat penting untuk kesejahteraan mereka secara keseluruhan, dan Jilow Petclinic menawarkan layanan dental scaling untuk menjaga kebersihan mulut mereka. Prosedur ini melibatkan penghilangan plak dan karang gigi yang dapat menyebabkan penyakit periodontal dan infeksi mulut. Kami menggunakan peralatan modern dan teknik yang aman untuk memastikan gigi hewan peliharaan Anda bersih dan bebas dari masalah. Selain itu, layanan ini juga membantu mengurangi bau mulut dan memperpanjang umur gigi, sehingga hewan peliharaan Anda dapat makan dan bermain dengan nyaman.</p>
            </div>
            <div class="col-md-6 order-md-1">
                <img src="images/layanan-kami/dental-scaling2.png" alt="Gambar Layanan 3">
            </div>
        </div>
    </section>

    <!-- Section 4 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-1 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">Pet ICU</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Di Jilow Petclinic, kami memahami bahwa beberapa kondisi kesehatan memerlukan perawatan intensif dan pengawasan ketat. Oleh karena itu, kami menyediakan fasilitas Pet ICU yang dilengkapi dengan peralatan medis canggih dan staf medis yang terlatih. Layanan ini ditujukan untuk hewan peliharaan dalam kondisi kritis yang memerlukan pengawasan 24/7, perawatan intensif, dan intervensi medis segera. Dengan pendekatan yang penuh perhatian dan profesional, kami berkomitmen untuk memberikan setiap hewan kesempatan terbaik untuk pulih dan kembali ke kondisi sehat mereka.</p>
            </div>
            <div class="col-md-6 order-md-2">
                <img src="images/layanan-kami/pet-icu2.png" alt="Gambar Layanan 4">
            </div>
        </div>
    </section>

    <!-- Section 5 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-2 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">Rawat Inap</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Ketika hewan peliharaan Anda memerlukan perawatan medis yang lebih mendalam atau pemulihan pasca operasi, layanan rawat inap di Jilow Petclinic adalah solusi yang ideal. Kami menawarkan fasilitas yang nyaman dan bersih, serta pemantauan oleh tim medis yang berdedikasi untuk memastikan proses pemulihan berjalan lancar. Selama masa rawat inap, hewan peliharaan Anda akan mendapatkan perawatan medis yang diperlukan, termasuk pemberian obat, terapi, dan observasi rutin untuk memastikan mereka dalam kondisi terbaik. Kami juga memberikan update berkala kepada pemilik hewan peliharaan tentang kondisi mereka, sehingga Anda dapat merasa tenang dan percaya bahwa mereka dalam tangan yang baik.</p>
            </div>
            <div class="col-md-6 order-md-1">
                <img src="images/layanan-kami/rawat-inap2.png" alt="Gambar Layanan 4">
            </div>
        </div>
    </section>

    <!-- Section 6 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-1 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">Home Visit</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Untuk kenyamanan Anda dan mengurangi stres pada hewan peliharaan, Jilow Petclinic menawarkan layanan home visit. Dokter hewan kami akan datang langsung ke rumah Anda untuk melakukan berbagai layanan kesehatan seperti pemeriksaan rutin, vaksinasi, dan perawatan medis lainnya. Layanan ini sangat ideal bagi hewan peliharaan yang mudah stres saat bepergian atau bagi pemilik yang memiliki jadwal padat. Dengan home visit, hewan peliharaan Anda dapat menerima perawatan yang mereka butuhkan dalam lingkungan yang familiar dan nyaman, menjamin mereka tetap tenang dan kooperatif selama prosedur berlangsung.</p>
            </div>
            <div class="col-md-6 order-md-2">
                <img src="images/layanan-kami/home-visit2.png" alt="Gambar Layanan 4">
            </div>
        </div>
    </section>

    <!-- Section 7 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-2 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">Grooming</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Layanan grooming di Jilow Petclinic mencakup perawatan menyeluruh untuk menjaga kebersihan dan kesehatan hewan peliharaan Anda. Dari perawatan bulu seperti mencuci dan mengeringkan, pemotongan bulu, hingga perawatan kuku dan telinga, kami memastikan setiap aspek perawatan terpenuhi. Kami menggunakan produk yang aman dan berkualitas tinggi untuk mencegah iritasi kulit dan alergi. Layanan grooming kami tidak hanya membuat hewan peliharaan Anda terlihat lebih rapi dan menarik, tetapi juga membantu mendeteksi masalah kesehatan kulit dan parasit lebih awal, sehingga dapat segera ditangani oleh tim medis kami.</p>
            </div>
            <div class="col-md-6 order-md-1">
                <img src="images/layanan-kami/grooming-2.png" alt="Gambar Layanan 4">
            </div>
        </div>
    </section>

    <!-- Section 8 -->
    <section class="section d-flex align-items-center">
        <div class="row w-100">
            <div class="col-md-6 order-md-1 text-content" style="margin: auto auto;">
                <h2 style="font-weight: bold">Penitipan Hewan</h2>
                <p style="line-height: 2; text-align: justify; margin-top: 20px">Jika Anda harus pergi dan tidak bisa membawa hewan peliharaan Anda, Jilow Petclinic menyediakan layanan penitipan hewan yang aman dan nyaman. Kami menawarkan lingkungan yang ramah dan penuh kasih sayang, di mana hewan peliharaan Anda akan mendapatkan perhatian dan perawatan yang mereka butuhkan. Dengan fasilitas yang lengkap, area bermain, dan makanan yang disesuaikan dengan kebutuhan mereka, hewan peliharaan Anda akan merasa seperti di rumah sendiri. Staf kami yang berpengalaman akan memastikan mereka mendapatkan aktivitas fisik yang cukup, interaksi sosial, dan pengawasan medis jika diperlukan, sehingga Anda bisa tenang meninggalkan mereka dalam pengawasan kami.</p>
            </div>
            <div class="col-md-6 order-md-2">
                <img src="images/layanan-kami/penitipan-hewan2.png" alt="Gambar Layanan 4">
            </div>
        </div>
    </section>
</section> --}}
@endsection
