#!/usr/bin/env python3
"""Journey timeline events (facts from the CV, GitHub and Omar's own account).

  python3 database/projects/journey.py  ->  database/updates/2026-09-28-journey.sql

The timeline orders by created_at, so each event's created_at is set to when it happened.
Projects are no longer listed here: they join the timeline through projects.timeline_date.
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
 ("2026-01-15", CAREER, ("Jan 2026", "يناير 2026"), ("Two years at ALL-INKL", "عامان في ALL-INKL"),
  ("Wrapped up two years building the KAS control panel and internal tools, and moved on to client work and my own products.", "أنهيت عامين من تطوير لوحة تحكم KAS والأدوات الداخلية، وانتقلت إلى العمل مع العملاء ومنتجاتي الخاصة."), None),
 ("2026-09-20", CAREER, ("2026", "2026"), ("Tech Lead at SeroEvents UAE", "قائد تقني في SeroEvents الإمارات"),
  ("Leading engineering: code review and releases, infrastructure and email, procurement, SEO and analytics, and the rebuild of the event platform.", "أقود الجانب الهندسي: مراجعة الكود والإصدارات، والبنية التحتية والبريد، والمشتريات، وSEO والتحليلات، وإعادة بناء منصة الفعاليات."), J + "05-now-2.webp"),
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
