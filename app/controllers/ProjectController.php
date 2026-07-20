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
            http_response_code(404);
            echo "<h1>404 Not Found</h1><p>Project study not found.</p>";
            exit;
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

        $this->render('project-detail', [
            'title_key' => 'nav_projects',
            'active_page' => 'projects',
            'project' => $project,
            'relatedProjects' => $relatedProjects
        ]);
    }
}
