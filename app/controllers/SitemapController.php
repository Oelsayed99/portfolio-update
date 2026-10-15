<?php

namespace app\controllers;

use app\models\Project;

class SitemapController extends Controller
{
    /** sitemap.xml: every page and published project, in English and Arabic (hreflang pairs). */
    public function index()
    {
        // path => [changefreq, priority, lastmod]
        $pages = [
            '/'         => ['monthly', '1.0', null],
            '/projects' => ['weekly', '0.9', null],
            '/services' => ['yearly', '0.7', null],
            '/about'    => ['yearly', '0.7', null],
            '/blog'     => ['monthly', '0.6', null],
            '/contact'  => ['yearly', '0.5', null],
        ];
        foreach (Project::all(false) as $p) {
            $updated = strtotime($p['updated_at'] ?? '');
            $pages['/projects/' . $p['slug']] = ['monthly', '0.8', $updated ? gmdate('Y-m-d\TH:i:s\Z', $updated) : null];
        }

        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
        foreach ($pages as $path => [$freq, $priority, $lastmod]) {
            $en = htmlspecialchars(site_url($path));
            $ar = htmlspecialchars(site_url($path) . '?lang=ar');
            foreach ([$en, $ar] as $loc) {
                echo "  <url>\n";
                echo "    <loc>$loc</loc>\n";
                if ($lastmod) echo "    <lastmod>$lastmod</lastmod>\n";
                echo "    <changefreq>$freq</changefreq>\n";
                echo "    <priority>$priority</priority>\n";
                echo "    <xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"$en\"/>\n";
                echo "    <xhtml:link rel=\"alternate\" hreflang=\"ar\" href=\"$ar\"/>\n";
                echo "    <xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"$en\"/>\n";
                echo "  </url>\n";
            }
        }
        echo "</urlset>\n";
    }
}
