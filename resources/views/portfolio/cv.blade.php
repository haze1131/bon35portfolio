@php
    $profile = $data['profile'];
    $contacts = collect($links)->map(fn ($l) => $l['label'] === 'Email' || str_contains($l['href'], 'mailto:') ? $l['label'] : $l['href'])->values();
@endphp
<div data-aos="fade-up" class="section s10" id="cv">
    <section>
        <h1>CV Digital</h1>
        <div class="btnRow">
            @if(!empty($data['cv_file']))
                <a class="btn" href="/uploads/{{ $data['cv_file'] }}" target="_blank" rel="noopener noreferrer" download>Unduh CV (PDF)</a>
            @endif
            <button type="button" class="btn ghost" id="printCv">Cetak / Simpan PDF</button>
        </div>

        <article class="cvSheet">
            <div class="cvHead">
                <h1>{{ $profile['name'] }}</h1>
                <p><b>{{ $profile['headline'] }}</b></p>
                <p>{{ collect([$profile['class'], $profile['competency'], $profile['school']])->filter()->implode(' · ') }}</p>
                <p>{{ $contacts->implode(' | ') }}</p>
            </div>

            @if($data['about'])
                <h2>Profil</h2>
                <p class="prewrap">{{ $data['about'] }}</p>
            @endif

            @if($data['educations'])
                <h2>Pendidikan</h2>
                @foreach($data['educations'] as $edu)
                    <h3>{{ $edu['school'] ?? '' }} <small>{{ $edu['period'] ?? '' }}</small></h3>
                    @if(!empty($edu['desc']))<p>{{ $edu['desc'] }}</p>@endif
                @endforeach
            @endif

            <div class="cvCols">
                @foreach(['hard' => 'Hard Skill', 'soft' => 'Soft Skill'] as $key => $title)
                    @if($skillGroups[$key])
                        <div>
                            <h2>{{ $title }}</h2>
                            <ul>@foreach($skillGroups[$key] as $skill)<li>{{ $skill['name'] }} — {{ $skill['level'] }}%</li>@endforeach</ul>
                        </div>
                    @endif
                @endforeach
            </div>

            @foreach(['PLK' => 'Pengalaman PLK', 'Organisasi' => 'Organisasi / Kepanitiaan', 'Lomba' => 'Lomba'] as $group => $title)
                @if($experienceGroups[$group])
                    <h2>{{ $title }}</h2>
                    @foreach($experienceGroups[$group] as $item)
                        <h3>{{ $item['title'] ?? '' }} <small>{{ $item['period'] ?? '' }}</small></h3>
                        @if(!empty($item['place']))<p>{{ $item['place'] }}</p>@endif
                        @if(!empty($item['desc']))<p>{{ $item['desc'] }}</p>@endif
                    @endforeach
                @endif
            @endforeach

            @if($data['certificates'])
                <h2>Sertifikat &amp; Prestasi</h2>
                <ul>
                    @foreach($data['certificates'] as $cert)
                        <li>{{ $cert['title'] ?? '' }}@if(!empty($cert['issuer'])) — {{ $cert['issuer'] }}@endif @if(!empty($cert['year']))({{ $cert['year'] }})@endif</li>
                    @endforeach
                </ul>
            @endif

            @if($projects)
                <h2>Proyek</h2>
                <ul>
                    @foreach($projects as $project)
                        <li>{{ $project['title'] }}@if($project['tech']) — {{ implode(', ', $project['tech']) }}@endif</li>
                    @endforeach
                </ul>
            @endif
        </article>
    </section>
</div>
