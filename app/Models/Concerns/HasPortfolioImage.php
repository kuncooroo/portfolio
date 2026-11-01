<?php

namespace App\Models\Concerns;

use App\Support\Media;

trait HasPortfolioImage
{
    public function coverIcon(): ?string
    {
        $image = (string) $this->image;

        return str_starts_with($image, 'fa-') ? $image : null;
    }

    public function imageUrl(): ?string
    {
        if ($this->coverIcon()) {
            return null;
        }

        return Media::display($this->image);
    }
}
