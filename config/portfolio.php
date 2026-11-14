<?php

/**
 * Konfigurasi portfolio.
 *
 * - admin_password : password login /admin (bisa diganti lewat .env: PORTFOLIO_ADMIN_PASSWORD)
 * - defaults       : nilai bawaan data.json (dipakai bila key belum ada)
 * - sections       : definisi CRUD generik untuk dashboard admin.
 *                    Menambah section baru cukup menambah entri di sini
 *                    (route, validasi, dan form admin dibuat otomatis).
 */

$levelAttr = ['min' => 0, 'max' => 100];

return [

    'admin_password' => env('PORTFOLIO_ADMIN_PASSWORD', 'msmf170130140109'),

    'defaults' => [
        'about'         => '',
        'profile_photo' => '',
        'cv_file'       => '',
        'profile' => [
            'name'        => 'Muhamad Sulthan Musyaffa Fadhilah',
            'headline'    => 'Web Developer | UI/UX Designer | Graphic Designer',
            'class'       => '',
            'school'      => 'SMKN 2 Banjarmasin',
            'competency'  => 'Software and Game Development',
            'tagline'     => '',
            'main_skills' => 'HTML, CSS, JavaScript, PHP, Laravel',
            'birth'       => '',
            'address'     => '',
            'tech_fields' => '',
            'career_goal' => '',
        ],
        'socials' => ['github' => '', 'instagram' => '', 'linkedin' => '', 'email' => ''],
        'skills' => [], 'interests' => [], 'projects' => [], 'educations' => [],
        'experiences' => [], 'certificates' => [], 'learning_logs' => [], 'testimonials' => [],
    ],

    'sections' => [

        'skill' => [
            'key' => 'skills', 'label' => 'Skills', 'item' => 'Skill',
            'title' => 'name', 'meta' => ['category', 'level'],
            'fields' => [
                'name'     => ['label' => 'Nama', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'category' => ['label' => 'Kategori', 'type' => 'select', 'rules' => 'required|in:hard,soft',
                               'options' => ['hard' => 'Hard Skill (teknis)', 'soft' => 'Soft Skill (non-teknis)']],
                'level'    => ['label' => 'Persentase (0-100)', 'type' => 'number', 'rules' => 'required|integer|min:0|max:100',
                               'attr' => $levelAttr, 'default' => 50],
                'desc'     => ['label' => 'Deskripsi', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ],
        ],

        'interest' => [
            'key' => 'interests', 'label' => 'Interest', 'item' => 'Interest',
            'title' => 'title', 'meta' => ['desc'], 'image' => 'image',
            'fields' => [
                'title' => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'desc'  => ['label' => 'Deskripsi', 'type' => 'text', 'rules' => 'nullable|string|max:500'],
                'link'  => ['label' => 'Link (URL)', 'type' => 'text', 'rules' => 'nullable|string|max:500', 'placeholder' => 'https://...'],
            ],
        ],

        'project' => [
            'key' => 'projects', 'label' => 'Projects', 'item' => 'Project',
            'title' => 'title', 'meta' => ['tech'], 'image' => 'image', 'gallery' => 'docs',
            'fields' => [
                'title'      => ['label' => 'Nama proyek', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'tech'       => ['label' => 'Teknologi yang digunakan', 'type' => 'text', 'rules' => 'nullable|string|max:300', 'placeholder' => 'Laravel, MySQL, Tailwind (pisahkan dengan koma)'],
                'role'       => ['label' => 'Peran dalam proyek', 'type' => 'text', 'rules' => 'nullable|string|max:200'],
                'desc'       => ['label' => 'Deskripsi proyek', 'type' => 'textarea', 'rules' => 'nullable|string|max:3000'],
                'problem'    => ['label' => 'Permasalahan yang ingin diselesaikan', 'type' => 'textarea', 'rules' => 'nullable|string|max:2000'],
                'goal'       => ['label' => 'Tujuan proyek', 'type' => 'textarea', 'rules' => 'nullable|string|max:2000'],
                'features'   => ['label' => 'Fitur-fitur', 'type' => 'textarea', 'rules' => 'nullable|string|max:3000', 'placeholder' => 'Satu fitur per baris'],
                'demo_url'   => ['label' => 'Link demo', 'type' => 'text', 'rules' => 'nullable|string|max:500', 'placeholder' => 'https://...'],
                'source_url' => ['label' => 'Link source code (GitHub)', 'type' => 'text', 'rules' => 'nullable|string|max:500', 'placeholder' => 'https://github.com/...'],
                'process'    => ['label' => 'Dokumentasi proses pekerjaan', 'type' => 'textarea', 'rules' => 'nullable|string|max:5000'],
                'detail'     => ['label' => 'Detail proyek', 'type' => 'textarea', 'rules' => 'nullable|string|max:8000'],
                'feedback'   => ['label' => 'Feedback user', 'type' => 'textarea', 'rules' => 'nullable|string|max:3000', 'placeholder' => 'Satu per baris: Nama - pesan'],
            ],
        ],

        'education' => [
            'key' => 'educations', 'label' => 'Riwayat Pendidikan', 'item' => 'Pendidikan',
            'title' => 'school', 'meta' => ['period'],
            'fields' => [
                'school' => ['label' => 'Sekolah / Institusi', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'period' => ['label' => 'Periode', 'type' => 'text', 'rules' => 'nullable|string|max:100', 'placeholder' => '2023 - sekarang'],
                'desc'   => ['label' => 'Keterangan (jurusan, dll.)', 'type' => 'textarea', 'rules' => 'nullable|string|max:1000'],
            ],
        ],

        'experience' => [
            'key' => 'experiences', 'label' => 'Experience & Activities', 'item' => 'Experience',
            'title' => 'title', 'meta' => ['type', 'period'],
            'fields' => [
                'type'   => ['label' => 'Jenis', 'type' => 'select', 'rules' => 'required|in:PLK,Organisasi,Lomba',
                             'options' => ['PLK' => 'Pengalaman PLK', 'Organisasi' => 'Organisasi / Kepanitiaan', 'Lomba' => 'Lomba']],
                'period' => ['label' => 'Periode', 'type' => 'text', 'rules' => 'nullable|string|max:100', 'placeholder' => '2024 - 2025'],
                'title'  => ['label' => 'Judul / Posisi', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'place'  => ['label' => 'Tempat / Organisasi / Penyelenggara', 'type' => 'text', 'rules' => 'nullable|string|max:180'],
                'desc'   => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'nullable|string|max:3000'],
            ],
        ],

        'certificate' => [
            'key' => 'certificates', 'label' => 'Certificates & Achievements', 'item' => 'Sertifikat',
            'title' => 'title', 'meta' => ['category', 'year'], 'image' => 'image',
            'fields' => [
                'title'    => ['label' => 'Nama sertifikat / prestasi', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'issuer'   => ['label' => 'Penerbit / Penyelenggara', 'type' => 'text', 'rules' => 'nullable|string|max:180'],
                'year'     => ['label' => 'Tahun', 'type' => 'text', 'rules' => 'nullable|string|max:30', 'placeholder' => '2026'],
                'category' => ['label' => 'Kategori', 'type' => 'text', 'rules' => 'nullable|string|max:100', 'suggest' => ['Sertifikat', 'Prestasi']],
                'desc'     => ['label' => 'Dokumentasi / keterangan', 'type' => 'textarea', 'rules' => 'nullable|string|max:1500'],
            ],
        ],

        'learning-log' => [
            'key' => 'learning_logs', 'label' => 'Blog / Catatan Ngoding', 'item' => 'Artikel',
            'title' => 'title', 'meta' => ['category', 'date'], 'image' => 'image',
            'fields' => [
                'title'    => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'category' => ['label' => 'Kategori', 'type' => 'text', 'rules' => 'nullable|string|max:100',
                               'suggest' => ['Artikel', 'Catatan Ngoding', 'Tutorial', 'Cerita Proyek', 'Troubleshooting', 'Pengalaman PLK', 'Pengalaman Lomba']],
                'date'     => ['label' => 'Tanggal', 'type' => 'text', 'rules' => 'nullable|string|max:50', 'placeholder' => '12 November 2026'],
                'excerpt'  => ['label' => 'Ringkasan', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'content'  => ['label' => 'Isi', 'type' => 'textarea', 'rules' => 'required|string|max:10000'],
            ],
        ],

        'testimonial' => [
            'key' => 'testimonials', 'label' => 'Testimonials', 'item' => 'Testimoni',
            'title' => 'name', 'meta' => ['category', 'role'],
            'fields' => [
                'category'  => ['label' => 'Kategori', 'type' => 'select', 'rules' => 'required|in:Guru Pembimbing,Teman,Pengguna,Tempat PLK',
                                'options' => ['Guru Pembimbing' => 'Guru Pembimbing', 'Teman' => 'Teman', 'Pengguna' => 'Pengguna', 'Tempat PLK' => 'Tempat PLK']],
                'name'      => ['label' => 'Nama', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'role'      => ['label' => 'Peran / Jabatan', 'type' => 'text', 'rules' => 'nullable|string|max:180'],
                'quote'     => ['label' => 'Isi testimoni', 'type' => 'textarea', 'rules' => 'required|string|max:3000'],
                'video_url' => ['label' => 'Link video (opsional)', 'type' => 'url', 'rules' => 'nullable|url|max:1000', 'placeholder' => 'https://...'],
            ],
        ],
    ],
];
