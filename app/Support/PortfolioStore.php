<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

/**
 * Akses tunggal ke data portfolio (public/data/data.json), file upload,
 * dan pesan masuk (storage/app/messages.json).
 * Dipakai bersama oleh PortfolioController dan semua controller admin.
 */
class PortfolioStore
{
    private const IMAGE_EXT = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    private string $dataFile;
    private string $messageFile;
    private string $uploadDir;

    public function __construct()
    {
        $this->dataFile    = public_path('data/data.json');
        $this->messageFile = storage_path('app/messages.json');
        $this->uploadDir   = public_path('uploads/');
    }

    /* ---------- Data utama ---------- */

    public function load(): array
    {
        $defaults = config('portfolio.defaults');
        $data = array_replace($defaults, $this->read($this->dataFile));

        foreach (['skills', 'interests', 'projects', 'educations', 'experiences', 'certificates', 'learning_logs', 'testimonials'] as $key) {
            if (!is_array($data[$key])) $data[$key] = [];
        }
        foreach (['socials', 'profile'] as $key) {
            $data[$key] = array_replace($defaults[$key], is_array($data[$key]) ? $data[$key] : []);
        }

        // Data lama: project hanya punya "link" -> jadikan "demo_url".
        foreach ($data['projects'] as &$project) {
            if (isset($project['link'])) {
                if (empty($project['demo_url']) && $project['link'] !== '#') $project['demo_url'] = $project['link'];
                unset($project['link']);
            }
        }
        unset($project);

        return $data;
    }

    public function save(array $data): void
    {
        $this->write($this->dataFile, $data);
    }

    public function nextId(array $items): int
    {
        return empty($items) ? 1 : max(array_map('intval', array_column($items, 'id'))) + 1;
    }

    /* ---------- Pesan masuk (Kesan & Pesan) ---------- */

    public function messages(): array
    {
        return $this->read($this->messageFile);
    }

    public function saveMessages(array $messages): void
    {
        $this->write($this->messageFile, array_values($messages));
    }

    public function addMessage(array $message): void
    {
        $messages = $this->messages();
        $message['id'] = $this->nextId($messages);
        $messages[] = $message;
        $this->saveMessages($messages);
    }

    /* ---------- Upload ---------- */

    public function uploadImage(?UploadedFile $file): string
    {
        return $this->move($file, self::IMAGE_EXT);
    }

    public function uploadPdf(?UploadedFile $file): string
    {
        return $this->move($file, ['pdf']);
    }

    public function deleteFile(?string $name): void
    {
        if (!$name) return;
        $path = $this->uploadDir . basename($name);
        if (is_file($path)) unlink($path);
    }

    private function move(?UploadedFile $file, array $allowed): string
    {
        if (!$file || !$file->isValid()) return '';
        $ext = strtolower($file->getClientOriginalExtension());
        if (!in_array($ext, $allowed, true)) return '';
        $name = bin2hex(random_bytes(7)) . '.' . $ext;
        $file->move($this->uploadDir, $name);
        return $name;
    }

    /* ---------- File JSON ---------- */

    private function read(string $file): array
    {
        if (!is_file($file)) return [];
        $decoded = json_decode(file_get_contents($file), true);
        return is_array($decoded) ? $decoded : [];
    }

    private function write(string $file, array $data): void
    {
        if (!is_dir(dirname($file))) mkdir(dirname($file), 0775, true);
        file_put_contents(
            $file,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE),
            LOCK_EX
        );
    }
}
