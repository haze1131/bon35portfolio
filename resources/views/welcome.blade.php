<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $data['profile']['name'] }} | Portfolio</title>
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <script>
        /* Terapkan tema tersimpan sebelum halaman tampil (hindari kedip) */
        try { document.documentElement.dataset.theme = localStorage.getItem('theme') || 'dark'; } catch (e) {}
    </script>
    <link rel="stylesheet" href="/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gasoek+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>
<body>
    <div class="pageCurtain" id="pageCurtain" aria-hidden="true"></div>

    @include('portfolio.header')

    <main class="body">
        @include('portfolio.home')
        @include('portfolio.about')
        @include('portfolio.skills')
        @include('portfolio.interests')
        @include('portfolio.projects')
        @include('portfolio.experience')
        @include('portfolio.certificates')
        @include('portfolio.cv')
        @include('portfolio.blog')
        @include('portfolio.testimonials')
        @include('portfolio.feedback')
    </main>

    @include('portfolio.footer')

    <button type="button" class="backToTop" id="backToTop" aria-label="Kembali ke atas">↑</button>

    <dialog id="projectModal">
        <div class="modalBox">
            <button type="button" class="modalClose" aria-label="Tutup">✕</button>
            <div class="modalContent"></div>
        </div>
    </dialog>
    <dialog id="lightbox" class="lightbox"><img src="" alt=""></dialog>

    <script>window.PROJECTS = @json($projects);</script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/app.js"></script>
</body>
</html>
