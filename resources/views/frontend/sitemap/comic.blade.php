<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @for($i = 1; $i <= $loop; $i++)
        <sitemap>
            <loc>{{ route('sitemap.comicDetail', $i) }}</loc>
            <lastmod>{{\Carbon\Carbon::parse($comic->updated_at)->toAtomString()}}</lastmod>
        </sitemap>
    @endfor
</sitemapindex>