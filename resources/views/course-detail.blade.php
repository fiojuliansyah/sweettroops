@extends('layouts.guest')

{{-- Tambahkan section untuk custom CSS di head (jika layout Anda mendukungnya) --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    /* CSS untuk Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: none; /* Sembunyi secara default */
        justify-content: center;
        align-items: center;
        z-index: 1000;
        padding: 20px;
    }

    .modal-content {
        position: relative;
        padding: 20px;
        border-radius: 8px;
        max-width: 800px;
        width: 90%;
        max-height: 90vh;
    }

    .close-modal {
        position: absolute;
        top: -15px;
        right: -15px;
        color: white;
        background-color: #333;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        font-size: 24px;
        line-height: 35px;
        text-align: center;
        cursor: pointer;
        font-weight: bold;
    }

    /* Styling untuk Swiper di dalam modal */
    .swiper-container {
        width: 100%;
        height: auto;
    }

    .swiper-slide img {
        width: 100%;
        height: auto;
        object-fit: contain;
        max-height: 70vh; /* Batasi tinggi gambar agar pas di layar */
    }

    /* Mengubah warna panah navigasi Swiper */
    .swiper-button-next, .swiper-button-prev {
        color: #007bff; /* Ganti dengan warna tema Anda */
    }

    /* Cursor pointer untuk gambar trigger */
    #course-thumbnail {
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<section class="section-44">
    <div class="w-layout-blockcontainer container-43 w-container"><a href="{{ route('courses') }}"
            class="button-4 w-button">&lt; BACK</a></div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        <h1 class="heading-21">{{ $course->title }}</h1>
        @php
            // Pastikan thumbnail adalah array, jika tidak, buat array kosong
            $thumbnails = json_decode($course->thumbnail, true);
            if (!is_array($thumbnails)) {
                $thumbnails = [];
            }
            
            // Tentukan gambar utama
            $firstThumbnail = !empty($thumbnails)
                ? $thumbnails[0]
                : 'https://cdn.prod.website-files.com/6863dbc5c3cb25eebe6ab6ce/68666cf3de7c05db6b6a495a_Blackforest%20PC.png';
        @endphp

        {{-- Gambar utama yang akan menjadi trigger untuk membuka modal --}}
        <img src="{{ asset('storage/' . $firstThumbnail) }}" width="479px" loading="lazy" id="course-thumbnail" alt="{{ $course->title }}">
    </div>
</section>
<section class="section-44">
    <section class="section-44">
    <div class="w-layout-blockcontainer container-42 w-container">
        <a href="javascript:void(0)"
           class="button-5 w-button buy-course"
           data-course-id="{{ $course->id }}">ENROLL</a>
    </div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        <div class="div-block-37">
            <div class="text-block-21">DIFFICULTY:</div>
            <div class="text-block-21">PRICE:</div>
            <div class="text-block-21">CATEGORY:</div>
            <div class="text-block-22">Beginner</div>
            <div class="text-block-22">Rp. {{ number_format($course->price) }}</div>
            <div class="text-block-22">{{ $course->category->name }}</div>
        </div>
    </div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        <div class="rich-text-block-3 w-richtext">
            {!! $course->description !!}
        </div>
    </div>
</section>

<div id="image-slider-modal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" id="close-modal-btn">&times;</span>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @if(!empty($thumbnails))
                    @foreach($thumbnails as $thumbnail)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $thumbnail) }}" alt="Course image">
                        </div>
                    @endforeach
                @else
                    {{-- Tampilkan gambar default jika tidak ada thumbnail sama sekali --}}
                    <div class="swiper-slide">
                        <img src="{{ $firstThumbnail }}" alt="Default course image">
                    </div>
                @endif
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ config('midtrans.base_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.querySelectorAll('.buy-course').forEach(button => {
        button.addEventListener('click', function () {
            let courseId = this.getAttribute('data-course-id');

            fetch(`{{ url('/troopers/buy-course/') }}/${courseId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    snap.pay(data.snapToken);
                } else {
                    alert('Payment error');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Swiper
        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            loop: true, // Agar slider bisa berputar terus
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Ambil elemen-elemen yang dibutuhkan
        const modal = document.getElementById('image-slider-modal');
        const openBtn = document.getElementById('course-thumbnail');
        const closeBtn = document.getElementById('close-modal-btn');

        // Fungsi untuk membuka modal
        function openModal() {
            modal.style.display = 'flex'; // Tampilkan modal
            swiper.update(); // Update swiper untuk memastikan ukurannya benar
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            modal.style.display = 'none'; // Sembunyikan modal
        }

        // Tambahkan event listener
        if(openBtn) {
            openBtn.addEventListener('click', openModal);
        }
        
        if(closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        // Tutup modal jika user mengklik di luar area konten modal
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    });
</script>
@endpush