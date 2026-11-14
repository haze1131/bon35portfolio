<div data-aos="fade-up" class="section s03" id="skill">
    <section>
        <h1>Skills</h1>
        <div class="skillCols">
            @foreach(['hard' => 'Hard Skill (Teknis)', 'soft' => 'Soft Skill (Non-teknis)'] as $key => $title)
                <div>
                    <h3 class="subTitle">{{ $title }}</h3>
                    @forelse($skillGroups[$key] as $skill)
                        <div class="skillItem" data-aos="fade-up">
                            <div class="skillHead"><span>{{ $skill['name'] }}</span><span>{{ $skill['level'] }}%</span></div>
                            @if(!empty($skill['desc']))<small>{{ $skill['desc'] }}</small>@endif
                            <div class="bar" role="progressbar" aria-valuenow="{{ $skill['level'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $skill['name'] }}">
                                <span style="--level: {{ $skill['level'] }}%"></span>
                            </div>
                        </div>
                    @empty
                        <p class="muted">Belum ada skill.</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </section>
</div>
