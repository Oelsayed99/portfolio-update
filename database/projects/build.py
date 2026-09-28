#!/usr/bin/env python3
"""Project catalogue for elsayedomar.com.

Sources: live-snapshot.json (the 5 projects already on the live site, scraped from their public
pages, EN + AR) and NEW below (from GitHub READMEs and the CV; facts only, no invented metrics).

  python3 database/projects/build.py
    -> public/assets/images/projects/<slug>.webp (+ -hero.webp)  generated covers for NEW projects
    -> database/updates/2026-09-27-projects.sql   LIVE: inserts NEW projects only, skips slugs that exist
    -> database/dev/local-projects.sql            LOCAL: replaces all projects with snapshot + NEW

Replace a generated cover by uploading a real screenshot in the admin.
"""
import json, pathlib, random, re
from PIL import Image, ImageDraw, ImageFilter, ImageFont

ROOT = pathlib.Path(__file__).resolve().parents[2]
HERE = ROOT / "database/projects"
COVERS = ROOT / "public/assets/images/projects"
SEC = {"featured": 1, "professional": 2, "personal": 3, "opensource": 4, "building": 5, "experiments": 6}
ST = {"completed": 1, "progress": 2, "maintenance": 3, "paused": 4, "archived": 5}
GH = "https://github.com/Oelsayed99/"

NEW_TECH = {  # name: (icon, color, category)
    "TypeScript": ("fas fa-code", "#3178c6", "frontend"), "Next.js": ("fas fa-n", "#ffffff", "frontend"),
    "Tailwind CSS": ("fas fa-wind", "#38bdf8", "frontend"), "Zod": ("fas fa-shield-halved", "#3068b7", "backend"),
    "Vitest": ("fas fa-vial-circle-check", "#6e9f18", "backend"), "Pest": ("fas fa-vial", "#a855f7", "backend"),
    "Gemini API": ("fas fa-wand-magic-sparkles", "#8e75b2", "backend"), "Prisma": ("fas fa-diamond", "#5a67d8", "database"),
    "Python": ("fab fa-python", "#3776ab", "backend"), "FastAPI": ("fas fa-bolt", "#009688", "backend"),
    "Flask": ("fas fa-flask", "#ffffff", "backend"), "SQLite": ("fas fa-database", "#003b57", "database"),
    "n8n": ("fas fa-diagram-project", "#ea4b71", "devops"), "TensorFlow": ("fas fa-brain", "#ff6f00", "backend"),
    "pandas": ("fas fa-table", "#150458", "backend"), "Jupyter": ("fas fa-book-open", "#f37626", "backend"),
}
NEW_TAGS = {"AI": ("ذكاء اصطناعي", "ai"), "Automation": ("أتمتة", "automation"),
            "Data Analysis": ("تحليل البيانات", "data-analysis"), "Learning": ("تعلّم", "learning")}

