{{-- CRUD generik satu section. Variabel: $slug, $cfg (dari config/portfolio.php) --}}
@php
    $items = $data[$cfg['key']] ?? [];
    $imageField = $cfg['image'] ?? null;
@endphp
<div class="section" id="sec-{{ $slug }}">
    <h2>{{ $cfg['label'] }} <span class="count">{{ count($items) }}</span></h2>

    @forelse($items as $item)
        <div class="item-row">
            <details>
                <summary>
                    @if($imageField && !empty($item[$imageField]))<img class="thumb" src="/uploads/{{ $item[$imageField] }}" alt="">@endif
                    <span class="item-title">{{ $item[$cfg['title']] ?? '' }}</span>
                    @foreach($cfg['meta'] as $metaField)
                        @php
                            $field = $cfg['fields'][$metaField];
                            $metaValue = $item[$metaField] ?? '';
                            if (!empty($field['options'])) $metaValue = $field['options'][$metaValue] ?? $metaValue;
                            if ($metaField === 'level') $metaValue .= '%';
                        @endphp
                        @if($metaValue !== '' && $metaValue !== '%')<small class="meta">{{ \Illuminate\Support\Str::limit((string) $metaValue, 50) }}</small>@endif
                    @endforeach
                </summary>
                <form method="POST" action="{{ route('admin.' . $slug . '.edit') }}" enctype="multipart/form-data" class="add-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    @include('admin.fields')
                    <button type="submit" class="btn btn-green">Simpan perubahan</button>
                </form>
            </details>
            <form method="POST" action="{{ route('admin.' . $slug . '.delete') }}" onsubmit="return confirm('Hapus data ini?')">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="btn btn-red">Hapus</button>
            </form>
        </div>
    @empty
        <p class="hint">Belum ada data.</p>
    @endforelse

    <div class="add-form">
        <b>Tambah {{ $cfg['item'] }}</b>
        <form method="POST" action="{{ route('admin.' . $slug . '.add') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.fields', ['item' => []])
            <button type="submit" class="btn btn-green">Tambah</button>
        </form>
    </div>
</div>
