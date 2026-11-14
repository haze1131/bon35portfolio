@php
    $profile = $data['profile'];
    $classLine = collect([$profile['class'], $profile['competency'], $profile['school']])->filter()->implode(' · ');
@endphp
<div data-aos="fade-up" class="section s01" id="home">
    <section class="row2">
        <div data-aos="fade-up" class="boxD">
            <h2>Hello! I'm</h2>
            <h1 class="namaGweh">{{ $profile['name'] }}</h1>
            @if($profile['headline'])
                <div class="secondaryColoredBox"><h3>{{ $profile['headline'] }}</h3></div>
            @endif
            @if($classLine)<p class="classLine">{{ $classLine }}</p>@endif
            @if($profile['tagline'])<p>{{ $profile['tagline'] }}</p>@endif

            @if($mainSkills)
                <div class="chips" aria-label="Keahlian utama">
                    @foreach($mainSkills as $skill)<span class="chip static">{{ $skill }}</span>@endforeach
                </div>
            @endif

            <div class="btnRow">
                <a href="#project" class="btn">Lihat Portfolio</a>
                <a href="#cv" class="btn ghost">Lihat CV</a>
                <a href="#contact" class="btn ghost">Hubungi Saya</a>
            </div>
        </div>
        <div data-aos="fade-up" class="boxD centeredDiv">
            @if(!empty($data['profile_photo']))
                <img src="/uploads/{{ $data['profile_photo'] }}" class="profilePhoto" alt="Foto {{ $profile['name'] }}">
            @else
                <div class="avatarFallback" aria-hidden="true">{{ mb_strtoupper(mb_substr($profile['name'], 0, 1)) }}</div>
            @endif
        </div>
    </section>
</div>
