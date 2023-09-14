<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('sitemap.home') }}</loc>
        <lastmod>{{\Carbon\Carbon::parse(now())->toAtomString()}}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.comic') }}</loc>
        <lastmod>{{\Carbon\Carbon::parse($comic->created_at)->toAtomString()}}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.chapter') }}</loc>
        <lastmod>{{\Carbon\Carbon::parse($chapter->updated_at)->toAtomString()}}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.genre') }}</loc>
        <lastmod>{{\Carbon\Carbon::parse($genre->updated_at)->toAtomString()}}</lastmod>
    </sitemap>
</sitemapindex>