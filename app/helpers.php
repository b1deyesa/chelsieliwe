<?php

use Illuminate\Support\Str;

if (!function_exists('icon_by_path_type')) {
    /**
     * Menentukan ikon berdasarkan jenis path atau link.
     *
     * @param string $path
     * @param bool $isLink
     * @return string
     */
    function icon_by_path_type(string $path, bool $isLink = false): string
    {
        if ($isLink) {
            if (Str::contains($path, 'instagram.com')) {
                return '<i class="fab fa-instagram"></i>';
            }

            if (Str::contains($path, 'youtube.com') || Str::contains($path, 'youtu.be')) {
                return '<i class="fab fa-youtube"></i>';
            }

            if (Str::contains($path, 'tiktok.com')) {
                return '<i class="fab fa-tiktok"></i>';
            }

            return '<i class="fas fa-link"></i>';
        }

        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match (true) {
            in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']) => '<i class="fas fa-image"></i>',
            in_array($ext, ['mp4', 'mov', 'avi', 'webm']) => '<i class="fas fa-video"></i>',
            in_array($ext, ['mp3', 'wav', 'ogg']) => '<i class="fas fa-music"></i>',
            default => '<i class="fas fa-file"></i>',
        };
    }
}


function embed_by_path_type_with_wrapper(string $path, bool $isLink = false): string
{
    // Tampilkan langsung jika bukan link
    if (!$isLink) {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Jika file video
        if (in_array($extension, ['mp4', 'webm', 'ogg', 'mov'])) {
            $url = asset('storage/' . $path);
            return <<<HTML
            <video controls style="max-width:100%;">
                <source src="{$url}" type="video/{$extension}">
                Your browser does not support the video tag.
            </video>
            HTML;
        }

        // Jika file gambar
        return '<img src="' . asset('storage/' . $path) . '" style="max-width:100%;">';
    }

    // Jika link (YouTube, TikTok, Instagram, dsb)
    $html = '<div class="cover__container">';

    // Instagram
    if (Str::contains($path, 'instagram.com')) {
        $html .= <<<HTML
<blockquote class="instagram-media" data-instgrm-permalink="{$path}" data-instgrm-version="14" style="width:100%; min-height:400px;"></blockquote>
<script async src="https://www.instagram.com/embed.js"></script>
HTML;
    }

    // YouTube
    elseif (Str::contains($path, 'youtube.com') || Str::contains($path, 'youtu.be')) {
        if (preg_match('/(?:youtu\.be\/|watch\?v=|embed\/|shorts\/)([a-zA-Z0-9_-]+)/', $path, $yt)) {
            $id = $yt[1] ?? null;

            if ($id) {
                $html .= <<<HTML
<iframe width="100%" height="315" src="https://www.youtube.com/embed/{$id}" frameborder="0" allowfullscreen></iframe>
HTML;
            }
        }
    }

    // TikTok
    elseif (Str::contains($path, 'tiktok.com')) {
        if (preg_match('/tiktok\.com\/(@[\w.-]+)\/video\/(\d+)/', $path, $tk)) {
            $id = $tk[2] ?? null;

            if ($id) {
                $html .= <<<HTML
<blockquote class="tiktok-embed" cite="{$path}" data-video-id="{$id}" style="width:100%; min-height:400px;">
    <section>Loading TikTok...</section>
</blockquote>
<script async src="https://www.tiktok.com/embed.js"></script>
HTML;
            }
        }
    }

    // Fallback
    else {
        $html .= '<p>Link not supported.</p>';
    }

    $html .= '</div>';

    return $html;
}