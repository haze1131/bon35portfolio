<header class="topbar">
    <div class="logo" data-aos="flip-left">
        <a href="{{ route('admin') }}" aria-label="Admin"><img src="/assets/logo.svg" width="36" height="36" alt="Logo"></a>
    </div>
    <div class="navWrap">
        <button type="button" class="navArrow" data-dir="-1" aria-label="Geser menu ke kiri">‹</button>
        <nav class="navScroll" id="navScroll" aria-label="Navigasi utama">
            <ul>
                @foreach($navItems as $id => $label)
                    <li><a href="#{{ $id }}">{{ $label }}</a></li>
                @endforeach
            </ul>
        </nav>
        <button type="button" class="navArrow" data-dir="1" aria-label="Geser menu ke kanan">›</button>
    </div>
    <button type="button" class="themeBtn" id="themeToggle" aria-label="Ganti tema">☀</button>
</header>
