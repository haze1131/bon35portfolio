<div data-aos="fade-up" class="section s09" id="testimonials">
    <section data-filter>
        <h1>Testimonials</h1>

        @if(count($testimonialTypes) > 1)
            <div class="filterBar">
                <button type="button" class="chip active" data-tag="">Semua</button>
                @foreach($testimonialTypes as $type)<button type="button" class="chip" data-tag="{{ $type }}">{{ $type }}</button>@endforeach
            </div>
        @endif

        <div class="flexWrap cardGrid">
            @forelse($data['testimonials'] as $item)
                <div class="card filterItem" data-aos="fade-up" data-search="" data-tags="{{ $item['category'] ?? '' }}">
                    @if(!empty($item['category']))<span class="cardBadge">{{ $item['category'] }}</span>@endif
                    <p class="prewrap">“{{ $item['quote'] ?? '' }}”</p>
                    <h2>{{ $item['name'] ?? '' }}</h2>
                    @if(!empty($item['role']))<p><small>{{ $item['role'] }}</small></p>@endif
                    @if(!empty($item['video_url']))
                        <p><a href="{{ $item['video_url'] }}" target="_blank" rel="noopener noreferrer"><b>Tonton video</b></a></p>
                    @endif
                </div>
            @empty
                <p class="muted">No testimonials added yet.</p>
            @endforelse
        </div>
    </section>
</div>
