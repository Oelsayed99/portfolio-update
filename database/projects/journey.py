#!/usr/bin/env python3
"""Journey timeline events (facts from the CV, GitHub and Omar's own account).

  python3 database/projects/journey.py  ->  database/updates/2026-09-28-journey.sql

The timeline orders by created_at, so each event's created_at is set to when it happened.
The SQL removes the four placeholder entries (by exact title) and inserts these events,
skipping any title that already exists, so it is safe to re-run.
"""
import pathlib

ROOT = pathlib.Path(__file__).resolve().parents[2]
J = "/assets/images/journey/"
P = "/assets/images/projects/"

PLACEHOLDERS = ['Launched "Apex Finance" Platform', "Promoted to Senior Software Engineer",
                "AWS Certified Solutions Architect", "Machine Learning Specialization"]

# (created_at, tag_type, (date_en, date_ar), (tag_en, tag_ar), (title_en, title_ar), (desc_en, desc_ar), image)
CAREER, PROJECT, EDU, CERT = ("career", ("CAREER", "مسيرة مهنية")), ("project", ("PROJECT", "مشروع")), ("learning", ("EDUCATION", "تعليم")), ("cert", ("CERTIFICATE", "شهادة"))
E = [
 ("2019-01-01", CAREER, ("During university", "أثناء الدراسة"), ("Started freelancing", "بداية العمل الحر"),
  ("Small web projects on Upwork and Fiverr, and for people in my network, while studying Computer Science.", "مشاريع ويب صغيرة على Upwork وFiverr ولأشخاص من شبكة معارفي أثناء دراستي لعلوم الحاسب."), J + "01-egypt-1.webp"),
 ("2022-06-01", CERT, ("2022", "2022"), ("Data Analysis Professional Nanodegree", "نانو ديجري تحليل البيانات الاحترافي"),
  ("Government-sponsored scholarship from MCIT and Udacity. Projects included bike-share and medical no-show analyses in Python.", "منحة حكومية من وزارة الاتصالات وUdacity، شملت مشاريع لتحليل بيانات مشاركة الدراجات والتغيب عن المواعيد الطبية بـ Python."), None),
 ("2022-07-01", EDU, ("2022", "2022"), ("B.Sc. in Computer Science, MUST", "بكالوريوس علوم الحاسب، جامعة مصر للعلوم والتكنولوجيا"),
  ("Graduated in Information Technology with a Computer Science major. Overall grade Very Good; graduation project graded Excellent.", "تخرجت في تكنولوجيا المعلومات تخصص علوم الحاسب بتقدير عام جيد جدًا ومشروع تخرج بتقدير امتياز."), None),
 ("2022-10-01", CAREER, ("Oct – Dec 2022", "أكتوبر – ديسمبر 2022"), ("ML research internship in India", "تدريب بحثي في تعلم الآلة بالهند"),
  ("Machine and deep learning research at Vellore Institute of Technology, comparing VGG16, VGG19, InceptionV3 and Xception on fruit-disease images.", "بحث في تعلم الآلة والتعلم العميق بمعهد فيلور للتكنولوجيا، لمقارنة نماذج VGG16 وVGG19 وInceptionV3 وXception على صور أمراض الفاكهة."), J + "02-india-1.webp"),
 ("2024-01-01", CAREER, ("Jan 2024", "يناير 2024"), ("Moved to Dubai: first engineer at ALL-INKL's Gulf branch", "الانتقال إلى دبي: أول مهندس في فرع ALL-INKL بالخليج"),
  ("Joined ALL-INKL.COM as the first software engineer at their first GCC branch, on Palm Jumeirah, working with teams in Dubai and Germany.", "انضممت إلى ALL-INKL.COM كأول مهندس برمجيات في أول فرع لها في الخليج، في نخلة جميرا، بالعمل مع فرق في دبي وألمانيا."), J + "04-dubai-1.webp"),
 ("2024-06-01", PROJECT, ("2024", "2024"), ("One search system for the whole KAS panel", "نظام بحث واحد للوحة KAS بالكامل"),
  ("Built multi-term search with exclusions, highlighting, sorting and pagination once, then reused it across the hosting control panel.", "بنيت بحثًا متعدد الكلمات مع الاستبعاد والتظليل والترتيب والترقيم مرة واحدة، واستخدمته عبر لوحة تحكم الاستضافة كاملة."), None),
 ("2024-09-01", PROJECT, ("2024", "2024"), ("In-app translation system", "نظام الترجمة داخل التطبيق"),
  ("Designed inline, in-context translation for the platform: msgid storage, per-string states, attribute translation and history.", "صممت نظام ترجمة مباشر داخل المنصة: تخزين بالمعرفات وحالات لكل نص وترجمة السمات وسجل التعديلات."), None),
 ("2025-03-01", PROJECT, ("2025", "2025"), ("Browser CCTV viewer", "عارض كاميرات المراقبة في المتصفح"),
  ("Live and recorded RTSP camera feeds across offices in the browser, with camera matrices, playback and JWT access.", "بث مباشر ومسجل لكاميرات RTSP في المكاتب عبر المتصفح، مع شبكات عرض وتشغيل ووصول عبر JWT."), None),
 ("2025-06-01", PROJECT, ("2025", "2025"), ("Self-hosted automation stack", "منصة أتمتة مستضافة ذاتيًا"),
  ("Set up n8n in Docker on my own Ubuntu VPS behind a Cloudflare Tunnel, and started building automation agents on it.", "أعددت n8n داخل Docker على خادم Ubuntu خاص خلف Cloudflare Tunnel، وبدأت بناء وكلاء أتمتة عليه."), None),
 ("2026-01-15", CAREER, ("Jan 2026", "يناير 2026"), ("Two years at ALL-INKL", "عامان في ALL-INKL"),
  ("Wrapped up two years building the KAS control panel and internal tools, and moved on to client work and my own products.", "أنهيت عامين من تطوير لوحة تحكم KAS والأدوات الداخلية، وانتقلت إلى العمل مع العملاء ومنتجاتي الخاصة."), None),
 ("2026-02-24", PROJECT, ("2026", "2026"), ("Delivered Flow Egypt", "تسليم Flow Egypt"),
  ("A bilingual real-estate website, from design and development to deployment, email and DNS, as sole developer.", "موقع عقارات ثنائي اللغة، من التصميم والتطوير حتى النشر والبريد وDNS، كمطور منفرد."), P + "flow-egypt.webp"),
 ("2026-05-13", PROJECT, ("Apr – May 2026", "أبريل – مايو 2026"), ("Delivered Super Speed", "تسليم Super Speed"),
  ("Bilingual corporate site with a right-click inline CMS for a security services company, in native PHP. Awaiting client launch.", "موقع شركة ثنائي اللغة مع نظام إدارة محتوى بالنقر الأيمن لشركة خدمات أمنية بلغة PHP، بانتظار إطلاق العميل."), P + "super-speed.webp"),
 ("2026-07-02", PROJECT, ("Jul 2026", "يوليو 2026"), ("Started building YaxiGo", "بداية بناء YaxiGo"),
  ("Sole developer of an international rail booking platform, with replaceable train and payment providers and full runbooks.", "مطور منفرد لمنصة حجز قطارات دولية بمزودي قطارات ودفع قابلين للاستبدال وأدلة تشغيل كاملة."), P + "yaxigo-international-travel-booking-platform.webp"),
 ("2026-08-07", PROJECT, ("Aug 2026", "أغسطس 2026"), ("Built MonyMonk", "بناء MonyMonk"),
  ("A currency exchange ledger that refuses inexact money math, with 900+ test assertions and architecture decision records.", "دفتر حسابات لصرف العملات يرفض أي عملية حسابية غير دقيقة، مع أكثر من 900 اختبار وسجلات للقرارات المعمارية."), P + "monymonk.webp"),
 ("2026-09-05", PROJECT, ("Sep 2026", "سبتمبر 2026"), ("Launched PitchProof", "إطلاق PitchProof"),
  ("An AI briefing tool where the model can only cite claims a human has approved, enforced in code.", "أداة ذكاء اصطناعي لا يستشهد فيها النموذج إلا بادعاءات وافق عليها إنسان، ويُفرض ذلك في الكود."), P + "pitchproof.webp"),
 ("2026-09-20", CAREER, ("2026", "2026"), ("Tech Lead at SeroEvents UAE", "قائد تقني في SeroEvents الإمارات"),
  ("Leading engineering: code review and releases, infrastructure and email, procurement, SEO and analytics, and the rebuild of the event platform.", "أقود الجانب الهندسي: مراجعة الكود والإصدارات، والبنية التحتية والبريد، والمشتريات، وSEO والتحليلات، وإعادة بناء منصة الفعاليات."), J + "05-now-2.webp"),
 ("2026-09-27", PROJECT, ("Sep 2026", "سبتمبر 2026"), ("Redesigned this portfolio", "إعادة تصميم هذا الموقع"),
  ("New brand, bilingual CMS-driven pages and a full project catalogue, on my own hand-written PHP framework.", "هوية جديدة وصفحات ثنائية اللغة تُدار من نظام المحتوى وكتالوج مشاريع كامل، على إطار PHP كتبته بنفسي."), None),
]


def q(v):
    return "NULL" if v is None else "'" + str(v).replace("\\", "\\\\").replace("'", "''") + "'"


out = ["-- Journey timeline events. Built by database/projects/journey.py. Safe to re-run.", "SET NAMES utf8mb4;",
       "DELETE FROM journey WHERE title_en IN (" + ", ".join(q(t) for t in PLACEHOLDERS) + ");"]
for i, (at, (ttype, tag), date, title, desc, img) in enumerate(E):
    cols = dict(date_en=date[0], date_ar=date[1], title_en=title[0], title_ar=title[1], description_en=desc[0], description_ar=desc[1],
                tag_en=tag[0], tag_ar=tag[1], tag_type=ttype, side="left" if i % 2 == 0 else "right", image=img or "", created_at=f"{at} 12:00:00")
    out.append(f"INSERT INTO journey ({', '.join(cols)}) SELECT {', '.join(q(v) for v in cols.values())} FROM DUAL "
               f"WHERE NOT EXISTS (SELECT 1 FROM journey WHERE title_en = {q(title[0])});")
path = ROOT / "database/updates/2026-09-28-journey.sql"
path.write_text("\n".join(out) + "\n", encoding="utf-8")
print(f"{len(E)} events -> {path.relative_to(ROOT)}")
