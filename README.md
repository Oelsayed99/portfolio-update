# Portfolio & CMS — elsayedomar.com

The site behind [elsayedomar.com](https://elsayedomar.com): a multilingual portfolio with a database-backed content management layer, built on a hand-written PHP MVC framework rather than an existing one.

---

## Why no framework

The point was to understand what a framework does before relying on one — routing, the request lifecycle, and the boundary between controller, model and view. Everything below is implemented directly:

```
app/
  Router.php              Route resolution and dispatch
  database.php            PDO connection
  helpers.php             View helpers
  controllers/
    Controller.php          Base controller
    HomeController.php  AboutController.php  BlogController.php
    ProjectController.php  ContactController.php
  models/
    Model.php               Base model
    Project.php  ProjectSection.php  ProjectStatus.php
    Technology.php  Skill.php  Tag.php
    Translation.php  Media.php  Journey.php  User.php
  views/
    home.php  about.php  projects.php  project-detail.php
    blog.php  contact.php
partials/                 Shared layout fragments
public/                   Web root
```

## Content model

Projects are not flat records. A project has ordered **sections**, a **status**, and many-to-many relationships to **technologies** and **tags** — so a case study is composed from structured data rather than stored as a blob of HTML, and the same project can be rendered differently in a listing, a detail page and a filtered view.

`Journey` carries the timeline entries. `Media` handles images and video. `Skill` and `Technology` are separate on purpose: a technology is something used on a project, a skill is something claimed on the profile, and conflating them makes both harder to query.

## Multilingual content

Translations live in the database via the `Translation` model rather than in language files, so content can be edited without a deploy. This is the same `msgid`-keyed approach used in the translation tooling built at ALL-INKL, reapplied here.

## Running locally

```bash
cp .env.example .env
docker compose up -d
```

Load the schema:

```bash
docker compose exec -T mysql mysql -uroot -proot portfolio < database/portfolio_export.sql
```

## Deployment

Production runs from a separate compose stack:

```bash
docker compose -f docker-compose.prod.yml up -d
```

`.env.prod` holds production configuration; `.htaccess` handles rewrites where the site is served under Apache rather than the container.

---

**Stack:** PHP · MySQL · PDO · vanilla JavaScript · CSS · Docker · Apache
