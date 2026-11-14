<div data-aos="fade-up" class="section s05" id="project">
    <section data-filter>
        <h1>Projects</h1>

        <div class="filterBar">
            <input type="search" placeholder="Cari proyek..." aria-label="Cari proyek">
            @if($projectTags)
                <button type="button" class="chip active" data-tag="">Semua</button>
                @foreach($projectTags as $tag)<button type="button" class="chip" data-tag="{{ $tag }}">{{ $tag }}</button>@endforeach
            @endif
        </div>

        <div class="flexWrap">
            @foreach($projects as $project)
                <div class="card project filterItem" data-aos="fade-up"
                     data-search="{{ mb_strtolower($project['title'] . ' ' . $project['desc'] . ' ' . implode(' ', $project['tech'])) }}"
                     data-tags="{{ implode('|', $project['tech']) }}">
                    @if($project['image'])<img src="{{ $project['image'] }}" alt="{{ $project['title'] }}">@endif
                    <h2>{{ $project['title'] }}</h2>
                    @if($project['tech'])<p><small>{{ implode(' · ', $project['tech']) }}</small></p>@endif
                    <p>{{ \Illuminate\Support\Str::limit($project['desc'], 110) }}</p>
                    <div class="btnRow">
                        <button type="button" class="btn" data-preview="{{ $project['id'] }}">Preview</button>
                        @if($project['demo_url'])<a class="btn ghost" href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer">Demo</a>@endif
                        @if($project['source_url'])<a class="btn ghost" href="{{ $project['source_url'] }}" target="_blank" rel="noopener noreferrer">GitHub</a>@endif
                    </div>
                </div>
            @endforeach
        </div>
        <p class="filterEmpty muted" @if(count($projects)) hidden @endif>Tidak ada proyek yang cocok.</p>
    </section>
</div>
