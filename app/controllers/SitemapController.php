<?php

namespace app\controllers;

use app\models\Project;

class SitemapController extends Controller
{
    /** sitemap.xml: every page and published project, in English and Arabic (hreflang pairs). */
    public function index()
    {
        $paths = ['/' => null, '/about' => null, '/services' => null, '/projects' => null, '/blog' => null, '/contact' => null];
        foreach (Project::all(false) as $p) {
            $paths['/projects/' . $p['slug']] = substr($p['updated_at'] ?? '', 0, 10) ?: null;
        }

        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
        foreach ($paths as $path => $lastmod) {
            $en = htmlspecialchars(site_url($path));
            $ar = htmlspecialchars(site_url($path) . '?lang=ar');
            foreach ([$en, $ar] as $loc) {
                echo "  <url><loc>$loc</loc>" . ($lastmod ? "<lastmod>$lastmod</lastmod>" : '')
                   . "<xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"$en\"/>"
                   . "<xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"$ar\"/>"
                   . "<xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"$en\"/></url>\n";
            }
        }
        echo '</urlset>';
    }
}
