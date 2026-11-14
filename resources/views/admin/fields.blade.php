{{-- Field form generik. Variabel: $slug, $cfg, $item (array kosong untuk form tambah) --}}
@foreach($cfg['fields'] as $name => $field)
    @php
        $value = $item[$name] ?? ($field['default'] ?? '');
        $required = str_contains($field['rules'], 'required');
        $listId = !empty($field['suggest']) ? 'dl-' . $slug . '-' . $name : null;
    @endphp
    <label>{{ $field['label'] }}</label>
    @if($field['type'] === 'textarea')
        <textarea name="{{ $name }}" placeholder="{{ $field['placeholder'] ?? '' }}" @if($required) required @endif>{{ $value }}</textarea>
    @elseif($field['type'] === 'select')
        <select name="{{ $name }}">
            @foreach($field['options'] as $optValue => $optLabel)
                <option value="{{ $optValue }}" @selected((string) $value === (string) $optValue)>{{ $optLabel }}</option>
            @endforeach
        </select>
    @else
        <input type="{{ $field['type'] }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $field['placeholder'] ?? '' }}"
               @foreach(($field['attr'] ?? []) as $attr => $attrValue) {{ $attr }}="{{ $attrValue }}" @endforeach
               @if($listId) list="{{ $listId }}" @endif
               @if($required) required @endif>
        @if($listId)
            <datalist id="{{ $listId }}">@foreach($field['suggest'] as $option)<option value="{{ $option }}">@endforeach</datalist>
        @endif
    @endif
@endforeach

@if(!empty($cfg['image']))
    @php $imageField = $cfg['image']; @endphp
    @if(!empty($item[$imageField]))
        <img class="img-preview" src="/uploads/{{ $item[$imageField] }}" alt="">
        <label class="delete-img-row"><input type="checkbox" name="delete_image" value="1"> Hapus gambar sekarang</label>
    @endif
    <label>{{ empty($item[$imageField]) ? 'Upload gambar' : 'Ganti gambar' }}</label>
    <input type="file" name="{{ $imageField }}" accept="image/*">
@endif

@if(!empty($cfg['gallery']))
    @php $galleryField = $cfg['gallery']; @endphp
    @if(!empty($item[$galleryField]))
        <label>Dokumentasi saat ini (centang untuk menghapus)</label>
        <div class="gallery-edit">
            @foreach($item[$galleryField] as $file)
                <label class="gallery-thumb">
                    <img src="/uploads/{{ $file }}" alt="">
                    <input type="checkbox" name="remove_{{ $galleryField }}[]" value="{{ $file }}"> hapus
                </label>
            @endforeach
        </div>
    @endif
    <label>Tambah foto dokumentasi proses (bisa lebih dari satu)</label>
    <input type="file" name="{{ $galleryField }}[]" accept="image/*" multiple>
@endif
