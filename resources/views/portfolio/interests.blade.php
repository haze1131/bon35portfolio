<div data-aos="fade-up" class="section s04" id="interest">
    <section>
        <h1>Interest</h1>
        <div class="interestGrid">
            @foreach($data['interests'] as $interest)
                @php $bg = !empty($interest['image']) ? '/uploads/' . $interest['image'] : '/assets/interestImgPlaceholder.png'; @endphp
                <a href="{{ !empty($interest['link']) ? $interest['link'] : '#' }}" class="interestCard" style="background-image: url('{{ $bg }}')">
                    <div class="interestOverlay">
                        <div class="interestContent">
                            <h2 class="interestTitle">{{ $interest['title'] }}</h2>
                            <p class="interestDesc">{{ $interest['desc'] ?? '' }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>
