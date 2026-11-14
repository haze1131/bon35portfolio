<div data-aos="fade-up" class="section s08" id="learning-log">
    <section data-filter>
        <h1>Blog / Catatan Ngoding</h1>

        <div class="filterBar">
            <input type="search" placeholder="Cari artikel..." aria-label="Cari artikel">
            @if(count($logCategories) > 1)
                <button type="button" class="chip active" data-tag="">Semua</button>
                @foreach($logCategories as $category)<button type="button" class="chip" data-tag="{{ $category }}">{{ $category }}</button>@endforeach
            @endif
        </div>

        <div class="flexWrap cardGrid">
            @forelse($data['learning_logs'] as $item)
                <article class="card filterItem" data-aos="fade-up"
                         data-search="{{ mb_strtolower(($item['title'] ?? '') . ' ' . ($item['excerpt'] ?? '') . ' ' . ($item['content'] ?? '')) }}"
                         data-tags="{{ $item['category'] ?? '' }}">
                    @if(!empty($item['image']))<img src="/uploads/{{ $item['image'] }}" alt="{{ $item['title'] ?? '' }}" data-lightbox>@endif
                    @if(!empty($item['category']))<span class="cardBadge">{{ $item['category'] }}</span>@endif
                    <h2>{{ $item['title'] ?? '' }}</h2>
                    @if(!empty($item['date']))<small>{{ $item['date'] }}</small>@endif
                    @if(!empty($item['excerpt']))<p>{{ $item['excerpt'] }}</p>@endif
                    @if(!empty($item['content']))
                        <details>
                            <summary>Baca selengkapnya</summary>
                            <p class="prewrap">{{ $item['content'] }}</p>
                        </details>
                    @endif
                </article>
            @empty
                <p class="muted">No articles added yet.</p>
            @endforelse
        </div>
        <p class="filterEmpty muted" hidden>Tidak ada artikel yang cocok.</p>
    </section>
</div>
