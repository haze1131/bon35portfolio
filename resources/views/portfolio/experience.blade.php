@php $groupTitles = ['PLK' => 'Pengalaman PLK', 'Organisasi' => 'Pengalaman Organisasi', 'Lomba' => 'Pengalaman Lomba', 'Lainnya' => 'Aktivitas Lainnya']; @endphp
<div data-aos="fade-up" class="section s06" id="experience">
    <section>
        <h1>Experience & Activities</h1>
        @php $hasAny = (bool) array_filter($experienceGroups); @endphp
        @foreach($groupTitles as $group => $title)
            @if($experienceGroups[$group])
                <div class="expGroup">
                    <h3 class="subTitle">{{ $title }}</h3>
                    <div data-aos="fade-up" class="column">
                        @foreach($experienceGroups[$group] as $item)
                            <div class="longCard">
                                <h3>{{ $item['title'] ?? '' }}</h3>
                                @if(!empty($item['period']))<p>{{ $item['period'] }}</p>@endif
                                @if(!empty($item['place']))<p>{{ $item['place'] }}</p>@endif
                                @if(!empty($item['desc']))<p class="prewrap">{{ $item['desc'] }}</p>@endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
        @unless($hasAny)<p class="muted">No experience added yet.</p>@endunless
    </section>
</div>
