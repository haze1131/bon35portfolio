<?php

namespace App\Http\Controllers;

use App\Support\PortfolioStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /** Menu navbar: id section => label. */
    private const NAV = [
        'home'          => 'Home',
        'about'         => 'About',
        'skill'         => 'Skill',
        'interest'      => 'Interest',
        'project'       => 'Project',
        'experience'    => 'Experience',
        'certificate'   => 'Certificates',
        'cv'            => 'CV',
        'learning-log'  => 'Blog',
        'testimonials'  => 'Testimonials',
        'feedback'      => 'Kesan & Pesan',
        'contact'       => 'Contact',
    ];

    public function __construct(private PortfolioStore $store)
    {
    }

    public function index()
    {
        $data = $this->store->load();

        $projects = array_map(fn ($p) => $this->presentProject($p), $data['projects']);
        $projectTags = array_values(array_unique(array_merge([], ...array_column($projects, 'tech'))));

        return view('welcome', [
            'data'             => $data,
            'navItems'         => self::NAV,
            'links'            => $this->contactLinks($data['socials']),
            'skillGroups'      => $this->groupSkills($data['skills']),
            'experienceGroups' => $this->groupExperiences($data['experiences']),
            'projects'         => $projects,
            'projectTags'      => $projectTags,
            'logCategories'    => $this->uniqueValues($data['learning_logs'], 'category'),
            'testimonialTypes' => $this->uniqueValues($data['testimonials'], 'category'),
            'mainSkills'       => $this->csv($data['profile']['main_skills']),
            'techFields'       => $this->csv($data['profile']['tech_fields']),
        ]);
    }

    public function sendMessage(Request $request): RedirectResponse
    {
        $target = url('/') . '#feedback';

        // Honeypot: bot biasanya mengisi field tersembunyi ini.
        if ($request->filled('website')) {
            return redirect()->to($target);
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:100',
            'relation' => 'nullable|string|max:100',
            'email'    => 'nullable|email|max:150',
            'message'  => 'required|string|min:5|max:2000',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min'      => 'Pesan minimal 5 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->to($target)->withErrors($validator, 'feedback')->withInput();
        }

        $v = $validator->validated();
        $this->store->addMessage([
            'name'       => trim($v['name']),
            'relation'   => trim($v['relation'] ?? ''),
            'email'      => trim($v['email'] ?? ''),
            'message'    => trim($v['message']),
            'created_at' => date('Y-m-d H:i'),
            'read'       => false,
        ]);

        return redirect()->to($target)->with('feedback_status', 'Terima kasih! Kesan dan pesanmu sudah terkirim.');
    }

    /* ---------- Penyiapan data untuk view ---------- */

    private function contactLinks(array $socials): array
    {
        $email = trim($socials['email'] ?? '');
        $links = [
            'github'    => ['label' => 'GitHub',    'href' => $this->safeUrl($socials['github'] ?? '')],
            'instagram' => ['label' => 'Instagram', 'href' => $this->safeUrl($socials['instagram'] ?? '')],
            'linkedin'  => ['label' => 'LinkedIn',  'href' => $this->safeUrl($socials['linkedin'] ?? '')],
            'email'     => [
                'label' => $email,
                'href'  => str_contains($email, '@') ? 'mailto:' . preg_replace('/^mailto:/i', '', $email) : $this->safeUrl($email),
            ],
        ];
        $links['email']['label'] = preg_replace('/^mailto:/i', '', $links['email']['label']) ?: 'Email';

        return array_filter($links, fn ($link) => $link['href'] !== '');
    }

    private function presentProject(array $p): array
    {
        return [
            'id'         => (int) ($p['id'] ?? 0),
            'title'      => (string) ($p['title'] ?? ''),
            'tech'       => $this->csv($p['tech'] ?? ''),
            'image'      => !empty($p['image']) ? '/uploads/' . $p['image'] : '',
            'desc'       => (string) ($p['desc'] ?? ''),
            'problem'    => (string) ($p['problem'] ?? ''),
            'goal'       => (string) ($p['goal'] ?? ''),
            'role'       => (string) ($p['role'] ?? ''),
            'features'   => $this->lines($p['features'] ?? ''),
            'demo_url'   => $this->safeUrl($p['demo_url'] ?? ''),
            'source_url' => $this->safeUrl($p['source_url'] ?? ''),
            'process'    => (string) ($p['process'] ?? ''),
            'detail'     => (string) ($p['detail'] ?? ''),
            'feedback'   => $this->lines($p['feedback'] ?? ''),
            'docs'       => array_map(fn ($f) => '/uploads/' . $f, array_values(array_filter((array) ($p['docs'] ?? [])))),
        ];
    }

    private function groupSkills(array $skills): array
    {
        $groups = ['hard' => [], 'soft' => []];
        foreach ($skills as $skill) {
            $skill['level'] = max(0, min(100, (int) ($skill['level'] ?? 50)));
            $groups[($skill['category'] ?? 'hard') === 'soft' ? 'soft' : 'hard'][] = $skill;
        }
        return $groups;
    }

    private function groupExperiences(array $items): array
    {
        $groups = ['PLK' => [], 'Organisasi' => [], 'Lomba' => [], 'Lainnya' => []];
        foreach ($items as $item) {
            $type = mb_strtolower((string) ($item['type'] ?? ''));
            $group = match (true) {
                str_contains($type, 'plk'), str_contains($type, 'prakerin'), str_contains($type, 'work') => 'PLK',
                str_contains($type, 'org'), str_contains($type, 'panitia')                              => 'Organisasi',
                str_contains($type, 'lomba'), str_contains($type, 'compet')                             => 'Lomba',
                default                                                                                 => 'Lainnya',
            };
            $groups[$group][] = $item;
        }
        return $groups;
    }

    private function uniqueValues(array $items, string $key): array
    {
        $values = array_filter(array_map(fn ($i) => trim((string) ($i[$key] ?? '')), $items));
        return array_values(array_unique($values));
    }

    private function csv(string $text): array
    {
        return array_values(array_filter(array_map('trim', explode(',', $text))));
    }

    private function lines(string $text): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $text) ?: [])));
    }

    /** Hanya izinkan http(s) atau path internal, supaya tidak ada "javascript:" di href. */
    private function safeUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '' || $url === '#') return '';
        return preg_match('#^(https?://|/)#i', $url) ? $url : '';
    }
}