# en/ar pairs; `case` = (overview, problem, solution, architecture, challenges, lessons)
NEW = [
 dict(slug="pitchproof", sec="featured", st="completed", feat=2, pct=100, kind="AI · Grounded generation",
  title=("PitchProof", "بيتش بروف"),
  short=("AI-assisted PR briefing tool that refuses to treat model output as truth.", "أداة ذكاء اصطناعي لتجهيز البيانات الصحفية ترفض اعتبار مخرجات النموذج حقيقة."),
  case=dict(
   description=("PitchProof guides a PR consultant through a structured six-step brief for a product launch or funding announcement, checks every answer for meaning and evidence, exposes the claims that could be repeated publicly, requires human approval, and generates pitches from approved facts only.",
                "يرشد بيتش بروف مستشار العلاقات العامة عبر نموذج من ست خطوات لإطلاق منتج أو إعلان تمويل، ويراجع كل إجابة من حيث المعنى والدليل، ويعرض الادعاءات القابلة للنشر، ويشترط موافقة بشرية، ثم يولّد العروض من الحقائق المعتمدة فقط."),
   problem=("Generic AI writing tools turn a thin announcement into fluent but unsupported copy. For PR, a confident sentence that isn't true is worse than no sentence.",
            "تحوّل أدوات الكتابة بالذكاء الاصطناعي الإعلانات الضعيفة إلى نصوص سلسة لكن بلا سند. وفي العلاقات العامة، الجملة الواثقة غير الصحيحة أسوأ من عدم وجودها."),
   solution=("Deterministic preflight rules check completeness, Gemini reviews every answer and extracts a claim inventory, a human approves, edits or rejects each claim, and three story angles and pitches are generated from approved claim IDs only.",
             "قواعد فحص مسبقة تتحقق من الاكتمال، ثم يراجع Gemini كل إجابة ويستخرج قائمة الادعاءات، ويوافق شخص على كل ادعاء أو يعدّله أو يرفضه، ثم تُولَّد ثلاث زوايا وعروض من معرّفات الادعاءات المعتمدة فقط."),
   architecture=("Next-compatible TypeScript app with server-side API routes for review and generation; API keys never reach the browser. Zod validates every model response, and a deterministic demo mode gives reliable presentations without calling the model.",
                 "تطبيق TypeScript بمسارات API على الخادم للمراجعة والتوليد، ولا تصل مفاتيح API إلى المتصفح. يتحقق Zod من كل استجابة للنموذج، ويوفر وضع العرض الثابت عروضًا موثوقة دون استدعاء النموذج."),
   challenges=("Enforcing grounding in code rather than in the prompt: every generated sentence must reference an approved claim ID, and a single unknown or rejected reference rejects the whole response. Provider failures reveal no partial output.",
               "فرض الالتزام بالمصادر في الكود لا في التعليمات: كل جملة مولدة يجب أن تشير إلى معرّف ادعاء معتمد، وأي إشارة غير معروفة أو مرفوضة ترفض الاستجابة كاملة. ولا تُعرض أي مخرجات جزئية عند فشل المزود."),
   lessons_learned=("Model output is untrusted input. Treating it with the same validation as user input, and making the verification boundary visible to the user, is what makes an AI tool safe to rely on.",
                    "مخرجات النموذج مدخلات غير موثوقة. التعامل معها بنفس التحقق المطبق على مدخلات المستخدم، وجعل حدود التحقق واضحة له، هو ما يجعل أداة الذكاء الاصطناعي جديرة بالاعتماد.")),
  role=("Sole developer", "مطور منفرد"), dur=("2026", "2026"), gh=GH + "pitchproof",
  tech=["TypeScript", "React", "Next.js", "Tailwind CSS", "Zod", "Gemini API", "Vitest"], tags=["AI", "Web App"]),

 dict(slug="seroevents-platform", sec="featured", st="progress", feat=3, pct=60, kind="Events · Web platform",
  title=("SeroEvents Platform", "منصة SeroEvents"),
  short=("Bilingual website and event platform for healthcare and scientific conferences in the UAE.", "موقع ومنصة فعاليات ثنائية اللغة للمؤتمرات الطبية والعلمية في الإمارات."),
  case=dict(
   description=("As Tech Lead at SeroEvents UAE I'm rebuilding the company's website into an event platform: bilingual English and Arabic, with the public event catalogue migrated from the original site.",
                "بصفتي القائد التقني في SeroEvents الإمارات، أعيد بناء موقع الشركة ليصبح منصة فعاليات ثنائية اللغة بالعربية والإنجليزية، مع نقل كتالوج الفعاليات العامة من الموقع السابق."),
   architecture=("Next.js 15 (App Router) with PostgreSQL through Prisma, Microsoft Graph for transactional email, and file storage kept alongside the database for backups. Runs behind a reverse proxy in production.",
                 "Next.js 15 مع PostgreSQL عبر Prisma، وMicrosoft Graph للبريد الإلكتروني، وتخزين الملفات بجانب قاعدة البيانات للنسخ الاحتياطي، ويعمل خلف Reverse Proxy في الإنتاج.")),
  role=("Tech Lead", "قائد تقني"), company=("SeroEvents UAE", "SeroEvents الإمارات"), dur=("2026 – present", "2026 – الآن"), url="https://seroevents.com",
  tech=["Next.js", "TypeScript", "PostgreSQL", "Prisma", "Docker"], tags=["Web App"]),

 dict(slug="kas-translation-system", sec="professional", st="completed", pct=100, kind="Localization · Tooling",
  title=("In-App Translation System", "نظام الترجمة داخل التطبيق"),
  short=("Translate a hosting platform in place: inline editing, msgid storage, translation states and history.", "ترجمة منصة استضافة في مكانها: تحرير مباشر وتخزين بالمعرفات وحالات الترجمة وسجلها."),
  case=dict(
   description=("Tooling that lets translators work directly inside the ALL-INKL platform instead of editing code: iframe-based inline editing, msgid storage, per-string states (new, ongoing, done, checked), attribute translation, per-page status, history and comments.",
                "أداة تتيح للمترجمين العمل داخل منصة ALL-INKL مباشرة دون تعديل الكود: تحرير داخل iframe، وتخزين بالمعرفات، وحالات لكل نص (جديد، قيد العمل، منجز، تمت مراجعته)، وترجمة السمات، وحالة لكل صفحة، وسجل وتعليقات."),
   problem=("Platform content had to be translated and maintained across languages, and translators needed context without touching source code.",
            "كان لا بد من ترجمة محتوى المنصة وصيانته بعدة لغات، واحتاج المترجمون إلى السياق دون لمس الكود."),
   challenges=("Cross-origin constraints between the editor and the framed pages, translating attributes such as title, tooltip and placeholder, and accessibility issues like aria-hidden warnings.",
               "قيود المصادر المختلفة بين المحرر والصفحات المضمنة، وترجمة السمات مثل العنوان والتلميح والنص المؤقت، ومشكلات الوصولية مثل تحذيرات aria-hidden.")),
  role=("Architecture, frontend and backend endpoints", "المعمارية والواجهة ونقاط الخادم"), company=("ALL-INKL.COM", "ALL-INKL.COM"), dur=("2024 – 2026", "2024 – 2026"),
  tech=["PHP", "JavaScript", "MySQL"], tags=["Dashboard"]),

 dict(slug="cctv-browser-viewer", sec="professional", st="completed", pct=100, kind="Streaming · Internal tool",
  title=("Browser CCTV Viewer", "عارض كاميرات المراقبة"),
  short=("Live and recorded RTSP camera feeds across offices, viewable in an ordinary browser.", "بث مباشر ومسجل لكاميرات RTSP في المكاتب عبر متصفح عادي."),
  case=dict(
   description=("A browser interface over an RTSPtoWeb streaming service: single, 1×2, 2×2 and 3×3 camera matrices, live view, playback with a seek bar, office tabs and camera mapping, with JWT-protected access.",
                "واجهة متصفح فوق خدمة بث RTSPtoWeb: شبكات عرض للكاميرات بأحجام مختلفة، وعرض مباشر، وتشغيل مع شريط تقديم، وتبويبات للمكاتب، وربط للكاميرات، مع وصول محمي بـ JWT."),
   challenges=("RTSP port conflicts, limits on concurrent streams, and Safari-specific playback failures over MSE/WebSocket.",
               "تعارض منافذ RTSP، وحدود البث المتزامن، ومشكلات تشغيل خاصة بمتصفح Safari عبر MSE وWebSocket.")),
  role=("Browser interface and integration", "واجهة المتصفح والتكامل"), company=("ALL-INKL.COM", "ALL-INKL.COM"), dur=("2025", "2025"),
  tech=["JavaScript", "Linux"], tags=["Dashboard"]),

 dict(slug="kas-internal-tools", sec="professional", st="completed", pct=100, kind="Data · Internal tools",
  title=("Internal Business Tools", "أدوات العمل الداخلية"),
  short=("Charts across multiple databases with automatic numeric-field detection, CSV/Excel export and admin access control.", "رسوم بيانية عبر قواعد بيانات متعددة مع اكتشاف الحقول الرقمية وتصدير CSV وExcel وصلاحيات إدارية."),
  case=dict(description=("Internal tools used day to day by the team: dynamic data visualization spanning multiple databases with month and session filtering, a lunch ordering system with per-person splitting, onboarding and data-entry forms, and GoJS mind maps saved by database ID.",
                         "أدوات داخلية يستخدمها الفريق يوميًا: عرض بيانات ديناميكي عبر قواعد بيانات متعددة مع تصفية بالشهر والجلسة، ونظام طلب غداء مع تقسيم لكل شخص، ونماذج تسجيل وإدخال بيانات، وخرائط ذهنية بـ GoJS.")),
  role=("Backend and frontend", "الخادم والواجهة"), company=("ALL-INKL.COM", "ALL-INKL.COM"), dur=("2024 – 2025", "2024 – 2025"),
  tech=["PHP", "MySQL", "JavaScript"], tags=["Dashboard"]),

 dict(slug="n8n-lead-agent", sec="building", st="progress", pct=40, kind="AI · Automation",
  title=("Lead Generation Agent", "وكيل توليد العملاء"),
  short=("Multi-workflow automation on self-hosted n8n that finds leads. Outreach and content generation are next.", "أتمتة متعددة المسارات على n8n مستضاف ذاتيًا تبحث عن العملاء المحتملين. التواصل وإنشاء المحتوى هما الخطوة التالية."),
  role=("Sole developer", "مطور منفرد"), dur=("2026 – present", "2026 – الآن"),
  tech=["n8n", "Docker", "Cloudflare"], tags=["AI", "Automation"]),

 dict(slug="portfolio-cms", sec="opensource", st="progress", pct=85, kind="Framework · CMS",
  title=("This Portfolio & CMS", "هذا الموقع ونظام إدارته"),
  short=("A hand-written PHP MVC framework with a bilingual, database-backed CMS and inline editing.", "إطار MVC مكتوب يدويًا بلغة PHP مع نظام إدارة محتوى ثنائي اللغة وتحرير مباشر."),
  case=dict(description=("Router, controllers, models and views written from scratch. Case studies are composed from ordered sections with many-to-many technology and tag relationships, and all copy lives in the database so it can change without a deploy. Dockerised, with separate development and production stacks.",
                         "الموجّه والمتحكمات والنماذج والواجهات مكتوبة من الصفر. تتكون دراسات الحالة من أقسام مرتبة مع علاقات بالتقنيات والوسوم، وكل النصوص في قاعدة البيانات لتتغير دون نشر جديد. يعمل في Docker مع بيئتين للتطوير والإنتاج.")),
  role=("Design and development", "التصميم والتطوير"), dur=("2025 – present", "2025 – الآن"), gh=GH + "portfolio-update", url="https://elsayedomar.com",
  tech=["PHP", "MySQL", "JavaScript", "Docker"], tags=["Web App"]),

 dict(slug="php-auth-admin-system", sec="opensource", st="completed", pct=100, kind="Framework · Auth",
  title=("PHP Auth & Admin System", "نظام مصادقة وإدارة بـ PHP"),
  short=("A mini framework in pure PHP: routing, middleware, session auth, role-based access and an admin dashboard.", "إطار مصغر بلغة PHP خالصة: توجيه ووسيط ومصادقة بالجلسات وصلاحيات حسب الدور ولوحة إدارة."),
  case=dict(description=("Built to understand what frameworks do internally: a custom router, Auth and Admin middleware, request/response abstraction, an autoloader, a rule-based validator, global exception handling with clean JSON errors, and a plain-JavaScript admin dashboard for managing users and roles. Dockerised with MySQL and phpMyAdmin.",
                         "بُني لفهم ما تفعله الأطر داخليًا: موجّه مخصص، ووسيط للمصادقة والإدارة، وتجريد للطلب والاستجابة، ومحمّل تلقائي، ومدقق بالقواعد، ومعالجة عامة للأخطاء بردود JSON، ولوحة إدارة بـ JavaScript لإدارة المستخدمين والأدوار.")),
  role=("Personal project", "مشروع شخصي"), dur=("2026", "2026"), gh=GH + "php-auth-admin-system",
  tech=["PHP", "MySQL", "JavaScript", "Docker"], tags=["Web App", "Dashboard"]),

 dict(slug="rock-paper-scissors", sec="opensource", st="completed", pct=100, kind="Game · JavaScript",
  title=("Rock, Paper, Scissors", "حجر ورقة مقص"),
  short=("My first game: first to three points wins, in plain HTML, CSS and JavaScript.", "أول لعبة لي: من يصل إلى ثلاث نقاط أولًا يفوز، بـ HTML وCSS وJavaScript فقط."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"), gh=GH + "rock-paper-scissors", url="https://r-p-s-game-5ca87a19c30b.herokuapp.com",
  tech=["JavaScript", "HTML5/CSS3"], tags=["Learning"]),

 dict(slug="flask-todo-app", sec="opensource", st="completed", pct=100, kind="Web app · Python",
  title=("Flask To-Do App", "تطبيق مهام Flask"),
  short=("A CRUD task manager in Flask and SQLite, deployed on Heroku.", "مدير مهام بعمليات CRUD باستخدام Flask وSQLite، منشور على Heroku."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"), gh=GH + "flask-todo-app", url="https://flaskcrudapptodolist-a663f04498c2.herokuapp.com/",
  tech=["Python", "Flask", "SQLite"], tags=["Web App", "Learning"]),

 dict(slug="laravel-portfolio-v1", sec="personal", st="archived", pct=100, kind="Portfolio · Laravel",
  title=("Portfolio v1 (Laravel)", "الموقع الشخصي الإصدار الأول"),
  short=("My earlier Laravel portfolio, deployed automatically through GitHub Actions.", "موقعي الشخصي السابق بـ Laravel، يُنشر تلقائيًا عبر GitHub Actions."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"),
  tech=["Laravel", "PHP", "GitHub"], tags=["Web App"]),

 dict(slug="laravel-medium-clone", sec="personal", st="archived", pct=100, kind="Blog · Laravel",
  title=("Medium Clone", "نسخة من Medium"),
  short=("A simple Laravel publishing app modelled on Medium.", "تطبيق نشر بسيط بـ Laravel على غرار Medium."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"), gh=GH + "Laravel-Medium-Clone",
  tech=["Laravel", "PHP", "JavaScript"], tags=["Web App", "Learning"]),

 dict(slug="fastapi-social-api", sec="experiments", st="archived", pct=100, kind="API · Python",
  title=("FastAPI Social Media API", "واجهة تواصل اجتماعي FastAPI"),
  short=("A social media REST API built while learning FastAPI.", "واجهة REST لشبكة اجتماعية بنيتها أثناء تعلم FastAPI."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"), gh=GH + "fastapi-socialmedia-app",
  tech=["Python", "FastAPI"], tags=["Mobile API", "Learning"]),

 dict(slug="fruit-disease-detection", sec="experiments", st="completed", pct=100, kind="AI · Research",
  title=("Fruit Disease Detection (CNN)", "اكتشاف أمراض الفاكهة بالشبكات العصبية"),
  short=("Research internship at VIT India comparing VGG16, VGG19, InceptionV3 and Xception on Indian fruit-disease images.", "تدريب بحثي في معهد فيلور بالهند لمقارنة نماذج VGG16 وVGG19 وInceptionV3 وXception على صور أمراض الفاكهة."),
  case=dict(
   description=("Transfer-learning study on apple, banana, guava and mixed Indian-fruit disease datasets, processed separately and together. Models were compared with accuracy and loss curves, confusion matrices, precision, recall and F1. In the reported runs VGG16 reached 98.5%, VGG19 99.0% and Xception 99.9% accuracy.",
                "دراسة تعلّم نقل على بيانات أمراض التفاح والموز والجوافة ومجموعة فواكه هندية مختلطة، عولجت منفصلة ومجتمعة. قورنت النماذج بمنحنيات الدقة والخسارة ومصفوفات الالتباس والدقة والاستدعاء وF1. وحققت VGG16 دقة 98.5% وVGG19 دقة 99.0% وXception دقة 99.9%."),
   problem=("Early, accurate detection of fruit disease helps farmers and exporters act before a crop is lost.",
            "الاكتشاف المبكر والدقيق لأمراض الفاكهة يساعد المزارعين والمصدرين على التصرف قبل خسارة المحصول.")),
  role=("Research intern", "متدرب بحثي"), company=("Vellore Institute of Technology", "معهد فيلور للتكنولوجيا"), dur=("Oct – Dec 2022", "أكتوبر – ديسمبر 2022"),
  gh=GH + "Machine-Deep-learning", tech=["Python", "TensorFlow", "Jupyter"], tags=["AI"]),

 dict(slug="no-show-appointments", sec="experiments", st="completed", pct=100, kind="Data · Analysis",
  title=("No-Show Medical Appointments", "تحليل التغيب عن المواعيد الطبية"),
  short=("What predicts whether a patient shows up? An analysis of 100,000+ Brazilian medical appointments.", "ما الذي يتنبأ بحضور المريض؟ تحليل لأكثر من 100 ألف موعد طبي في البرازيل."),
  role=("Personal project", "مشروع شخصي"), dur=("2022", "2022"), gh=GH + "no-show-medical-appointments",
  tech=["Python", "pandas", "Jupyter"], tags=["Data Analysis"]),

 dict(slug="bike-share-analysis", sec="experiments", st="completed", pct=100, kind="Data · Analysis",
  title=("Bike Share Data Analysis", "تحليل بيانات مشاركة الدراجات"),
  short=("Answering questions about bike-share usage with Python, from the Udacity Data Analysis Nanodegree.", "الإجابة عن أسئلة حول استخدام مشاركة الدراجات بـ Python ضمن برنامج Udacity لتحليل البيانات."),
  role=("Personal project", "مشروع شخصي"), dur=("2022", "2022"), gh=GH + "Bike-Share-Data-answering-questions-by-python-project",
  tech=["Python", "pandas"], tags=["Data Analysis", "Learning"]),

 dict(slug="javascript-fundamentals", sec="experiments", st="completed", pct=100, kind="JavaScript · Learning",
  title=("JavaScript Algorithms & Mini Apps", "خوارزميات وتطبيقات JavaScript"),
  short=("Small vanilla JavaScript apps, including a palindrome checker and the Dragon Repeller RPG.", "تطبيقات صغيرة بـ JavaScript، منها فاحص الكلمات المتناظرة ولعبة Dragon Repeller."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"), gh=GH + "JavaScript-Algorithms-and-Data-Structures",
  tech=["JavaScript", "HTML5/CSS3"], tags=["Learning"]),

 dict(slug="responsive-web-design", sec="experiments", st="completed", pct=100, kind="HTML & CSS · Learning",
  title=("Responsive Web Design Projects", "مشاريع التصميم المتجاوب"),
  short=("freeCodeCamp certification projects: survey form, product landing page, documentation page, tribute page and portfolio.", "مشاريع شهادة freeCodeCamp: نموذج استبيان وصفحة منتج وصفحة توثيق وصفحة تكريم وموقع شخصي."),
  role=("Personal project", "مشروع شخصي"), dur=("2025", "2025"), gh=GH + "freecodecamp-responsive-projects",
  tech=["HTML5/CSS3"], tags=["Learning"]),

 dict(slug="self-hosted-automation", sec="experiments", st="maintenance", pct=100, kind="Infrastructure · Automation",
  title=("Self-Hosted Automation Stack", "منصة أتمتة مستضافة ذاتيًا"),
  short=("n8n in Docker on an Ubuntu VPS, reached through a Cloudflare Tunnel instead of a public port.", "n8n داخل Docker على خادم Ubuntu، يُوصل إليه عبر Cloudflare Tunnel بدلًا من منفذ عام."),
  role=("Setup and operations", "الإعداد والتشغيل"), dur=("2025 – present", "2025 – الآن"),
  tech=["n8n", "Docker", "Linux", "Cloudflare"], tags=["Automation"]),
]

SEC_NAME = {"Featured Projects": 1, "Professional Projects": 2, "Personal Projects": 3, "Open Source & GitHub": 4, "Currently Building": 5, "Experiments & Learning": 6}
ST_NAME = {"Completed": 1, "In Progress": 2, "Maintenance": 3, "Paused": 4, "Archived": 5}


def font(size, bold=True):
    try:
        return ImageFont.truetype("/System/Library/Fonts/HelveticaNeue.ttc", size, index=1 if bold else 0)
    except OSError:
        return ImageFont.load_default()


def cover(p):
    W, H = 1200, 750
    rnd = random.Random(p["slug"])
    im = Image.new("RGB", (W, H), (18, 18, 20))
    glow = Image.new("RGB", (W, H))
    g = ImageDraw.Draw(glow)
    cx, cy = rnd.randint(650, 1050), rnd.randint(80, 350)
    for r, c in ((420, (60, 12, 96)), (260, (124, 58, 237)), (120, (168, 85, 247))):
        g.ellipse((cx - r, cy - r, cx + r, cy + r), fill=c)
    im = Image.blend(im, glow.filter(ImageFilter.GaussianBlur(140)), .55)
    d = ImageDraw.Draw(im)
    pts = [(rnd.randint(600, 1160), rnd.randint(40, 700)) for _ in range(14)]
    for a in pts:
        for b in pts:
            if a < b and (a[0]-b[0])**2 + (a[1]-b[1])**2 < 190**2:
                d.line((a, b), fill=(90, 70, 130), width=1)
    for x, y in pts:
        d.ellipse((x-4, y-4, x+4, y+4), fill=(192, 132, 252))
    COVERS.mkdir(parents=True, exist_ok=True)
    im.save(COVERS / f"{p['slug']}-hero.webp", quality=80, method=6)  # text-free: detail page draws its own title
    title, size = p["title"][0], 92
    while d.textlength(title, font=font(size)) > 1000 and size > 44:
        size -= 4
    ty = 440 - size
    d.rounded_rectangle((70, ty - 70, 70 + d.textlength(p["kind"].upper(), font=font(22)) + 36, ty - 24), 23, outline=(168, 85, 247), width=2, fill=(40, 22, 70))
    d.text((88, ty - 60), p["kind"].upper(), font=font(22), fill=(192, 132, 252))
    d.text((70, ty), title, font=font(size), fill=(244, 244, 247))
    x = 70
    for t in p["tech"][:4]:
        w = d.textlength(t, font=font(26, False)) + 40
        d.rounded_rectangle((x, 560, x + w, 612), 12, fill=(27, 27, 32), outline=(42, 42, 49), width=2)
        d.text((x + 20, 572), t, font=font(26, False), fill=(212, 212, 216))
        x += w + 14
    im.save(COVERS / f"{p['slug']}.webp", quality=82, method=6)


def q(v):
    return "NULL" if v is None else "'" + str(v).replace("\\", "\\\\").replace("'", "''") + "'"


def num(s, default=0):
    m = re.search(r"[\d,]+", s or "")
    return int(m.group().replace(",", "")) if m else default


def row_new(p, i):
    img = f"/assets/images/projects/{p['slug']}.webp"
    two = lambda k, j: (p.get(k) or ("", ""))[j]
    c = p.get("case", {})
    r = dict(title_en=p["title"][0], title_ar=p["title"][1], slug=p["slug"], section_id=SEC[p["sec"]], status_id=ST[p["st"]],
             featured_order=p.get("feat"), visibility="published", thumbnail=img, hero_image=img.replace(".webp", "-hero.webp"),
             short_description_en=p["short"][0], short_description_ar=p["short"][1],
             my_role_en=two("role", 0), my_role_ar=two("role", 1), company_en=two("company", 0), company_ar=two("company", 1),
             duration_en=two("dur", 0), duration_ar=two("dur", 1), team_size=1, contribution_percentage=100,
             user_count=0, performance_score=0, completion_percentage=p["pct"], display_order=100 + i,
             project_url=p.get("url", ""), github_url=p.get("gh", ""))
    for k in ("description", "problem", "solution", "architecture", "challenges", "lessons_learned"):
        en, ar = c.get(k, (p["short"] if k == "description" else ("", "")))
        r[f"{k}_en"], r[f"{k}_ar"] = en, ar
    return r, p["tech"], p["tags"]


def row_live(slug, snap, i):
    e, a = snap["en"], snap["ar"]
    m = e["metrics"]
    links = {icon: href for href, icon in e["links"]}
    r = dict(title_en=e["title"], title_ar=a["title"], slug=slug, section_id=SEC_NAME.get(e["section"], 3), status_id=ST_NAME.get(e["status"], 1),
             featured_order=1 if e["section"] == "Featured Projects" else None, visibility="published",
             thumbnail=f"/assets/images/projects/{slug}.webp", hero_image=f"/assets/images/projects/{slug}-hero.webp",
             company_en=e["company"], company_ar=a["company"],
             my_role_en=m.get("My Role", ""), my_role_ar=a["metrics"].get("دوري", ""), duration_en=m.get("Duration", ""), duration_ar=a["metrics"].get("المدة", ""),
             team_size=num(m.get("Team Size"), 1), contribution_percentage=num(m.get("My Contribution"), 100),
             performance_score=num(m.get("Performance Score")), user_count=num(m.get("Active Users")), completion_percentage=100, display_order=i,
             project_url=links.get("fas fa-external-link-alt", ""), github_url=links.get("fab fa-github", ""))
    for k in ("description", "problem", "solution", "architecture", "challenges", "lessons_learned"):
        r[f"{k}_en"], r[f"{k}_ar"] = e.get(k, ""), a.get(k, "")
    r["short_description_en"] = (e.get("description") or e.get("problem") or "").split("\n")[0][:300]
    r["short_description_ar"] = (a.get("description") or a.get("problem") or "").split("\n")[0][:300]
    return r, e["techs"], e["tags"]


def inserts(rows, only_if_new):
    out = []
    for r, techs, tags in rows:
        cols, vals = ",".join(r), ",".join(q(v) for v in r.values())
        if only_if_new:
            out.append(f"INSERT INTO projects ({cols}) SELECT {vals} FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM projects WHERE slug={q(r['slug'])});")
        else:
            out.append(f"INSERT INTO projects ({cols}) VALUES ({vals});")
        out.append(f"SET @pid = (SELECT id FROM projects WHERE slug={q(r['slug'])});")
        for t in techs:
            out.append(f"INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name={q(t)} LIMIT 1;")
        for t in tags:
            out.append(f"INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en={q(t)} LIMIT 1;")
    return out


def reference_rows():
    out = []
    for n, (icon, color, cat) in NEW_TECH.items():
        out.append(f"INSERT INTO technologies (name, icon, color, category) SELECT {q(n)},{q(icon)},{q(color)},{q(cat)} FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name={q(n)});")
    for n, (ar, slug) in NEW_TAGS.items():
        out.append(f"INSERT INTO tags (name_en, name_ar, slug) SELECT {q(n)},{q(ar)},{q(slug)} FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tags WHERE slug={q(slug)});")
    return out


snapshot = json.loads((HERE / "live-snapshot.json").read_text(encoding="utf-8"))
new_rows = [row_new(p, i) for i, p in enumerate(NEW)]
for p in NEW:
    cover(p)
for slug, s in snapshot.items():  # local-only covers for live projects (their real images are on the server)
    cover(dict(slug=slug, title=(s["en"]["title"].split(" – ")[0], ""), kind=s["en"]["section"].replace(" Projects", ""), tech=s["en"]["techs"]))

head = ["SET NAMES utf8mb4;"]
(ROOT / "database/updates/2026-09-27-projects.sql").write_text("\n".join(
    ["-- Adds the project catalogue. Built by database/projects/build.py. Safe to re-run:",
     "-- projects whose slug already exists (the 5 you added on the live site) are left untouched."]
    + head + reference_rows() + inserts(new_rows, True)) + "\n", encoding="utf-8")

live_rows = [row_live(s, v, i) for i, (s, v) in enumerate(snapshot.items())]
(ROOT / "database/dev/local-projects.sql").write_text("\n".join(
    ["-- LOCAL ONLY. Mirrors the live site after 2026-09-27-projects.sql: live snapshot + new projects."]
    + head + ["DELETE FROM projects;"] + reference_rows() + inserts(live_rows + new_rows, False)) + "\n", encoding="utf-8")
print(f"{len(live_rows)} live + {len(new_rows)} new projects")
