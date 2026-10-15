<?php
namespace app\controllers;

use app\models\Project;
use app\models\ProjectSection;
use app\models\Tag;
use app\models\Technology;

class ProjectController extends Controller
{
    public function index()
    {
        $sections = ProjectSection::getActive();
        $allProjects = Project::all(false); // Only published

        // Group projects by section slug
        $groupedProjects = [];
        foreach ($allProjects as $project) {
            $groupedProjects[$project['section_slug']][] = $project;
        }

        $tags = Tag::all();
        $technologies = Technology::all();

        $this->render('projects', [
            'title_key' => 'nav_projects',
            'active_page' => 'projects',
            'sections' => $sections,
            'projectsBySection' => $groupedProjects,
            'tags' => $tags,
            'technologies' => $technologies
        ]);
    }

    public function detail($slug)
    {
        $project = Project::findBySlug($slug);
        if (!$project || $project['visibility'] === 'archived') {
            \app\Router::abort(404, "Project '$slug' not found");
        }

        // Get related projects (same section, limit 3)
        $allInSection = Project::getBySection($project['section_slug'], false);
        $relatedProjects = [];
        foreach ($allInSection as $related) {
            if ($related['id'] !== $project['id']) {
                $relatedProjects[] = $related;
            }
            if (count($relatedProjects) >= 3) break;
        }

        $lang = get_current_lang();
        $title = $project['title_' . $lang] ?: $project['title_en'];
        $summary = $project['short_description_' . $lang] ?: $project['short_description_en'];
        $url = site_url('/projects/' . $project['slug']);
        $seo = [
            'title' => ($project['seo_title_' . $lang] ?? '') ?: $title . ' — ' . translate('seo_case_study') . ' | Omar Elsayed',
            'description' => ($project['seo_description_' . $lang] ?? '') ?: mb_substr($summary, 0, 160),
            'image' => $project['thumbnail'] ?: '/assets/images/brand/og-image.jpg',
            'type' => 'article',
            'jsonld' => [
                ['@type' => 'CreativeWork', 'name' => $title, 'description' => $summary, 'url' => $url,
                 'image' => site_url($project['thumbnail'] ?: '/assets/images/brand/og-image.jpg'),
                 'author' => ['@id' => site_url('/#person')], 'inLanguage' => $lang,
                 'keywords' => implode(', ', array_column($project['technologies'] ?? [], 'name'))],
                ['@type' => 'BreadcrumbList', 'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => translate('nav_home'), 'item' => site_url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => translate('nav_projects'), 'item' => site_url('/projects')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $title, 'item' => $url],
                ]],
            ],
        ];

        $this->render('project-detail', [
            'title_key' => 'nav_projects',
            'active_page' => 'projects',
            'seo' => $seo,
            'project' => $project,
            'relatedProjects' => $relatedProjects
        ]);
    }
}
