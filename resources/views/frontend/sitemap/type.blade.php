
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
		<loc>{{ route('type','manga') }}</loc>
		<changefreq>always</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{ route('type','manhua') }}</loc>
		<changefreq>always</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{ route('type','manhwa') }}</loc>
		<changefreq>always</changefreq>
		<priority>0.8</priority>
	</url>
</urlset>