{{-- resources/views/public/pages/show.blade.php --}}
@extends('layouts.pu')

@php $pageTitles = ['presentation'=>'Présentation du Candidat','message'=>'Mon Message','programme'=>'Notre Programme de Mandat','projets'=>'Nos Projets Clés & Nos Engagements','gallery'=>'Galerie']; @endphp
@section('title', ($pageTitles[$page->type] ?? 'UF RELP') . ' — UF RELP')

@section('content')

    <style>
        :root {
            --blue:       #003682;
            --blue-dark:  #002560;
            --blue-light: #1a4a9a;
            --red:        #df0106;
            --red-dark:   #b50105;
            --white:      #ffffff;
            --off-white:  #f5f7fc;
            --gray-light: #e8edf5;
            --gray-mid:   #9aa5b8;
            --text:       #1a2340;
            --text-light: #4a5568;
            --border:     #d4daea;
        }

        /* ─────────────────────────────────
           SHARED HERO BANNER — SPLIT B/R
        ───────────────────────────────── */
        .uf-hero {
            background: linear-gradient(135deg, var(--blue) 0%, var(--blue) 55%, var(--red-dark) 55%, var(--red) 100%);
            padding: 3.5rem 2rem 2.75rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .uf-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(0deg,   transparent, transparent 39px, rgba(255,255,255,0.03) 39px, rgba(255,255,255,0.03) 40px),
                repeating-linear-gradient(90deg,  transparent, transparent 39px, rgba(255,255,255,0.03) 39px, rgba(255,255,255,0.03) 40px);
            pointer-events: none;
        }

        .uf-hero::after {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            left: 50%;
            transform: translateX(-50%) skewX(-8deg);
            width: 4px;
            background: rgba(255,255,255,0.15);
            pointer-events: none;
        }

        .uf-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255,255,255,0.55);
            font-size: 0.65rem;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .uf-hero-eyebrow::before {
            content: '';
            width: 36px;
            height: 1px;
            background: white;
            opacity: 0.5;
        }
        .uf-hero-eyebrow::after {
            content: '';
            width: 36px;
            height: 1px;
            background: white;
            opacity: 0.5;
        }

        .uf-hero h1 {
            font-size: clamp(1.6rem, 4vw, 2.6rem);
            font-weight: 800;
            color: white;
            margin: 0 0 0.75rem;
            line-height: 1.2;
            letter-spacing: -0.01em;
        }

        .uf-hero h1 span { color: rgba(255,255,255,0.75); text-shadow: 0 0 30px rgba(255,255,255,0.3); }

        .uf-hero p {
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.75;
            font-style: italic;
            font-weight: 300;
        }

        /* Alternating stripe bar under hero */
        .uf-hero-bar {
            height: 6px;
            background: repeating-linear-gradient(
                90deg,
                var(--blue)     0px,
                var(--blue)     60px,
                var(--red)      60px,
                var(--red)      120px
            );
        }

        /* ─────────────────────────────────
           PAGE WRAPPER
        ───────────────────────────────── */
        .uf-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 5rem;
        }

        /* ─────────────────────────────────
           SECTION TITLES — alternance
        ───────────────────────────────── */
        .sec-title {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .sec-title-line {
            flex: 1;
            min-width: 20px;
            height: 2px;
            background: linear-gradient(90deg, var(--blue) 0%, var(--red) 100%);
            opacity: 0.25;
        }

        .sec-title h2 {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--blue);
            white-space: normal;
            word-break: break-word;
            line-height: 1.4;
        }

        .sec-title.red h2 { color: var(--red); }
        .sec-title.red .dot { background: var(--blue); }

        .sec-title .dot {
            width: 8px;
            height: 8px;
            background: var(--red);
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ─────────────────────────────────
           CARD BASE
        ───────────────────────────────── */
        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .card-blue {
            background: var(--blue);
            color: white;
            border: none;
        }

        .card-red {
            background: var(--red);
            color: white;
            border: none;
        }

        /* ─────────────────────────────────
           ① PRESENTATION PAGE
        ───────────────────────────────── */
        .pres-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }


        .pres-quote-card {
            background: var(--blue);
            border-radius: 0.75rem;
            padding: 2rem 1.75rem;
            position: relative;
            overflow: hidden;
        }

        .pres-quote-card::before {
            content: '\201C';
            position: absolute;
            top: -1rem;
            left: 1rem;
            font-size: 7rem;
            font-weight: 900;
            color: rgba(223,1,6,0.18);
            line-height: 1;
            pointer-events: none;
        }

        .pres-quote-card blockquote {
            color: rgba(255,255,255,0.88);
            font-size: 0.95rem;
            line-height: 1.8;
            margin: 0 0 1.25rem;
            font-style: italic;
            font-weight: 300;
            position: relative;
            z-index: 1;
        }

        .pres-candidate-name {
            color: white;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(223,1,6,0.4);
            padding-top: 0.9rem;
        }

        .pres-candidate-name span {
            display: block;
            color: rgba(255,255,255,0.5);
            font-size: 0.72rem;
            font-weight: 400;
            margin-top: 0.2rem;
            letter-spacing: 0.06em;
        }

        .pres-text-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            border-left: 4px solid var(--red);
            padding: 2rem 1.75rem;
        }

        .pres-text-card h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--red);
            margin: 0 0 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--blue);
            display: inline-block;
        }

        .pres-text-card p {
            font-size: 0.88rem;
            line-height: 1.8;
            color: var(--text-light);
            margin: 0;
        }

        /* Experience timeline */
        .exp-timeline {
            margin: 2rem 0;
        }

        .exp-item {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
        }

        .exp-item:last-child { border-bottom: none; }

        .exp-year {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--red);
            letter-spacing: 0.06em;
            padding-top: 0.1rem;
        }

        .exp-title {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.45;
        }

        /* Skills grid */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 0.75rem;
            margin: 1.5rem 0;
        }

        .skill-chip {
            background: var(--off-white);
            border: 1px solid var(--border);
            border-left: 3px solid var(--blue);
            border-radius: 0.5rem;
            padding: 0.65rem 0.9rem;
            font-size: 0.8rem;
            color: var(--text);
            font-weight: 500;
            line-height: 1.4;
        }

        .skill-chip:nth-child(even) {
            border-left-color: var(--red);
        }

        /* Ambition list */
        .ambition-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }


        .ambition-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            font-size: 0.85rem;
            color: var(--text-light);
            line-height: 1.5;
            padding: 0.5rem 0;
        }

        .ambition-list li::before {
            content: '→';
            color: var(--red);
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 0.05rem;
        }

        /* ─────────────────────────────────
           ② MESSAGE PAGE
        ───────────────────────────────── */
        .msg-hero-quote {
            background: var(--red);
            border-radius: 0.75rem;
            padding: 2.25rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .msg-hero-quote::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: var(--blue);
        }

        .msg-hero-quote p {
            font-size: 1.05rem;
            font-style: italic;
            color: white;
            line-height: 1.8;
            font-weight: 300;
            margin: 0;
        }

        .msg-hero-quote cite {
            display: block;
            margin-top: 1rem;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.55);
            font-style: normal;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 600;
        }

        .msg-section {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 2rem 1.75rem;
            margin-bottom: 1.5rem;
            border-top: 3px solid var(--blue);
        }

        .msg-section:nth-child(even) {
            border-top-color: var(--red);
        }

        .msg-section h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--blue);
            margin: 0 0 1rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .msg-section:nth-child(even) h3 {
            color: var(--red);
        }

        .msg-section h3 i { color: var(--red); font-size: 0.95rem; }
        .msg-section:nth-child(even) h3 i { color: var(--blue); }

        .msg-section p, .msg-section li {
            font-size: 0.88rem;
            line-height: 1.8;
            color: var(--text-light);
        }

        .msg-heritage-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 0.75rem;
            margin: 1rem 0;
            list-style: none;
            padding: 0;
        }

        .msg-heritage-list li {
            background: var(--off-white);
            border: 1px solid var(--border);
            border-top: 3px solid var(--blue);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text);
            text-align: center;
        }

        .msg-heritage-list li:nth-child(even) {
            border-top-color: var(--red);
        }

        .msg-defis-list {
            counter-reset: defi;
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .msg-defis-list li {
            counter-increment: defi;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.87rem;
            color: var(--text-light);
            line-height: 1.55;
            padding: 0.5rem 0;
            border-bottom: 1px dashed var(--border);
        }

        .msg-defis-list li:last-child { border-bottom: none; }

        .msg-defis-list li::before {
            content: counter(defi, decimal-leading-zero);
            background: var(--blue);
            color: white;
            font-size: 0.68rem;
            font-weight: 700;
            min-width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 0.05rem;
        }

        .msg-defis-list li:nth-child(even)::before {
            background: var(--red);
        }

        .msg-crois-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .msg-crois-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            font-size: 0.87rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        .msg-crois-list li::before {
            content: '♦';
            color: var(--red);
            font-size: 0.65rem;
            margin-top: 0.35rem;
            flex-shrink: 0;
        }

        .msg-solicitation {
            background: linear-gradient(135deg, var(--blue) 0%, var(--blue) 50%, var(--red-dark) 50%, var(--red) 100%);
            border-radius: 0.75rem;
            padding: 2.5rem 2rem;
            text-align: center;
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
        }

        .msg-solicitation::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: repeating-linear-gradient(90deg, var(--red) 0px, var(--red) 30px, var(--blue) 30px, var(--blue) 60px);
        }

        .msg-solicitation p {
            font-size: 0.95rem;
            line-height: 1.85;
            color: rgba(255,255,255,0.82);
            font-weight: 300;
            margin: 0 0 1.5rem;
            font-style: italic;
        }

        .msg-ensemble {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .msg-ensemble span {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.45rem 1.2rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 2rem;
            color: white;
        }

        .msg-ensemble span.red { border-color: var(--red); color: white; background: var(--red); }

        /* ─────────────────────────────────
           ③ PROGRAMME PAGE
        ───────────────────────────────── */
        .prog-vision-box {
            background: var(--red);
            border-radius: 0.75rem;
            padding: 2.25rem 2rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .prog-vision-box::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: var(--blue);
        }

        .prog-vision-box .v-label {
            font-size: 0.65rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            display: block;
            margin-bottom: 0.75rem;
        }

        .prog-vision-box p {
            font-size: 1rem;
            font-style: italic;
            color: white;
            line-height: 1.8;
            font-weight: 300;
            max-width: 680px;
            margin: 0 auto;
        }

        /* 4 vision points */
        .prog-4pts {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .prog-pt {
            background: white;
            border: 1px solid var(--border);
            border-top: 3px solid var(--blue);
            border-radius: 0.625rem;
            padding: 1.25rem 1.1rem;
            text-align: center;
        }

        .prog-pt:nth-child(even) {
            border-top-color: var(--red);
        }

        .prog-pt .num {
            font-size: 2rem;
            font-weight: 900;
            color: var(--blue);
            line-height: 1;
            margin-bottom: 0.35rem;
            opacity: 0.18;
        }

        .prog-pt:nth-child(even) .num {
            color: var(--red);
        }

        .prog-pt p {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--blue);
            margin: 0;
            line-height: 1.4;
        }

        .prog-pt:nth-child(even) p {
            color: var(--red);
        }

        /* Pillars */
        .prog-pillars {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }


        .pillar-card {
            background: var(--blue);
            border-radius: 0.625rem;
            padding: 1.5rem 1.25rem;
            text-align: center;
            color: white;
        }

        .pillar-card:nth-child(2) {
            background: var(--red);
        }

        .pillar-card i {
            font-size: 1.75rem;
            color: rgba(255,255,255,0.4);
            margin-bottom: 0.6rem;
            display: block;
        }

        .pillar-card p {
            font-size: 0.83rem;
            font-weight: 600;
            line-height: 1.45;
            margin: 0;
        }

        /* ─────────────────────────────────
           AXES STRATÉGIQUES
        ───────────────────────────────── */
        .axes-list {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            margin-bottom: 2rem;
        }

        .axe-card {
            background: white;
            border-radius: 0.85rem;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,54,130,0.07);
            border: 1px solid var(--border);
        }

        .axe-card:hover { box-shadow: 0 8px 32px rgba(0,54,130,0.13); }
        .axe-card:nth-child(even):hover { box-shadow: 0 8px 32px rgba(223,1,6,0.13); }

        /* — Ligne titre : fond coloré pleine largeur — */
        .axe-row-title {
            background: var(--blue);
            padding: 1.1rem 1.75rem;
            text-align: center;
        }

        .axe-card:nth-child(even) .axe-row-title {
            background: var(--red);
        }

        .axe-num-badge {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 800;
            color: rgba(255,255,255,0.6);
            letter-spacing: 0.25em;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }

        .axe-name {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
            color: white;
            line-height: 1.4;
        }

        /* — Ligne objectif — */
        .axe-row-obj {
            padding: 1rem 1.75rem;
            border-bottom: 1px solid var(--border);
            background: var(--off-white);
        }

        .axe-row-label {
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--blue);
            display: block;
            margin-bottom: 0.4rem;
        }

        .axe-card:nth-child(even) .axe-row-label {
            color: var(--red);
        }

        .axe-row-text {
            font-size: 0.85rem;
            font-style: italic;
            color: var(--text-light);
            line-height: 1.7;
            margin: 0;
            text-align: justify;
        }

        /* — Ligne actions — */
        .axe-row-actions {
            padding: 1rem 1.75rem;
        }

        .axe-actions-list {
            list-style: none;
            padding: 0;
            margin: 0.4rem 0 0;
        }

        .axe-actions-list li {
            font-size: 0.82rem;
            color: var(--text-light);
            padding: 0.32rem 0 0.32rem 1.3rem;
            position: relative;
            line-height: 1.6;
            border-bottom: 1px dashed var(--border);
            text-align: justify;
        }

        .axe-actions-list li:last-child { border-bottom: none; }

        .axe-actions-list li::before {
            content: '—';
            position: absolute;
            left: 0;
            color: var(--blue);
            font-weight: 700;
        }

        .axe-card:nth-child(even) .axe-actions-list li::before { color: var(--red); }

        /* Mandat stats */
        .mandat-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.75rem;
            margin: 1.5rem 0;
        }

        .mandat-stat {
            background: var(--off-white);
            border: 1px solid var(--border);
            border-radius: 0.625rem;
            padding: 1rem 0.75rem;
            text-align: center;
        }

        .mandat-stat .val {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--blue);
            line-height: 1;
            display: block;
        }

        .mandat-stat:nth-child(even) .val {
            color: var(--red);
        }

        .mandat-stat .val.red { color: var(--red); }

        .mandat-stat .lbl {
            font-size: 0.68rem;
            color: var(--text-light);
            margin-top: 0.3rem;
            line-height: 1.3;
            font-weight: 500;
        }

        /* ─────────────────────────────────
           ④ PROJETS & ENGAGEMENTS PAGE
        ───────────────────────────────── */
        .proj-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 3rem;
        }

        .proj-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .proj-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 32px rgba(0,54,130,0.12);
        }

        .proj-card-header {
            background: var(--blue);
            padding: 1rem 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            text-align: center;
        }

        .proj-card:nth-child(even) .proj-card-header {
            background: var(--red);
        }

        .proj-num {
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 0.68rem;
            font-weight: 700;
            min-width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin: 0 auto 0.4rem;
        }

        .proj-card-header h4 {
            font-size: 0.82rem;
            font-weight: 700;
            color: white;
            margin: 0;
            letter-spacing: 0.04em;
            text-align: center;
        }

        .proj-card-body {
            padding: 1.1rem 1.25rem;
        }

        .proj-card-body p {
            font-size: 0.82rem;
            line-height: 1.72;
            color: var(--text-light);
            margin: 0;
            text-align: justify;
        }

        /* Engagements */
        .eng-list {
            counter-reset: eng;
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .eng-list li {
            counter-increment: eng;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.625rem;
            padding: 1rem 1.25rem;
            font-size: 0.88rem;
            color: var(--text-light);
            line-height: 1.55;
            transition: border-color 0.2s;
        }

        .eng-list li:hover { border-color: var(--blue); }
        .eng-list li:nth-child(even):hover { border-color: var(--red); }

        .eng-list li::before {
            counter-reset: none;
            content: counter(eng, decimal-leading-zero);
            background: var(--blue);
            color: white;
            font-size: 0.72rem;
            font-weight: 700;
            min-width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .eng-list li:nth-child(even)::before {
            background: var(--red);
        }

        /* ─────────────────────────────────
           GALLERY (unchanged logic, restyled)
        ───────────────────────────────── */
        .gal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
        }

        .gal-item {
            aspect-ratio: 4/3;
            border-radius: 0.625rem;
            overflow: hidden;
            background: var(--blue);
            border: 2px solid transparent;
            transition: border-color 0.2s, transform 0.2s;
            cursor: pointer;
        }

        .gal-item:hover {
            border-color: var(--red);
            transform: scale(1.02);
        }

        .gal-item {
            position: relative;
            overflow: hidden;
        }

        .gal-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s;
        }

        .gal-item:hover img {
            transform: scale(1.05);
        }

        .gal-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,54,130,0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.25s;
            color: white;
            font-size: 1.5rem;
        }

        .gal-item:hover .gal-overlay {
            opacity: 1;
        }

        /* ─────────────────────────────────
           PRINCIPLES CHIPS
        ───────────────────────────────── */
        .principles-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            margin: 1rem 0;
        }

        .principle-chip {
            background: var(--blue);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.9rem;
            border-radius: 2rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .principle-chip:nth-child(even) { background: var(--red); }
        .principle-chip.red { background: var(--red); }
        .principle-chip.blue { background: var(--blue); }

        /* À ajouter/modifier dans la section <style> */

        /* ─────────────────────────────────
           PHOTO CANDIDAT
        ───────────────────────────────── */
        .cand-photo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 2.5rem;
            padding-top: 0.5rem;
        }

        .cand-photo-inner {
            position: relative;
            display: inline-flex;
        }

        .cand-photo-deco {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .cand-photo-deco-1 {
            width: 340px;
            height: 340px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(0,54,130,0.08) 0%, transparent 70%);
        }

        .cand-photo-deco-2 {
            width: 280px;
            height: 280px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 2px dashed rgba(223,1,6,0.15);
            border-radius: 50%;
        }

        .cand-photo-frame {
            position: relative;
            z-index: 1;
            width: 240px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow:
                0 0 0 3px white,
                0 0 0 6px var(--blue),
                0 0 0 9px white,
                0 0 0 11px var(--red),
                0 20px 60px rgba(0,54,130,0.22);
            background: var(--blue);
        }

        .cand-photo-img {
            width: 100%;
            display: block;
            object-fit: cover;
            object-position: top center;
            aspect-ratio: 3/4;
        }

        .cand-photo-badge {
            background: linear-gradient(90deg, var(--blue) 50%, var(--red) 50%);
            padding: 0.9rem 1rem;
            text-align: center;
            border-top: 3px solid white;
        }

        .cand-photo-badge-name {
            display: block;
            color: white;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .cand-photo-badge-role {
            display: block;
            color: rgba(255,255,255,0.55);
            font-size: 0.65rem;
            margin-top: 0.25rem;
            letter-spacing: 0.04em;
            line-height: 1.4;
        }

        @media (max-width: 480px) {
            .cand-photo-frame {
                width: 200px;
            }
            .cand-photo-deco-1 { width: 280px; height: 280px; }
            .cand-photo-deco-2 { width: 230px; height: 230px; }
            .cand-photo-badge-name { font-size: 0.72rem; }
            .cand-photo-badge-role { font-size: 0.6rem; }
        }

        /* ─────────────────────────────────
           RESPONSIVE — MOBILE FIRST
        ───────────────────────────────── */

        /* Tablet */
        @media (max-width: 768px) {
            .uf-hero {
                padding: 2.5rem 1.25rem 2rem;
            }
            .uf-hero h1 {
                font-size: clamp(1.3rem, 5vw, 1.9rem);
                word-break: break-word;
                hyphens: auto;
            }
            .uf-hero p {
                font-size: 0.85rem;
                max-width: 100%;
                padding: 0 0.25rem;
            }
            .uf-page {
                padding: 2rem 1.25rem 4rem;
            }
            .pres-grid,
            .ambition-list {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .prog-pillars {
                grid-template-columns: 1fr 1fr;
            }
            .sec-title h2 {
                font-size: 0.63rem;
                letter-spacing: 0.12em;
            }
        }

        /* Small mobile */
        @media (max-width: 480px) {
            .uf-hero {
                padding: 2rem 0.9rem 1.75rem;
            }
            .uf-hero-eyebrow {
                font-size: 0.58rem;
                letter-spacing: 0.18em;
                gap: 0.5rem;
            }
            .uf-hero-eyebrow::before,
            .uf-hero-eyebrow::after {
                width: 20px;
            }
            .uf-hero h1 {
                font-size: clamp(1.15rem, 6vw, 1.6rem);
            }
            .uf-hero p {
                font-size: 0.78rem;
                line-height: 1.6;
            }
            .uf-page {
                padding: 1.5rem 0.9rem 3.5rem;
            }

            /* Section titles */
            .sec-title {
                gap: 0.5rem;
                margin-bottom: 1.2rem;
            }
            .sec-title h2 {
                font-size: 0.6rem;
                letter-spacing: 0.1em;
            }
            .sec-title .dot {
                width: 6px;
                height: 6px;
            }

            /* Cards padding */
            .pres-quote-card,
            .pres-text-card,
            .msg-section,
            .card {
                padding: 1.1rem 1rem !important;
            }

            .pres-quote-card blockquote {
                font-size: 0.83rem;
                line-height: 1.65;
            }
            .pres-candidate-name {
                font-size: 0.78rem;
                word-break: break-word;
            }
            .pres-candidate-name span {
                font-size: 0.62rem;
                white-space: normal;
                line-height: 1.4;
            }

            /* Grids → single column */
            .pres-grid,
            .ambition-list,
            .prog-4pts,
            .prog-pillars,
            .proj-grid,
            .skills-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            /* Timeline */
            .exp-item {
                grid-template-columns: 1fr;
                gap: 0.2rem;
                padding: 0.75rem 0;
            }
            .exp-year {
                font-size: 0.65rem;
            }
            .exp-title {
                font-size: 0.83rem;
            }

            /* Programme */
            .prog-pt {
                padding: 0.9rem;
            }
            .prog-vision-box {
                padding: 1.5rem 1rem;
            }
            .prog-vision-box p {
                font-size: 0.88rem;
            }
            .pillar-card {
                padding: 1.1rem 1rem;
            }

            /* Axes */
            .axe-row-title {
                padding: 0.85rem 1.1rem;
            }
            .axe-name {
                font-size: 0.83rem;
            }
            .axe-row-obj,
            .axe-row-actions {
                padding: 0.75rem 1.1rem;
            }
            .axe-actions-list li {
                font-size: 0.76rem;
            }

            /* Message page */
            .msg-hero-quote {
                padding: 1.4rem 1rem;
            }
            .msg-hero-quote p {
                font-size: 0.88rem;
                line-height: 1.7;
            }
            .msg-hero-quote cite {
                font-size: 0.72rem;
            }
            .msg-heritage-list {
                grid-template-columns: 1fr 1fr;
            }
            .msg-defis-list li {
                font-size: 0.8rem;
                gap: 0.5rem;
            }
            .msg-defis-list li::before {
                min-width: 22px;
                height: 22px;
                font-size: 0.58rem;
            }
            .msg-solicitation {
                padding: 1.75rem 1rem;
            }
            .msg-solicitation p {
                font-size: 0.85rem;
            }
            .msg-ensemble span {
                font-size: 0.62rem;
                padding: 0.35rem 0.75rem;
                white-space: normal;
                text-align: center;
            }

            /* Projets */
            .proj-card-header h4 {
                font-size: 0.73rem;
                word-break: break-word;
                line-height: 1.4;
            }
            .proj-card-header {
                padding: 0.8rem 1rem;
            }
            .proj-card-body {
                padding: 0.9rem 1rem;
            }
            .proj-card-body p {
                font-size: 0.78rem;
            }

            /* Engagements */
            .eng-list li {
                font-size: 0.78rem;
                padding: 0.8rem 0.9rem;
                gap: 0.65rem;
            }
            .eng-list li::before {
                min-width: 26px;
                height: 26px;
                font-size: 0.62rem;
            }

            /* Stats */
            .mandat-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
            }
            .mandat-stat {
                padding: 0.75rem 0.5rem;
            }
            .mandat-stat .val {
                font-size: 1.2rem;
            }
            .mandat-stat .lbl {
                font-size: 0.58rem;
            }

            /* Gallery */
            .gal-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
            }

            /* Chips */
            .principle-chip {
                font-size: 0.62rem;
                padding: 0.25rem 0.6rem;
            }
            .skill-chip {
                font-size: 0.76rem;
                padding: 0.55rem 0.75rem;
            }
        }

        /* Very small screens */
        @media (max-width: 360px) {
            .uf-hero h1 {
                font-size: 1.05rem;
            }
            .msg-heritage-list {
                grid-template-columns: 1fr;
            }
            .mandat-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }


    </style>

    {{-- ════════════════════════════════════════
         HERO BANNER (dynamic per page type)
    ════════════════════════════════════════ --}}
    @php
        $heroes = [
            'presentation' => [
                'eyebrow' => 'UF RELP · 2026 – 2030',
                'title'   => 'Présentation du <span>Candidat</span>',
                'sub'     => 'Komla Mawufemo Jeannot TSONYA — Directeur Technique Principal',
            ],
            'message' => [
                'eyebrow' => 'UF RELP · Vision & Ambition',
                'title'   => 'Mon <span>Message</span>',
                'sub'     => 'Notre héritage, nos défis, ma vision pour l\'UF RELP',
            ],
            'programme' => [
                'eyebrow' => 'UF RELP · Mandat 2026–2030',
                'title'   => 'Notre <span>Programme</span> de Mandat',
                'sub'     => 'Bâtir une Direction Technique structurée, moderne, inclusive et performante',
            ],
            'projets' => [
                'eyebrow' => 'UF RELP · Projets & Engagements',
                'title'   => 'Nos Projets <span>Clés</span> & Nos Engagements',
                'sub'     => '12 projets phares · 09 engagements fermes pour l\'excellence musicale',
            ],
            'gallery' => [
                'eyebrow' => '',
                'title'   => 'Notre <span>Galerie</span>',
                'sub'     => 'Quelques moments  clés de notre parcours',
            ],
        ];

        $h = $heroes[$page->type] ?? ['eyebrow' => 'UF RELP', 'title' => $page->type, 'sub' => ''];
    @endphp

    <div class="uf-hero">
        <div class="uf-hero-eyebrow">{{ $h['eyebrow'] }}</div>
        <h1>{!! $h['title'] !!}</h1>
        @if($h['sub']) <p>{{ $h['sub'] }}</p> @endif
    </div>
    <div class="uf-hero-bar"></div>

    {{-- ════════════════════════════════════════
         PAGE CONTENT
    ════════════════════════════════════════ --}}
    <div class="uf-page">

        @if($page->type === 'presentation')
            {{-- ──────────────────────────────
                 ① PRÉSENTATION
            ────────────────────────────── --}}

            {{-- Photo du candidat --}}
            <div class="cand-photo-wrap" data-aos="fade-up">
                <div class="cand-photo-inner">
                    <div class="cand-photo-frame">
                        <img src="{{ asset('images/mawufemo.jpeg') }}" alt="Komla Mawufemo Jeannot TSONYA" class="cand-photo-img">
                        <div class="cand-photo-badge">
                            <span class="cand-photo-badge-name">K. M. J. TSONYA</span>
                            <span class="cand-photo-badge-role">Candidat · Directeur Technique Principal</span>
                        </div>
                    </div>
                    <div class="cand-photo-deco cand-photo-deco-1"></div>
                    <div class="cand-photo-deco cand-photo-deco-2"></div>
                </div>
            </div>

            {{-- Quote + intro --}}
            <div class="pres-grid" data-aos="fade-up">
                <div class="pres-quote-card">
                    <blockquote>
                        « Servir l'UF-RELP comme Directeur Technique Principal représente pour moi la continuité naturelle
                        de mon engagement au service de la musique, de la formation et du développement des fanfares. »
                    </blockquote>
                    <div class="pres-candidate-name">
                        Komla Mawufemo Jeannot TSONYA
                        <span>Candidat · Directeur Technique Principal · UF RELP 2026–2030</span>
                    </div>
                </div>
                <div class="pres-text-card">
                    <h3>Parcours en bref</h3>
                    <p>
                        Juriste de formation et musicien passionné, Komla Mawufemo Jeannot TSONYA consacre depuis plus de
                        <strong>25 années</strong> sa vie à la pratique, à la formation et à la structuration des ensembles musicaux.
                        Percussionniste et trompettiste à ses débuts, il a progressivement évolué vers des responsabilités
                        de direction musicale, de formation d'instrumentistes et de coordination de projets musicaux.
                    </p>
                    <p>
                        Au fil des années, il a contribué à la création, à la formation et à l'encadrement de plusieurs ensembles choraux et fanfares,
                        tout en développant une solide expérience dans l'organisation d'événements musicaux d'envergure nationale et internationale.
                    </p>
                    <p>
                        Au sein de l'Union des Fanfares, il cumule <strong>dix (10) années d'engagement actif</strong>
                        (2010 – 2020), dans l'ancien UF-RESMA dont: :
                    </p>
                    <ul style="list-style:none;padding:0;margin:0.5rem 0 0;">
                        <li style="display:flex;align-items:flex-start;gap:0.5rem;font-size:0.85rem;color:var(--text-light);padding:0.25rem 0;">
                            <span style="color:var(--red);font-weight:700;flex-shrink:0;">•</span>
                            <span>Secrétaire Général pendant <strong>2 ans</strong></span>
                        </li>
                        <li style="display:flex;align-items:flex-start;gap:0.5rem;font-size:0.85rem;color:var(--text-light);padding:0.25rem 0;">
                            <span style="color:var(--red);font-weight:700;flex-shrink:0;">•</span>
                            <span>Vice-Président Exécutif pendant <strong>8 ans</strong></span>
                        </li>
                    </ul>
                    <p style="margin-top:0.75rem;">
                        Durant cette période, il a travaillé au cœur de l'Union, au contact direct des fanfares, des chefs et des équipes techniques,
                        contribuant à la mise en œuvre et au suivi de plusieurs projets majeurs de l'organisation.
                    </p>
                </div>
            </div>

            {{-- Expériences clés --}}
            <div class="card" style="padding:1.75rem 2rem;margin-bottom:2rem;" data-aos="fade-up">
                <div class="sec-title">
                    <div class="dot"></div>
                    <h2>Expériences Clés</h2>
                    <div class="sec-title-line"></div>
                </div>
                <div class="exp-timeline">
                    <div class="exp-item">
                        <div class="exp-year">2008 – 2016</div>
                        <div class="exp-title">Directeur Technique de la fanfare de Tokoin-Tamé</div>
                    </div>
                    <div class="exp-item">
                        <div class="exp-year">2017 – 2025</div>
                        <div class="exp-title">Directeur Musical de la Fédération des Chorales Amenuveve</div>
                    </div>
                    <div class="exp-item">
                        <div class="exp-year">Fondateur</div>
                        <div class="exp-title">Fondateur et Coordinateur Général de l'Association musicale Sublime Harmonie</div>
                    </div>
                    <div class="exp-item">
                        <div class="exp-year">UF-RESMA</div>
                        <div class="exp-title">Directeur du Comité d'Organisation de plusieurs séminaires de formation des fanfares (UF-RESMA)</div>
                    </div>
                    <div class="exp-item">
                        <div class="exp-year">2015</div>
                        <div class="exp-title">Président du comité d'organisation de la première compétition des fanfares de l'Union : « Fanfare Music Plus »</div>
                    </div>
                    <div class="exp-item">
                        <div class="exp-year">2009</div>
                        <div class="exp-title">Membre fondateur de l'ensemble vocal et artistique « Majesté Divine »</div>
                    </div>
                </div>

                {{-- Projets UF-RELP --}}
                <div style="margin-top:1.5rem;">
                    <p style="font-size:0.78rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--blue);margin:0 0 0.75rem;">
                        Projets structurants UF-RELP (2022 – 2024)
                    </p>
                    <div class="skills-grid" style="margin:0;">
                        <div class="skill-chip">Festival Wind Melody</div>
                        <div class="skill-chip">Flash Mob</div>
                        <div class="skill-chip">Sport Musical</div>
                        <div class="skill-chip">Noël en Fanfare</div>
                        <div class="skill-chip">Séminaire régional des fanfares (2024)</div>
                    </div>
                </div>

                {{-- Antenne Régionale SEACSC --}}
                <div style="margin-top:1.5rem;padding:1rem 1.25rem;background:var(--off-white);border:1px solid var(--border);border-left:3px solid var(--blue);border-radius:0.5rem;">
                    <p style="font-size:0.78rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--blue);margin:0 0 0.5rem;">
                        Antenne Régionale — SEACSC / EEPT
                    </p>
                    <p style="font-size:0.85rem;color:var(--text-light);line-height:1.7;margin:0;">
                        Au sein de l'Antenne Régionale de la <strong>Section Encadrement et Animation Cultuels et Socio-Culturels (SEACSC)</strong> de l'EEPT,
                        il intervient comme <strong>Chargé de la planification et de la formation</strong>, apportant son expertise aux régions
                        <strong>RESO, RESE et RESP</strong>.
                    </p>
                </div>

                {{-- Représentations internationales --}}
                <div style="margin-top:1.25rem;padding:1rem 1.25rem;background:var(--off-white);border:1px solid var(--border);border-left:3px solid var(--red);border-radius:0.5rem;">
                    <p style="font-size:0.78rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--red);margin:0 0 0.5rem;">
                        Rayonnement International
                    </p>
                    <p style="font-size:0.85rem;color:var(--text-light);line-height:1.7;margin:0 0 0.5rem;">
                        Son parcours l'a conduit à représenter et accompagner des ensembles musicaux lors d'événements internationaux, contribuant ainsi au rayonnement de la musique de fanfare au-delà des frontières :
                    </p>
                    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
                        <span style="background:var(--blue);color:white;font-size:0.73rem;font-weight:600;padding:0.3rem 0.85rem;border-radius:2rem;letter-spacing:0.05em;">🇫🇷 France</span>
                        <span style="background:var(--red);color:white;font-size:0.73rem;font-weight:600;padding:0.3rem 0.85rem;border-radius:2rem;letter-spacing:0.05em;">🇲🇦 Maroc</span>
                        <span style="background:var(--blue);color:white;font-size:0.73rem;font-weight:600;padding:0.3rem 0.85rem;border-radius:2rem;letter-spacing:0.05em;">🇨🇮 Côte d'Ivoire</span>
                    </div>
                </div>
            </div>

            {{-- Ce que son expérience apporte --}}
            <div data-aos="fade-up" style="margin-bottom:2rem;">
                <div class="sec-title red">
                    <div class="dot"></div>
                    <h2>Ce que son expérience apporte à l'UF-RELP</h2>
                    <div class="sec-title-line"></div>
                </div>
                <div class="skills-grid">
                    <div class="skill-chip">Connaissance approfondie des réalités des fanfares</div>
                    <div class="skill-chip">Expertise en formation et encadrement des musiciens</div>
                    <div class="skill-chip">Gestion et organisation de projets musicaux</div>
                    <div class="skill-chip">Vision élargie du développement des fanfares</div>
                    <div class="skill-chip">Aptitude à fédérer les talents internes</div>
                </div>
            </div>

            {{-- Ambition --}}
            <div class="card" style="padding:1.75rem 2rem;border-left:4px solid var(--red);" data-aos="fade-up">
                <div class="sec-title">
                    <div class="dot"></div>
                    <h2>Une Ambition</h2>
                    <div class="sec-title-line"></div>
                </div>
                <ul class="ambition-list">
                    <li>Renforcer la structuration de la direction technique</li>
                    <li>Développer des programmes de formation performants</li>
                    <li>Promouvoir l'excellence musicale des fanfares</li>
                    <li>Accompagner la nouvelle génération de musiciens</li>
                </ul>
            </div>

            {{-- Citation biblique de clôture --}}
            <div data-aos="fade-up" style="margin-top:2rem;text-align:center;padding:2rem 1.75rem;background:var(--off-white);border:1px solid var(--border);border-radius:0.75rem;border-top:4px solid var(--blue);">
                <p style="font-size:1rem;font-style:italic;color:var(--text);line-height:1.8;margin:0 0 0.75rem;font-weight:400;">
                    « Tout ce que nous faisons, faisons-le de bon cœur, comme pour le Seigneur et non pour des hommes. »
                </p>
                <span style="font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--blue);">— Colossiens 3 : 23</span>
            </div>


        @elseif($page->type === 'message')
            {{-- ──────────────────────────────
                 ② MON MESSAGE
            ────────────────────────────── --}}



            {{-- Héritage --}}
            <div class="msg-section" data-aos="fade-up">
                <h3><i class="fas fa-landmark"></i> Notre Héritage</h3>
                <p>L'UF RELP dispose aujourd'hui d'un héritage solide et respectable, fruit du travail des directions techniques successives :</p>
                <ul class="msg-heritage-list">
                    <li>Des fanfares engagées</li>
                    <li>Des responsables dévoués</li>
                    <li>Une fraternité vivante</li>
                    <li>Des musiciens talentueux</li>
                    <li>Une passion authentique pour la musique</li>
                </ul>
                <p style="margin-top:1rem;">Notre Union ne part pas de zéro. Elle a une histoire, une identité, une culture musicale et fraternelle précieuse — une base forte sur laquelle nous pouvons continuer à progresser.</p>

                {{-- Opening quote --}}
                <div class="msg-hero-quote" data-aos="fade-up">
                    <p>
                        « Notre responsabilité collective est de <strong style="color:white;">fructifier cet héritage sans le figer</strong>,
                        et de l'amener vers un niveau supérieur d'organisation et d'excellence. »
                    </p>
                    <cite>Komla Mawufemo Jeannot TSONYA</cite>
                </div>
            </div>

            {{-- Défis --}}
            <div class="msg-section" data-aos="fade-up">
                <h3><i class="fas fa-mountain"></i> Les Défis à Relever</h3>
                <p>Si le présent est riche, les enjeux de demain nous appellent à franchir un nouveau cap :</p>
                <ol class="msg-defis-list">
                    <li>Structurer et consolider durablement la Direction Technique régionale</li>
                    <li>Harmoniser les pratiques sans étouffer les identités propres à chaque fanfare</li>
                    <li>Renforcer la qualité musicale globale</li>
                    <li>Développer les capacités de formation des Directeurs Techniques, chefs et instrumentistes</li>
                    <li>Valoriser les compétences musicales et techniques internes</li>
                    <li>Renforcer et promouvoir l'implication de la gente féminine dans les responsabilités techniques</li>
                    <li>Encadrer et accompagner la nouvelle génération de musiciens</li>
                    <li>Promouvoir l'innovation et l'adoption de meilleures pratiques</li>
                    <li>Développer des partenariats stratégiques</li>
                </ol>
            </div>

            {{-- Ma Vision --}}
            <div class="msg-section" data-aos="fade-up">
                <h3><i class="fas fa-eye"></i> Ma Vision pour l'UF</h3>
                <p>Je suis convaincu que la qualité musicale ne progresse durablement que là où il y a :</p>
                <div class="principles-row">
                    <span class="principle-chip">Méthode</span>
                    <span class="principle-chip">Vision</span>
                    <span class="principle-chip">Suivi</span>
                    <span class="principle-chip">Transmission</span>
                </div>
                <p style="margin-top:1rem;">Ma vision n'est pas de tout recommencer — elle est de :</p>
                <ul class="msg-crois-list">
                    <li>Fructifier l'héritage existant</li>
                    <li>Structurer sans exclure</li>
                    <li>Élever le niveau technique sans perdre l'esprit fraternel</li>
                    <li>Faire de la formation un pilier stratégique</li>
                    <li>Faire de l'excellence une culture partagée</li>
                </ul>
            </div>

            {{-- Ce que je crois --}}
            <div class="msg-section" data-aos="fade-up">
                <h3><i class="fas fa-heart"></i> Ce que je Crois</h3>
                <ul class="msg-crois-list">
                    <li>Une direction technique inclusive, organisée et exigeante</li>
                    <li>Une Union où chaque compétence compte</li>
                    <li>Une valorisation pleine et assumée de la femme musicienne</li>
                    <li>Une formation continue comme moteur de progression</li>
                    <li>Une excellence technique qui renforce la fraternité au lieu de la diviser</li>
                </ul>
            </div>

            {{-- Solicitation --}}
            <div class="msg-solicitation" data-aos="fade-up">
                <p>
                    C'est avec humilité, expérience et détermination que je sollicite votre confiance pour servir l'UF RELP
                    en tant que Directeur Technique Principal pour le mandat 2026 – 2030.
                    Je me porte candidat non par ambition personnelle, mais par sens du devoir et par engagement
                    envers notre héritage commun.
                </p>
                <div style="font-size:0.85rem;font-weight:700;color:white;letter-spacing:0.05em;">
                    Komla Mawufemo Jeannot TSONYA<br>
                    <span style="color:rgba(255,255,255,0.5);font-weight:400;">Candidat · Directeur Technique Principal · UF RELP 2026–2030</span>
                </div>
                <div class="msg-ensemble">
                    <span>Ensemble, l'UF RELP avance</span>
                    <span class="red">Ensemble, Élevons notre niveau</span>
                    <span>Ensemble, Bâtissons des fanfares fortes</span>
                </div>
            </div>


        @elseif($page->type === 'programme')
            {{-- ──────────────────────────────
                 ③ NOTRE PROGRAMME DE MANDAT
            ────────────────────────────── --}}

            {{-- Vision box --}}
            <div class="prog-vision-box" data-aos="fade-up">
                <span class="v-label">Notre Vision</span>
                <p>
                    Bâtir une Direction Technique structurée, moderne, inclusive et performante, capable d'élever
                    durablement le niveau musical de toutes les fanfares, tout en respectant leurs identités
                    et en valorisant les talents internes.
                </p>
            </div>

            {{-- Vision 4 pts --}}
            <div class="sec-title" data-aos="fade-up">
                <div class="dot"></div>
                <h2>La Vision en 4 Points</h2>
                <div class="sec-title-line"></div>
            </div>
            <div class="prog-4pts" data-aos="fade-up">
                <div class="prog-pt"><div class="num">01</div><p>Structurer sans rigidifier</p></div>
                <div class="prog-pt"><div class="num">02</div><p>Harmoniser sans uniformiser</p></div>
                <div class="prog-pt"><div class="num">03</div><p>Élever le niveau sans exclure</p></div>
                <div class="prog-pt"><div class="num">04</div><p>Valoriser les talents</p></div>
            </div>

            {{-- Nos 3 Piliers --}}
            <div class="sec-title red" data-aos="fade-up">
                <div class="dot"></div>
                <h2>Nos 03 Piliers</h2>
                <div class="sec-title-line"></div>
            </div>
            <div class="prog-pillars" data-aos="fade-up">
                <div class="pillar-card"><i class="fas fa-sitemap"></i><p>Une Direction Technique organisée et moderne</p></div>
                <div class="pillar-card"><i class="fas fa-music"></i><p>L'élévation du niveau musical collectif</p></div>
                <div class="pillar-card"><i class="fas fa-users"></i><p>L'humain au cœur de la technique</p></div>
            </div>

            {{-- Principes & Proposition de valeur --}}
            <div class="card" style="padding:1.5rem 1.75rem;margin-bottom:2rem;" data-aos="fade-up">

                {{-- En-têtes des deux colonnes --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:0.75rem;">
                    <p style="font-size:0.72rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--blue);margin:0;">
                        Nos Principes de Travail
                    </p>
                    <p style="font-size:0.72rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--blue);margin:0;">
                        Notre Proposition de Valeur
                    </p>
                </div>

                {{-- Ligne 1 : Rigueur + Écoute → Proposition 1 --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;padding:0.5rem 0;border-bottom:1px dashed var(--border);align-items:center;">
                    <div style="display:flex;flex-direction:column;gap:0.4rem;">
                        <span class="principle-chip" style="width:fit-content;">Rigueur</span>
                        <span class="principle-chip" style="width:fit-content;">Écoute</span>
                    </div>
                    <div style="font-size:0.8rem;color:var(--text-light);padding-left:1.1rem;position:relative;line-height:1.5;">
                        <span style="position:absolute;left:0;color:var(--red);">→</span>
                        Une Direction Technique institutionnelle moderne
                    </div>
                </div>

                {{-- Ligne 2 : Transparence → Proposition 2 --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;padding:0.5rem 0;border-bottom:1px dashed var(--border);align-items:center;">
                    <div>
                        <span class="principle-chip" style="width:fit-content;">Transparence</span>
                    </div>
                    <div style="font-size:0.8rem;color:var(--text-light);padding-left:1.1rem;position:relative;line-height:1.5;">
                        <span style="position:absolute;left:0;color:var(--red);">→</span>
                        Une vision long terme avec des livrables concrets
                    </div>
                </div>

                {{-- Ligne 3 : Vision → Proposition 3 --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;padding:0.5rem 0;border-bottom:1px dashed var(--border);align-items:center;">
                    <div>
                        <span class="principle-chip red" style="width:fit-content;">Vision</span>
                    </div>
                    <div style="font-size:0.8rem;color:var(--text-light);padding-left:1.1rem;position:relative;line-height:1.5;">
                        <span style="position:absolute;left:0;color:var(--red);">→</span>
                        Une culture de performance, de reconnaissance et d'inclusion
                    </div>
                </div>

                {{-- Ligne 4 : Esprit d'unité → Proposition 4 --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;padding:0.5rem 0;align-items:center;">
                    <div>
                        <span class="principle-chip" style="width:fit-content;">Esprit d'unité</span>
                    </div>
                    <div style="font-size:0.8rem;color:var(--text-light);padding-left:1.1rem;position:relative;line-height:1.5;">
                        <span style="position:absolute;left:0;color:var(--red);">→</span>
                        Une rupture positive avec l'improvisation organisationnelle
                    </div>
                </div>

            </div>

            {{-- Axes stratégiques --}}
            <div class="sec-title" data-aos="fade-up">
                <div class="dot"></div>
                <h2>Les Axes Stratégiques — Objectifs Clés — Actions Concrètes</h2>
                <div class="sec-title-line"></div>
            </div>

            @php
                $axes = [
                    ['num'=>'01','title'=>'Structurer, consolider et moderniser durablement l\'organisation technique régionale',
                     'obj'=>'Installer une Direction Technique organisée, lisible, efficace et traçable.',
                     'actions'=>['Structuration administrative et organisationnelle (Créations des pôles)','Mise en place des chronos de gestion','Élaboration d\'un manuel de procédures et de fonctionnement','Planification annuelle des activités musicales','Déploiement d\'un système numérique de gestion et de suivi','Réalisation d\'un audit technique annuel','Production de rapports techniques périodiques']],
                    ['num'=>'02','title'=>'Harmoniser les pratiques musicales et techniques tout en préservant les identités',
                     'obj'=>'Créer une base technique commune tout en respectant l\'identité de chaque fanfare.',
                     'actions'=>['Élaboration d\'un référentiel technique régional standardisé','Définition de standards techniques communs','Création d\'un répertoire musical régional commun','Espaces réguliers d\'échange entre Directeurs Techniques']],
                    ['num'=>'03','title'=>'Renforcer durablement la qualité musicale des fanfares',
                     'obj'=>'Élever durablement le niveau artistique et technique des fanfares.',
                     'actions'=>['Diagnostic technique annuel des fanfares','Évaluations périodiques et annuelles des performances musicales','Mise en place d\'un tableau de bord régional de performance','Création d\'une base de données technique des fanfares','Consolidation de la compétition biannuelle inter-fanfares']],
                    ['num'=>'04','title'=>'Renforcer les capacités des chefs et instrumentistes',
                     'obj'=>'Développer des compétences solides, adaptées et évolutives.',
                     'actions'=>['Création d\'un programme structuré de formation continue','Organisation de séminaires et ateliers techniques spécialisés','Création du Symposium annuel des Directeurs Techniques','Modernisation et restructuration systémique des séminaires régionaux','Création d\'un programme spécifique pour percussionnistes','Création d\'un programme de valorisation des rythmes traditionnelles']],
                    ['num'=>'05','title'=>'Identifier, valoriser et exploiter les compétences musicales et techniques internes',
                     'obj'=>'Faire des talents internes un moteur de performance et d\'autonomie.',
                     'actions'=>['Mise en place d\'un système d\'identification des talents internes','Création d\'une base de données des compétences','Programme de reconnaissance individuelle et collective','Valorisation des œuvres des compositeurs et arrangeurs de l\'Union','Réflexion stratégique sur la fanfare centrale']],
                    ['num'=>'06','title'=>'Valoriser et renforcer l\'implication de la gente féminine',
                     'obj'=>'Renforcer la place des femmes dans les responsabilités techniques.',
                     'actions'=>['Promotion des femmes aux responsabilités techniques et décisionnelles','Organisation d\'ateliers sur le leadership féminin','Renforcement stratégique de la fanfare féminine','Partenariats avec des organisations promouvant l\'égalité des genres','Création de prix spéciaux de l\'excellence féminine']],
                    ['num'=>'07','title'=>'Accompagner et encadrer la nouvelle génération de musiciens',
                     'obj'=>'Assurer la relève et transmettre une vision durable.',
                     'actions'=>['Conception d\'un parcours structuré d\'intégration des jeunes musiciens','Sessions d\'orientation musicale et de formation à l\'éthique','Création du Prix Jeunes Talents','Accompagnement vers des responsabilités futures']],
                    ['num'=>'08','title'=>'Promouvoir l\'innovation et l\'adoption de meilleures pratiques',
                     'obj'=>'Moderniser les méthodes techniques et pédagogiques.',
                     'actions'=>['Adoption d\'outils numériques modernes de gestion et d\'évaluation','Création d\'un espace de partage et d\'innovation technique','Utilisation de supports pédagogiques modernes','Capitalisation et diffusion des bonnes pratiques','Benchmarking des meilleures pratiques nationales']],
                    ['num'=>'09','title'=>'Développer des partenariats stratégiques et mobiliser des ressources',
                     'obj'=>'Soutenir durablement le développement technique et musical.',
                     'actions'=>['Développement de partenariats avec institutions académiques et sponsors','Élaboration d\'un plan de partenariat et de sponsoring','Collaboration interrégionale (RESO, RESE, RESP…)','Mise en place d\'un plan de mobilisation des ressources techniques','Animation des plateformes digitales (YouTube, réseaux sociaux)']],
                ];
            @endphp

            <div class="axes-list">
                @foreach($axes as $axe)
                    <div class="axe-card" data-aos="fade-up">

                        {{-- Ligne 1 : Axe N : Titre --}}
                        <div class="axe-row-title">
                            <span class="axe-num-badge">Axe {{ $axe['num'] }} :</span>
                            <span class="axe-name">{{ $axe['title'] }}</span>
                        </div>

                        {{-- Ligne 2 : Objectif principal --}}
                        <div class="axe-row-obj">
                            <div class="axe-row-label">Objectif principal :</div>
                            <p class="axe-row-text">{{ $axe['obj'] }}</p>
                        </div>

                        {{-- Ligne 3 : Actions concrètes --}}
                        <div class="axe-row-actions">
                            <div class="axe-row-label">Actions concrètes :</div>
                            <ul class="axe-actions-list">
                                @foreach($axe['actions'] as $action)
                                    <li>{{ $action }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Mandat en bref --}}
            <div class="sec-title red" data-aos="fade-up">
                <div class="dot"></div>
                <h2>Notre Mandat en Bref</h2>
                <div class="sec-title-line"></div>
            </div>
            <div class="mandat-stats" data-aos="fade-up">
                <div class="mandat-stat"><span class="val">01</span><span class="lbl">Vision</span></div>
                <div class="mandat-stat"><span class="val">01</span><span class="lbl">Équipe</span></div>
                <div class="mandat-stat"><span class="val red">07</span><span class="lbl">Objectifs</span></div>
                <div class="mandat-stat"><span class="val red">09</span><span class="lbl">Engagements</span></div>
                <div class="mandat-stat"><span class="val">05</span><span class="lbl">Principes</span></div>
                <div class="mandat-stat"><span class="val red">12</span><span class="lbl">Projets</span></div>
                <div class="mandat-stat"><span class="val">100+</span><span class="lbl">Actions</span></div>
                <div class="mandat-stat"><span class="val">56+</span><span class="lbl">Fanfares</span></div>
                <div class="mandat-stat"><span class="val">112+</span><span class="lbl">DT</span></div>
                <div class="mandat-stat"><span class="val red">1500+</span><span class="lbl">Instrumentistes</span></div>
            </div>

            <div class="msg-solicitation" style="margin-top:2rem;" data-aos="fade-up">
                <p>
                    « Notre mandat sera un mandat de service, de rigueur et de vision. Nous nous engageons à travailler
                    avec tous, pour élever chacun, et à laisser à l'UF RELP une Direction Technique plus forte
                    qu'à notre arrivée. »
                </p>
            </div>


        @elseif($page->type === 'projets')
            {{-- ──────────────────────────────
                 ④ NOS PROJETS CLÉS & NOS ENGAGEMENTS
            ────────────────────────────── --}}

            <div class="sec-title" data-aos="fade-up">
                <div class="dot"></div>
                <h2>Nos 12 Projets Phares</h2>
                <div class="sec-title-line"></div>
            </div>

            @php
                $projets = [
                    ['num'=>'01','name'=>'PERFORMANCE PLUS',    'desc'=>'Parce que l\'organisation est la clé de l\'excellence, nous mettrons en place une Direction Technique solide, organisée et efficace. Un cadre durable pour élever les standards et assurer un suivi stratégique de toutes les fanfares.'],
                    ['num'=>'02','name'=>'HARMONIA',             'desc'=>'Nous créerons un répertoire commun qui valorise les compositeurs et arrangeurs internes. Une identité musicale forte qui inspire et fédère toutes les fanfares de la région. L\'harmonie fait notre force.'],
                    ['num'=>'03','name'=>'ACADÉMIE D\'EXCELLENCE MUSICALE ET DE LEADERSHIP', 'desc'=>'Parce que l\'excellence se construit avec vision et passion, nous travaillerons à la mise en place d\'une plateforme qui assure transmission, rigueur et rayonnement durable. Elle aura pour mission de former, inspirer et structurer nos talents musicaux et leaders de demain.'],
                    ['num'=>'04','name'=>'SYMPOSIUM RÉGIONAL DES DIRECTEURS TECHNIQUES',     'desc'=>'Il nous faut élever les standards par le partage de savoir. Nous créerons un espace annuel d\'échanges, de bonnes pratiques et de développement stratégique afin de renforcer l\'unité et l\'expertise des Directeurs Techniques pour des fanfares plus performantes.'],
                    ['num'=>'05','name'=>'ELITE',                'desc'=>'L\'excellence est notre identité. Nous consoliderons et moderniserons les séminaires existants pour perfectionner les compétences. Repenser la Fanfare Centrale comme référence de performance et d\'innovation. ELITE, l\'excellence structurée.'],
                    ['num'=>'06','name'=>'FANFARE MUSIC PLUS',   'desc'=>'Parce que la performance nourrit la passion, nous consoliderons la compétition inter-fanfares pour stimuler le talent et la discipline en le transformant en un événement fédérateur et motivant pour tous les musiciens.'],
                    ['num'=>'07','name'=>'DRUMMERS',             'desc'=>'Parce que le rythme unit et inspire, nous créerons un parcours complet pour renforcer les compétences des percussionnistes et stimuler leur créativité pour faire rayonner nos rythmes traditionnels et innovants.'],
                    ['num'=>'08','name'=>'O\'RYTHM',             'desc'=>'Un événement unique pour célébrer nos racines et notre créativité par la mise en avant des rythmes locaux appliqués aux cantiques et morceaux populaires. O\'RYTHM, la tradition portée par l\'excellence.'],
                    ['num'=>'09','name'=>'EXCELLENCIA',          'desc'=>'Programme de reconnaissance et de distinctions des fanfares, compositeurs, arrangeurs et musiciens pour inspirer l\'excellence individuelle et collective. Récompenser le mérite, inspirer la relève.'],
                    ['num'=>'10','name'=>'LES PRIX FANFAR\'ELLES', 'desc'=>'Nous célébrerons la force féminine au cœur de l\'UF RELP. Ces femmes au service de la musique fanfare. Un programme pour valoriser leur talent, discipline et leadership par des prix et distinctions.'],
                    ['num'=>'11','name'=>'PRIX JEUNES TALENTS',  'desc'=>'Pour assurer la pérennité des fanfares, il nous faut encourager et encadrer la nouvelle génération de musiciens. Demain commence aujourd\'hui.'],
                    ['num'=>'12','name'=>'BRASS STARTER',        'desc'=>'Créer un vivier de talents précoces et passionnés pour l\'avenir des fanfares avec un parcours d\'intégration et de formation pour les jeunes musiciens aspirants. Brass Starter : Initier, former, passionner — la musique dès l\'enfance.'],
                ];
            @endphp

            <div class="proj-grid">
                @foreach($projets as $proj)
                    <div class="proj-card" data-aos="fade-up">
                        <div class="proj-card-header">
                            <div class="proj-num">{{ $proj['num'] }}</div>
                            <h4>{{ $proj['name'] }}</h4>
                        </div>
                        <div class="proj-card-body">
                            <p>{{ $proj['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Nos 09 Engagements --}}
            <div class="sec-title red" data-aos="fade-up">
                <div class="dot"></div>
                <h2>Nos 09 Engagements</h2>
                <div class="sec-title-line"></div>
            </div>

            @php
                $engagements = [
                    'Mettre en place une Direction Technique efficace, structurée, moderne et traçable',
                    'Créer un socle technique commun respectant la diversité des fanfares',
                    'Améliorer continuellement les performances musicales régionales',
                    'Élever le niveau technique, pédagogique et musical des acteurs clés',
                    'Faire des talents internes un levier de développement durable',
                    'Renforcer et accroître la participation et le leadership féminin dans la technique musicale',
                    'Assurer la relève technique et la transmission des valeurs',
                    'Moderniser les méthodes techniques et pédagogiques',
                    'Soutenir durablement les ambitions techniques de l\'Union',
                ];
            @endphp

            <ol class="eng-list" data-aos="fade-up">
                @foreach($engagements as $eng)
                    <li>{{ $eng }}</li>
                @endforeach
            </ol>

            {{-- Citation biblique et slogan de clôture --}}
            <div data-aos="fade-up" style="margin-top:2.5rem;text-align:center;padding:2.25rem 1.75rem;background:linear-gradient(135deg, var(--blue) 0%, var(--blue) 55%, var(--red-dark) 55%, var(--red) 100%);border-radius:0.75rem;position:relative;overflow:hidden;">
                <div style="position:absolute;inset:0;background-image:repeating-linear-gradient(0deg,transparent,transparent 39px,rgba(255,255,255,0.03) 39px,rgba(255,255,255,0.03) 40px),repeating-linear-gradient(90deg,transparent,transparent 39px,rgba(255,255,255,0.03) 39px,rgba(255,255,255,0.03) 40px);pointer-events:none;"></div>
                <p style="font-size:1.05rem;font-style:italic;color:rgba(255,255,255,0.92);line-height:1.85;margin:0 0 0.75rem;font-weight:300;position:relative;z-index:1;">
                    « Louez-le au son de la trompette !<br>Louez-le avec le luth et la harpe ! »
                </p>
                <span style="display:block;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.6);margin-bottom:1.25rem;position:relative;z-index:1;">— Psaume 150 : 3</span>
                <div style="height:1px;background:rgba(255,255,255,0.2);margin:0 auto 1.25rem;max-width:200px;position:relative;z-index:1;"></div>
                <p style="font-size:0.88rem;font-weight:600;letter-spacing:0.06em;color:white;margin:0;position:relative;z-index:1;font-style:italic;">
                    Ensemble, pour des fanfares plus performantes.
                </p>
            </div>


        @elseif($page->type === 'gallery')
            {{-- ──────────────────────────────
                 ⑤ GALERIE — statique
            ────────────────────────────── --}}

            {{-- Grille statique : images dans public/i/ --}}
            <div class="gal-grid">
                    <div class="gal-item" onclick="openLightbox(0)">
                    <img src="/i/9.jpeg" alt="Photo galerie 1" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(1)">
                    <img src="/i/6.jpeg" alt="Photo galerie 2" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>

                <div class="gal-item" onclick="openLightbox(0)">
                    <img src="/i/7.jpeg" alt="Photo galerie 1" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(1)">
                    <img src="/i/8.jpeg" alt="Photo galerie 2" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>

                   <div class="gal-item" onclick="openLightbox(0)">
                    <img src="/i/10.jpeg" alt="Photo galerie 1" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(1)">
                    <img src="/i/11.jpeg" alt="Photo galerie 2" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>

                <div class="gal-item" onclick="openLightbox(0)">
                    <img src="/i/1.jpeg" alt="Photo galerie 1" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(1)">
                    <img src="/i/2.jpeg" alt="Photo galerie 2" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(2)">
                    <img src="/i/3.jpeg" alt="Photo galerie 3" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(3)">
                    <img src="/i/4.jpeg" alt="Photo galerie 4" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                <div class="gal-item" onclick="openLightbox(4)">
                    <img src="/i/5.jpeg" alt="Photo galerie 5" loading="lazy">
                    <div class="gal-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
            </div>

            {{-- Lightbox --}}
            <div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:9999;align-items:center;justify-content:center;flex-direction:column;">
                <button onclick="closeLightbox()" style="position:absolute;top:1.25rem;right:1.5rem;background:none;border:none;color:white;font-size:2rem;cursor:pointer;line-height:1;">
                    <i class="fas fa-times"></i>
                </button>
                <button onclick="prevImage()" style="position:absolute;left:1.25rem;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.15);border:none;color:white;font-size:1.5rem;cursor:pointer;width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <img id="lightbox-img" src="" alt="" style="max-width:90vw;max-height:82vh;border-radius:0.5rem;box-shadow:0 8px 40px rgba(0,0,0,0.6);object-fit:contain;">
                <div id="lightbox-counter" style="color:rgba(255,255,255,0.5);font-size:0.8rem;margin-top:1rem;letter-spacing:0.1em;"></div>
                <button onclick="nextImage()" style="position:absolute;right:1.25rem;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.15);border:none;color:white;font-size:1.5rem;cursor:pointer;width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            @push('scripts')
                <script>
                    const galleryImages = [
                        '/i/1.jpeg',
                        '/i/2.jpeg',
                        '/i/3.jpeg',
                        '/i/4.jpeg',
                        '/i/5.jpeg',
                    ];
                    let currentIndex = 0;

                    function openLightbox(index) {
                        currentIndex = index;
                        updateLightbox();
                        const lb = document.getElementById('lightbox');
                        lb.style.display = 'flex';
                        document.body.style.overflow = 'hidden';
                    }

                    function closeLightbox() {
                        document.getElementById('lightbox').style.display = 'none';
                        document.body.style.overflow = '';
                    }

                    function prevImage() {
                        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
                        updateLightbox();
                    }

                    function nextImage() {
                        currentIndex = (currentIndex + 1) % galleryImages.length;
                        updateLightbox();
                    }

                    function updateLightbox() {
                        document.getElementById('lightbox-img').src = galleryImages[currentIndex];
                        document.getElementById('lightbox-counter').textContent = (currentIndex + 1) + ' / ' + galleryImages.length;
                    }

                    document.getElementById('lightbox').addEventListener('click', function(e) {
                        if (e.target === this) closeLightbox();
                    });

                    document.addEventListener('keydown', function(e) {
                        const lb = document.getElementById('lightbox');
                        if (lb.style.display === 'none') return;
                        if (e.key === 'ArrowLeft')  prevImage();
                        if (e.key === 'ArrowRight') nextImage();
                        if (e.key === 'Escape')     closeLightbox();
                    });
                </script>
            @endpush


        @endif

    </div>{{-- /uf-page --}}

@endsection