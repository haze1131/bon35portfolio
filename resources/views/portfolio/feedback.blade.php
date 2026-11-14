<div data-aos="fade-up" class="section s11" id="feedback">
    <section>
        <h1>Kesan &amp; Pesan</h1>
        <p>Punya kesan atau pesan setelah melihat portfolio ini? Tinggalkan di sini.</p>

        <form class="formCard" method="POST" action="{{ route('feedback.send') }}">
            @csrf
            @if(session('feedback_status'))
                <div class="alert ok" role="status">{{ session('feedback_status') }}</div>
            @endif
            @if($errors->feedback->any())
                <div class="alert err" role="alert">
                    <ul>@foreach($errors->feedback->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="hp" aria-hidden="true">
                <label for="website">Jangan diisi</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <label for="fbName">Nama</label>
            <input type="text" id="fbName" name="name" value="{{ old('name') }}" maxlength="100" required>

            <label for="fbRelation">Sebagai (guru, teman, pengguna, dll.)</label>
            <input type="text" id="fbRelation" name="relation" value="{{ old('relation') }}" maxlength="100">

            <label for="fbEmail">Email (opsional)</label>
            <input type="email" id="fbEmail" name="email" value="{{ old('email') }}" maxlength="150">

            <label for="fbMessage">Kesan dan pesan</label>
            <textarea id="fbMessage" name="message" maxlength="2000" required>{{ old('message') }}</textarea>

            <button type="submit" class="btn">Kirim</button>
        </form>
    </section>
</div>
