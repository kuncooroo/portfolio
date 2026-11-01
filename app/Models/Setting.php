<?php

namespace App\Models;

use App\Models\Concerns\ClearsPortfolioCache;
use App\Support\Media;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use ClearsPortfolioCache;
    protected $fillable = [
        'page_title',
        'brand_name',
        'owner_name',
        'greeting',
        'roles',
        'bio',
        'photo',
        'cv_path',
        'caption_primary',
        'caption_secondary',
        'github',
        'instagram',
        'linkedin',
        'whatsapp',
        'email',
        'footer_note',
    ];

    public static function defaults(): array
    {
        return [
            'page_title' => 'Nabila Mutiara Agung Saputri | Portfolio',
            'brand_name' => 'Nabila',
            'owner_name' => 'Nabila Mutiara Agung Saputri',
            'greeting' => 'ayo senyum',
            'roles' => 'mahasiswa kedokteran gigi • angkatan 2024 • universitas jember',
            'bio' => 'Mahasiswa Kedokteran Gigi angkatan 2024 di Universitas Jember. Berasal dari Grobogan, dan sedang belajar ilmu gigi dari dasar sampai bisa ikut merawat senyum orang lain.',
            'photo' => 'images/portrait.svg',
            'cv_path' => null,
            'caption_primary' => 'Universitas Jember, angkatan 2024',
            'caption_secondary' => 'dari Grobogan',
            'github' => null,
            'instagram' => null,
            'linkedin' => null,
            'whatsapp' => null,
            'email' => null,
            'footer_note' => 'Kedokteran Gigi, Universitas Jember',
        ];
    }

    public static function current(): self
    {
        return static::query()->first() ?? static::query()->create(static::defaults());
    }

    public function photoUrl(): ?string
    {
        return Media::display($this->photo);
    }

    public function cvUrl(): ?string
    {
        return Media::url($this->cv_path);
    }

    public function bioHtml(): string
    {
        $clean = strip_tags((string) $this->bio, '<strong><em><br><b><i>');

        return nl2br($clean, false);
    }

    public function hasSocialLinks(): bool
    {
        return (bool) ($this->github || $this->instagram || $this->linkedin || $this->whatsapp || $this->email);
    }
}
