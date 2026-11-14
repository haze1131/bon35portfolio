@php
    $profile = $data['profile'];
    $biodata = array_filter([
        'Nama lengkap'          => $profile['name'],
        'Tempat, tanggal lahir' => $profile['birth'],
        'Alamat'                => $profile['address'],
        'Sekolah'               => $profile['school'],
        'Kelas'                 => $profile['class'],
        'Kompetensi keahlian'   => $profile['competency'],
    ]);
    $interestTitles = array_filter(array_column($data['interests'], 'title'));
    $interestChips  = array_values(array_unique(array_merge($techFields, $interestTitles)));
@endphp
<div data-aos="fade-up" class="section s02" id="about">
    <section>
        <div class="row2">
            <div data-aos="fade-up" class="boxD">
                <img src="/assets/ask.svg" width="50%" alt="">
            </div>
            <div data-aos="fade-up" class="boxD">
                <h1>About Me</h1>
                <p class="prewrap">{{ $data['about'] }}</p>
            </div>
        </div>

        <div class="aboutGrid">
            <div class="aboutCard" data-aos="fade-up">
                <h3>Biodata Singkat</h3>
                <dl>
                    @foreach($biodata as $label => $value)
                        <dt>{{ $label }}</dt><dd>{{ $value }}</dd>
                    @endforeach
                </dl>
            </div>

            <div class="aboutCard" data-aos="fade-up">
                <h3>Riwayat Pendidikan</h3>
                @if($data['educations'])
                    <ul class="timeline">
                        @foreach($data['educations'] as $edu)
                            <li>
                                <b>{{ $edu['school'] ?? '' }}</b>
                                @if(!empty($edu['period']))<small>{{ $edu['period'] }}</small>@endif
                                @if(!empty($edu['desc']))<p class="prewrap">{{ $edu['desc'] }}</p>@endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="muted">Belum ada riwayat pendidikan.</p>
                @endif
            </div>

            <div class="aboutCard" data-aos="fade-up">
                <h3>Minat &amp; Bidang Teknologi</h3>
                @if($interestChips)
                    <div class="chips">@foreach($interestChips as $chip)<span class="chip static">{{ $chip }}</span>@endforeach</div>
                @else
                    <p class="muted">Belum diisi.</p>
                @endif
            </div>

            @foreach(['Organisasi' => 'Pengalaman Organisasi / Kepanitiaan', 'PLK' => 'Pengalaman PLK'] as $group => $title)
                <div class="aboutCard" data-aos="fade-up">
                    <h3>{{ $title }}</h3>
                    @forelse($experienceGroups[$group] as $item)
                        <p><b>{{ $item['title'] ?? '' }}</b>@if(!empty($item['place'])) — {{ $item['place'] }}@endif
                            @if(!empty($item['period']))<br><small class="muted">{{ $item['period'] }}</small>@endif</p>
                    @empty
                        <p class="muted">Belum ada data.</p>
                    @endforelse
                </div>
            @endforeach

            <div class="aboutCard" data-aos="fade-up">
                <h3>Cita-cita / Tujuan Karir</h3>
                @if($profile['career_goal'])
                    <p class="prewrap">{{ $profile['career_goal'] }}</p>
                @else
                    <p class="muted">Belum diisi.</p>
                @endif
            </div>
        </div>
    </section>
</div>
