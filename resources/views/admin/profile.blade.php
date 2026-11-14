@php
    $profile = $data['profile'];
    $profileFields = [
        'name'        => ['Nama lengkap', 'text'],
        'headline'    => ['Headline / profesi', 'text'],
        'class'       => ['Kelas', 'text'],
        'school'      => ['Sekolah', 'text'],
        'competency'  => ['Kompetensi keahlian', 'text'],
        'tagline'     => ['Deskripsi singkat / personal branding', 'textarea'],
        'main_skills' => ['Keahlian utama (pisahkan dengan koma)', 'text'],
        'birth'       => ['Tempat, tanggal lahir', 'text'],
        'address'     => ['Alamat', 'text'],
        'tech_fields' => ['Bidang teknologi yang dikuasai (pisahkan dengan koma)', 'text'],
        'career_goal' => ['Cita-cita / tujuan karir', 'textarea'],
    ];
@endphp

<div id="profile">
    <div class="section">
        <h2>Foto Profil</h2>
        <div class="profile-section">
            <div class="profile-current">
                @if(!empty($data['profile_photo']))
                    <img src="/uploads/{{ $data['profile_photo'] }}" alt="Foto profil">
                @else
                    <div class="no-photo">No Photo</div>
                @endif
            </div>
            <div class="profile-form">
                <form method="POST" action="{{ route('admin.photo') }}" enctype="multipart/form-data">
                    @csrf
                    <label>Upload Foto Baru</label>
                    <input type="file" name="photo" accept="image/*">
                    @if(!empty($data['profile_photo']))
                        <label class="delete-img-row"><input type="checkbox" name="delete_photo" value="1"> Hapus foto sekarang</label>
                    @endif
                    <button type="submit" class="btn btn-green">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Informasi Profil</h2>
        <form method="POST" action="{{ route('admin.profile') }}">
            @csrf
            @foreach($profileFields as $name => [$label, $type])
                <label>{{ $label }}</label>
                @if($type === 'textarea')
                    <textarea name="{{ $name }}">{{ $profile[$name] ?? '' }}</textarea>
                @else
                    <input type="text" name="{{ $name }}" value="{{ $profile[$name] ?? '' }}" @if($name === 'name') required @endif>
                @endif
            @endforeach
            <button type="submit" class="btn btn-green">Simpan</button>
        </form>
    </div>

    <div class="section">
        <h2>About Me</h2>
        <form method="POST" action="{{ route('admin.about') }}">
            @csrf
            <label>Teks About</label>
            <textarea name="about">{{ $data['about'] ?? '' }}</textarea>
            <button type="submit" class="btn btn-green">Simpan</button>
        </form>
    </div>

    <div class="section">
        <h2>Kontak & Social Media</h2>
        <form method="POST" action="{{ route('admin.socials') }}">
            @csrf
            @foreach(['email' => 'Email', 'github' => 'Link GitHub', 'instagram' => 'Link Instagram', 'linkedin' => 'Link LinkedIn'] as $name => $label)
                <label>{{ $label }}</label>
                <input type="text" name="{{ $name }}" value="{{ $data['socials'][$name] ?? '' }}">
            @endforeach
            <button type="submit" class="btn btn-green">Simpan</button>
        </form>
    </div>

    <div class="section">
        <h2>File CV (PDF)</h2>
        @if(!empty($data['cv_file']))
            <p class="hint">CV saat ini: <a href="/uploads/{{ $data['cv_file'] }}" target="_blank">{{ $data['cv_file'] }}</a></p>
        @endif
        <form method="POST" action="{{ route('admin.cv') }}" enctype="multipart/form-data">
            @csrf
            <label>Upload CV baru (PDF, maks. 5 MB)</label>
            <input type="file" name="cv" accept="application/pdf" required>
            <button type="submit" class="btn btn-green">Upload</button>
        </form>
        @if(!empty($data['cv_file']))
            <form method="POST" action="{{ route('admin.cv') }}" onsubmit="return confirm('Hapus file CV?')" style="margin-top:10px">
                @csrf
                <input type="hidden" name="delete_cv" value="1">
                <button type="submit" class="btn btn-red">Hapus file CV</button>
            </form>
        @endif
    </div>
</div>
