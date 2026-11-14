<?php

namespace App\Http\Controllers;

use App\Support\PortfolioStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * CRUD generik untuk semua section JSON (skill, interest, project, education,
 * experience, certificate, learning-log, testimonial).
 * Definisi field & validasi ada di config/portfolio.php -> "sections".
 */
class AdminSectionController extends Controller
{
    private const IMAGE_RULE = 'image|mimes:jpg,jpeg,png,gif,webp|max:4096';

    public function __construct(private PortfolioStore $store)
    {
    }

    public function add(Request $request, string $section): RedirectResponse
    {
        $cfg = $this->config($section);
        $validated = $request->validate($this->rules($cfg, false));

        $item = $this->values($cfg, $validated);
        if ($field = $cfg['image'] ?? null) {
            $item[$field] = $this->store->uploadImage($request->file($field));
        }
        if ($field = $cfg['gallery'] ?? null) {
            $item[$field] = $this->uploadGallery($request, $field);
        }

        $data = $this->store->load();
        $data[$cfg['key']][] = ['id' => $this->store->nextId($data[$cfg['key']])] + $item;
        $this->store->save($data);

        return $this->back($section, $cfg['item'] . ' berhasil ditambahkan.');
    }

    public function edit(Request $request, string $section): RedirectResponse
    {
        $cfg = $this->config($section);
        $validated = $request->validate($this->rules($cfg, true));
        $id = (int) $validated['id'];

        $data = $this->store->load();
        $found = false;

        foreach ($data[$cfg['key']] as &$item) {
            if ((int) ($item['id'] ?? 0) !== $id) continue;

            $item = array_merge($item, $this->values($cfg, $validated));
            $this->updateImage($request, $cfg, $item);
            $this->updateGallery($request, $cfg, $item);
            $found = true;
            break;
        }
        unset($item);

        if (!$found) return $this->back($section, 'Data tidak ditemukan.');

        $this->store->save($data);
        return $this->back($section, $cfg['item'] . ' berhasil diperbarui.');
    }

    public function delete(Request $request, string $section): RedirectResponse
    {
        $cfg = $this->config($section);
        $request->validate(['id' => 'required|integer']);
        $id = (int) $request->input('id');

        $data = $this->store->load();
        foreach ($data[$cfg['key']] as $item) {
            if ((int) ($item['id'] ?? 0) !== $id) continue;
            if ($field = $cfg['image'] ?? null) $this->store->deleteFile($item[$field] ?? '');
            if ($field = $cfg['gallery'] ?? null) {
                foreach ((array) ($item[$field] ?? []) as $file) $this->store->deleteFile($file);
            }
        }
        $data[$cfg['key']] = array_values(array_filter(
            $data[$cfg['key']],
            fn ($item) => (int) ($item['id'] ?? 0) !== $id
        ));
        $this->store->save($data);

        return $this->back($section, $cfg['item'] . ' berhasil dihapus.');
    }

    /* ---------- Helper ---------- */

    private function config(string $section): array
    {
        $cfg = config('portfolio.sections.' . $section);
        abort_unless(is_array($cfg), 404);
        return $cfg;
    }

    private function rules(array $cfg, bool $withId): array
    {
        $rules = array_map(fn ($field) => $field['rules'], $cfg['fields']);

        if ($field = $cfg['image'] ?? null) {
            $rules[$field] = 'nullable|' . self::IMAGE_RULE;
        }
        if ($field = $cfg['gallery'] ?? null) {
            $rules[$field] = 'nullable|array|max:10';
            $rules[$field . '.*'] = self::IMAGE_RULE;
        }
        if ($withId) $rules['id'] = 'required|integer';

        return $rules;
    }

    /** Ambil nilai field teks/angka dari hasil validasi. */
    private function values(array $cfg, array $validated): array
    {
        $values = [];
        foreach ($cfg['fields'] as $name => $field) {
            $value = $validated[$name] ?? '';
            $values[$name] = str_contains($field['rules'], 'integer') ? (int) $value : trim((string) $value);
        }
        return $values;
    }

    private function updateImage(Request $request, array $cfg, array &$item): void
    {
        $field = $cfg['image'] ?? null;
        if (!$field) return;

        $old = $item[$field] ?? '';
        if ($request->boolean('delete_image')) {
            $this->store->deleteFile($old);
            $item[$field] = $old = '';
        }
        if ($new = $this->store->uploadImage($request->file($field))) {
            $this->store->deleteFile($old);
            $item[$field] = $new;
        }
    }

    private function updateGallery(Request $request, array $cfg, array &$item): void
    {
        $field = $cfg['gallery'] ?? null;
        if (!$field) return;

        $current = array_values(array_filter((array) ($item[$field] ?? [])));
        $remove  = (array) $request->input('remove_' . $field, []);

        foreach ($current as $file) {
            if (in_array($file, $remove, true)) $this->store->deleteFile($file);
        }
        $item[$field] = array_merge(
            array_values(array_diff($current, $remove)),
            $this->uploadGallery($request, $field)
        );
    }

    private function uploadGallery(Request $request, string $field): array
    {
        $names = [];
        foreach ((array) $request->file($field, []) as $file) {
            if ($name = $this->store->uploadImage($file)) $names[] = $name;
        }
        return $names;
    }

    private function back(string $section, string $message): RedirectResponse
    {
        return redirect()->to(route('admin') . '#sec-' . $section)->with('msg', $message);
    }
}
