<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($categories as $category)
        <url>
            <loc>{{ route('genre', $category->slug) }}</loc>
            <lastmod>  {{\Carbon\Carbon::parse('2020-05-21')->toAtomString()}} </lastmod>
            <changefreq>Weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>