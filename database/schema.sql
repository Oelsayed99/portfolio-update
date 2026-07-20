-- Portfolio CMS Database Schema Migration

CREATE TABLE IF NOT EXISTS project_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_en VARCHAR(255) NOT NULL,
    name_ar VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description_en TEXT,
    description_ar TEXT,
    display_order INT DEFAULT 0,
    active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS project_statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_en VARCHAR(255) NOT NULL,
    name_ar VARCHAR(255) NOT NULL,
    icon VARCHAR(255) DEFAULT '',
    color VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS technologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    icon VARCHAR(255) DEFAULT '',
    color VARCHAR(255) DEFAULT '',
    category ENUM('frontend', 'backend', 'database', 'devops', 'tools') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_en VARCHAR(255) NOT NULL,
    name_ar VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- We modify or recreate the projects table:
DROP TABLE IF EXISTS project_technologies;
DROP TABLE IF EXISTS project_tags;
DROP TABLE IF EXISTS project_images;
DROP TABLE IF EXISTS projects;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_en VARCHAR(255) NOT NULL,
    title_ar VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    section_id INT NOT NULL,
    status_id INT NOT NULL,
    featured_order INT DEFAULT NULL,
    visibility ENUM('draft', 'published', 'archived') DEFAULT 'published',
    thumbnail VARCHAR(255) DEFAULT '',
    hero_image VARCHAR(255) DEFAULT '',
    description_en TEXT,
    description_ar TEXT,
    problem_en TEXT,
    problem_ar TEXT,
    solution_en TEXT,
    solution_ar TEXT,
    architecture_en TEXT,
    architecture_ar TEXT,
    challenges_en TEXT,
    challenges_ar TEXT,
    lessons_learned_en TEXT,
    lessons_learned_ar TEXT,
    my_role_en TEXT,
    my_role_ar TEXT,
    company_en VARCHAR(255) DEFAULT '',
    company_ar VARCHAR(255) DEFAULT '',
    client_en VARCHAR(255) DEFAULT '',
    client_ar VARCHAR(255) DEFAULT '',
    duration_en VARCHAR(255) DEFAULT '',
    duration_ar VARCHAR(255) DEFAULT '',
    team_size INT DEFAULT 1,
    contribution_percentage INT DEFAULT 100,
    countries_used TEXT,
    user_count INT DEFAULT 0,
    performance_score INT DEFAULT 90,
    completion_percentage INT DEFAULT 100,
    display_order INT DEFAULT 0,
    seo_title_en VARCHAR(255) DEFAULT '',
    seo_title_ar VARCHAR(255) DEFAULT '',
    seo_description_en TEXT,
    seo_description_ar TEXT,
    canonical_url VARCHAR(255) DEFAULT '',
    og_image VARCHAR(255) DEFAULT '',
    twitter_image VARCHAR(255) DEFAULT '',
    keywords TEXT,
    structured_data TEXT,
    project_url VARCHAR(255) DEFAULT '',
    github_url VARCHAR(255) DEFAULT '',
    case_study_url VARCHAR(255) DEFAULT '',
    demo_url VARCHAR(255) DEFAULT '',
    docs_url VARCHAR(255) DEFAULT '',
    figma_url VARCHAR(255) DEFAULT '',
    video_url VARCHAR(255) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (section_id) REFERENCES project_sections(id) ON DELETE RESTRICT,
    FOREIGN KEY (status_id) REFERENCES project_statuses(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    alt_text_en VARCHAR(255) DEFAULT '',
    alt_text_ar VARCHAR(255) DEFAULT '',
    caption_en VARCHAR(255) DEFAULT '',
    caption_ar VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    featured TINYINT(1) DEFAULT 0,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_technologies (
    project_id INT NOT NULL,
    technology_id INT NOT NULL,
    PRIMARY KEY (project_id, technology_id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (technology_id) REFERENCES technologies(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE project_tags (
    project_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (project_id, tag_id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    file_type VARCHAR(50) NOT NULL,
    file_size INT NOT NULL,
    folder VARCHAR(255) DEFAULT 'uploads',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
