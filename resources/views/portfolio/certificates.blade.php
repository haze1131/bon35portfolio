<div data-aos="fade-up" class="section s07" id="certificate">
    <section>
        <h1>Certificates & Achievements</h1>
        <div data-aos="fade-up" class="flexWrap cardGrid">
            @forelse($data['certificates'] as $item)
                <div class="card">
                    @if(!empty($item['image']))
                        <img src="/uploads/{{ $item['image'] }}" alt="{{ $item['title'] ?? '' }}" data-lightbox>
                    @endif
                    @if(!empty($item['category']))<span class="cardBadge">{{ $item['category'] }}</span>@endif
                    <h2>{{ $item['title'] ?? '' }}</h2>
                    @if(!empty($item['issuer']))<p>{{ $item['issuer'] }}</p>@endif
                    @if(!empty($item['year']))<p><small>{{ $item['year'] }}</small></p>@endif
                    @if(!empty($item['desc']))<p class="prewrap">{{ $item['desc'] }}</p>@endif
                </div>
            @empty
                <p class="muted">No certificates added yet.</p>
            @endforelse
        </div>
    </section>
</div>
