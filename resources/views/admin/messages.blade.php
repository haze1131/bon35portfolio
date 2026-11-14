<div class="section" id="messages">
    <h2>Pesan Masuk (Kesan & Pesan)</h2>
    @forelse($messages as $message)
        <div class="item-row">
            <div class="message-box {{ empty($message['read']) ? 'unread' : '' }}">
                <div class="message-head">
                    <b>{{ $message['name'] ?? '' }}</b>
                    @if(!empty($message['relation']))<span class="hint">({{ $message['relation'] }})</span>@endif
                    <span class="hint">{{ $message['created_at'] ?? '' }}</span>
                </div>
                @if(!empty($message['email']))<div class="hint">{{ $message['email'] }}</div>@endif
                <p>{{ $message['message'] ?? '' }}</p>
            </div>
            <div class="action-btns">
                @if(empty($message['read']))
                    <form method="POST" action="{{ route('admin.message.read') }}">
                        @csrf <input type="hidden" name="id" value="{{ $message['id'] }}">
                        <button class="btn btn-yellow">Tandai dibaca</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('admin.message.delete') }}" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf <input type="hidden" name="id" value="{{ $message['id'] }}">
                    <button class="btn btn-red">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="hint">Belum ada pesan masuk.</p>
    @endforelse
</div>
