<?php

namespace App\Http\Controllers;

use App\Support\PortfolioStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Login/logout, dashboard, profil, foto, sosial media, CV, dan pesan masuk.
 * CRUD section (skill, project, dst.) ada di AdminSectionController.
 */
class AdminController extends Controller
{
    private const PROFILE_FIELDS = [
        'name', 'headline', 'class', 'school', 'competency', 'tagline',
        'main_skills', 'birth', 'address', 'tech_fields', 'career_goal',
    ];

    public function __construct(private PortfolioStore $store)
    {
    }

    public function index(Request $request)
    {
        if ($request->query('logout')) {
            session()->forget('portfolio_admin');
            return redirect()->route('admin');
        }

        if ($request->isMethod('post') && $request->has('password') && !session('portfolio_admin')) {
            if (hash_equals((string) config('portfolio.admin_password'), (string) $request->input('password'))) {
                session(['portfolio_admin' => true]);
                return redirect()->route('admin');
            }
            return view('admin', ['loggedIn' => false, 'loginError' => 'Password salah.', 'data' => [], 'messages' => []]);
        }

        $loggedIn = (bool) session('portfolio_admin', false);

        return view('admin', [
            'loggedIn' => $loggedIn,
            'data'     => $loggedIn ? $this->store->load() : [],
            'messages' => $loggedIn ? array_reverse($this->store->messages()) : [],
        ]);
    }

    public function saveAbout(Request $request): RedirectResponse
    {
        $data = $this->store->load();
        $data['about'] = trim((string) $request->input('about', ''));
        $this->store->save($data);
        return $this->back('About berhasil disimpan.', 'profile');
    }

    public function saveProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'headline'    => 'nullable|string|max:200',
            'class'       => 'nullable|string|max:60',
            'school'      => 'nullable|string|max:150',
            'competency'  => 'nullable|string|max:150',
            'tagline'     => 'nullable|string|max:500',
            'main_skills' => 'nullable|string|max:500',
            'birth'       => 'nullable|string|max:150',
            'address'     => 'nullable|string|max:300',
            'tech_fields' => 'nullable|string|max:500',
            'career_goal' => 'nullable|string|max:1500',
        ]);

        $data = $this->store->load();
        foreach (self::PROFILE_FIELDS as $field) {
            $data['profile'][$field] = trim((string) $request->input($field, ''));
        }
        $this->store->save($data);
        return $this->back('Profil berhasil disimpan.', 'profile');
    }

    public function savePhoto(Request $request): RedirectResponse
    {
        $data = $this->store->load();

        if ($request->input('delete_photo')) {
            $this->store->deleteFile($data['profile_photo'] ?? '');
            $data['profile_photo'] = '';
            $this->store->save($data);
            return $this->back('Foto profil dihapus.', 'profile');
        }

        $request->validate(['photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:4096']);
        $image = $this->store->uploadImage($request->file('photo'));
        if (!$image) return $this->back('Tidak ada file yang diupload.', 'profile');

        $this->store->deleteFile($data['profile_photo'] ?? '');
        $data['profile_photo'] = $image;
        $this->store->save($data);
        return $this->back('Foto profil diupdate.', 'profile');
    }

    public function saveSocials(Request $request): RedirectResponse
    {
        $data = $this->store->load();
        foreach (['email', 'github', 'instagram', 'linkedin'] as $key) {
            $data['socials'][$key] = trim((string) $request->input($key, ''));
        }
        $this->store->save($data);
        return $this->back('Kontak & social media disimpan.', 'profile');
    }

    public function saveCv(Request $request): RedirectResponse
    {
        $data = $this->store->load();

        if ($request->input('delete_cv')) {
            $this->store->deleteFile($data['cv_file'] ?? '');
            $data['cv_file'] = '';
            $this->store->save($data);
            return $this->back('File CV dihapus.', 'profile');
        }

        $request->validate(['cv' => 'required|file|mimes:pdf|max:5120']);
        $file = $this->store->uploadPdf($request->file('cv'));
        if (!$file) return $this->back('File CV gagal diupload.', 'profile');

        $this->store->deleteFile($data['cv_file'] ?? '');
        $data['cv_file'] = $file;
        $this->store->save($data);
        return $this->back('File CV diupload.', 'profile');
    }

    public function readMessage(Request $request): RedirectResponse
    {
        $id = (int) $request->input('id');
        $messages = $this->store->messages();
        foreach ($messages as &$message) {
            if ((int) ($message['id'] ?? 0) === $id) $message['read'] = true;
        }
        unset($message);
        $this->store->saveMessages($messages);
        return $this->back('Pesan ditandai sudah dibaca.', 'messages');
    }

    public function deleteMessage(Request $request): RedirectResponse
    {
        $id = (int) $request->input('id');
        $messages = array_filter($this->store->messages(), fn ($m) => (int) ($m['id'] ?? 0) !== $id);
        $this->store->saveMessages($messages);
        return $this->back('Pesan dihapus.', 'messages');
    }

    private function back(string $message, string $anchor): RedirectResponse
    {
        return redirect()->to(route('admin') . '#' . $anchor)->with('msg', $message);
    }
}
