<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($comics as $comic)
        <url>
            <loc>{{ route('comic.show', $comic->slug) }}</loc>
            <lastmod>  {{\Carbon\Carbon::parse($comic->updated_at)->toAtomString()}} </lastmod>
            <changefreq>Monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>