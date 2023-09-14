<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($chapters as $chapter)
        <url>
            <loc>{{ route('comic.chapter', $chapter->slug) }}</loc>
            <lastmod>  {{\Carbon\Carbon::parse($chapter->updated_at)->toAtomString()}} </lastmod>
            <changefreq>Monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>