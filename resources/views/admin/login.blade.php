<div class="login-wrap">
    <h1>Admin Log in</h1>
    @if(session('msg'))
        <div class="msg">{{ session('msg') }}</div>
    @endif
    @if(!empty($loginError))
        <div class="login-error">{{ $loginError }}</div>
    @endif
    <form method="POST" action="{{ route('admin') }}">
        @csrf
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autofocus required>
        <button type="submit" class="btn btn-green" style="width:100%">Masuk</button>
    </form>
</div>
