<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <link rel="stylesheet" href="/admin.css">
    <title>Admin Panel</title>
</head>
<body>

@if(!$loggedIn)
    @include('admin.login')
@else
    <div class="top-bar">
        <h1>Admin Panel</h1>
        <div class="top-bar-links">
            <a href="/" target="_blank">← Lihat Portfolio</a>
            <a href="{{ route('admin') }}?logout=1" class="logout">Logout</a>
        </div>
    </div>

    <nav class="admin-nav" aria-label="Menu admin">
        <a href="#profile">Profil</a>
        <a href="#messages">Pesan @if($unread = collect($messages)->where('read', false)->count())<span class="badge">{{ $unread }}</span>@endif</a>
        @foreach(config('portfolio.sections') as $slug => $cfg)
            <a href="#sec-{{ $slug }}">{{ $cfg['label'] }}</a>
        @endforeach
    </nav>

    @if(session('msg'))
        <div class="msg">✓ {{ session('msg') }}</div>
    @endif
    @if($errors->any())
        <div class="login-error">
            <strong>Periksa input berikut:</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    @include('admin.profile')
    @include('admin.messages')

    @foreach(config('portfolio.sections') as $slug => $cfg)
        @include('admin.section', ['slug' => $slug, 'cfg' => $cfg])
    @endforeach
@endif

</body>
</html>
