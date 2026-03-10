<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>

    {{-- Open Graph --}}
    <meta property="og:title" content="UF-RELP" />
    <meta property="og:description" content="Candidat au poste de Directeur Technique Principal (UF RELP 2026 – 2030)" />
    <meta property="og:image" content="{{ asset('images/share-default.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="UF RELP" />
    <meta name="twitter:description" content="Découvrez nos formations, programmes et actualités" />
    <meta name="twitter:image" content="{{ asset('images/share-default.jpeg') }}" />

    <link rel="icon" type="image/jpeg" href="{{ asset('images/eept.jpeg') }}">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

    @stack('styles')

    <style>
        :root {
            --blue: #003682;
            --blue-dark: #002560;
            --blue-light: #1a4a9a;
            --red: #df0106;
            --red-dark: #b50105;
            --white: #ffffff;
            --off-white: #f5f7fc;
            --gray-light: #e8edf5;
            --gray-mid: #9aa5b8;
            --text: #1a2340;
            --text-light: #4a5568;
        }

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: var(--off-white);
            margin: 0;
            color: var(--text);
        }

        /* ──────────────────────────────
           LOADER
        ────────────────────────────── */
        .loader {
            border-top-color: var(--blue);
            animation: spinner 0.6s linear infinite;
        }

        @keyframes spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ──────────────────────────────
           SCROLLBAR
        ────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--blue-dark); }

        /* ──────────────────────────────
           DESKTOP NAVBAR
        ────────────────────────────── */
        .uf-topbar {
            background: var(--blue);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 3px 16px rgba(0,54,130,0.25);
        }

        .uf-topbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: stretch;
            justify-content: center;
            padding: 0 1.5rem;
        }

        /* 5-menu desktop nav */
        .uf-nav-list {
            display: flex;
            align-items: stretch;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0;
        }

        .uf-nav-list li a {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            padding: 1.1rem 1.1rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            transition: all 0.25s;
            border-bottom: 3px solid transparent;
            white-space: nowrap;
        }

        .uf-nav-list li a i {
            font-size: 0.85rem;
        }

        .uf-nav-list li a:hover {
            color: white;
            border-bottom-color: rgba(223,1,6,0.5);
            background: rgba(255,255,255,0.06);
        }

        .uf-nav-list li a.active {
            color: white;
            border-bottom-color: var(--red);
            background: rgba(255,255,255,0.08);
            font-weight: 700;
        }

        /* Red accent divider between items */
        .uf-nav-list li + li {
            border-left: 1px solid rgba(255,255,255,0.1);
        }

        /* ──────────────────────────────
           FLASH MESSAGES
        ────────────────────────────── */
        .flash-wrap {
            max-width: 1200px;
            margin: 1rem auto 0;
            padding: 0 1.5rem;
        }

        /* ──────────────────────────────
           MOBILE NAV (bottom)
        ────────────────────────────── */
        .mobile-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -4px 20px rgba(0,54,130,0.15);
            z-index: 50;
            padding: 0.4rem 0.5rem;
            padding-bottom: env(safe-area-inset-bottom, 0.4rem);
            display: none;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            border-top: 3px solid var(--blue);
        }

        .mobile-nav-inner {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.4rem 0.35rem;
            color: var(--gray-mid);
            text-decoration: none;
            font-size: 0.6rem;
            font-weight: 600;
            border-radius: 10px;
            flex: 1;
            transition: all 0.2s ease;
            text-align: center;
            letter-spacing: 0.02em;
        }

        .mobile-nav-item i {
            font-size: 1.3rem;
            margin-bottom: 0.2rem;
            transition: transform 0.2s ease;
        }

        .mobile-nav-item span {
            line-height: 1.2;
            max-width: 55px;
        }

        .mobile-nav-item:hover {
            color: var(--blue);
            background: var(--gray-light);
        }

        .mobile-nav-item.active {
            color: var(--blue);
            background: rgba(0,54,130,0.07);
        }

        .mobile-nav-item.active i {
            color: var(--blue);
        }

        /* Active red dot indicator */
        .mobile-nav-item.active::after {
            content: '';
            display: block;
            width: 4px;
            height: 4px;
            background: var(--red);
            border-radius: 50%;
            margin: 2px auto 0;
        }

        @media (max-width: 768px) {
            .mobile-nav { display: block; }
            .uf-topbar { display: none; }
            main { padding-bottom: 5.5rem; }
        }

        @media (max-width: 860px) {
            .uf-nav-list li a {
                padding: 1.1rem 0.7rem;
                font-size: 0.65rem;
            }
        }

        /* ──────────────────────────────
           SCROLL TO TOP BUTTON
        ────────────────────────────── */
        #scroll-to-top {
            position: fixed;
            bottom: 5.5rem;
            right: 1.25rem;
            background: var(--blue);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 4px 16px rgba(0,54,130,0.35);
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
            z-index: 40;
        }

        #scroll-to-top:hover { background: var(--red); }

        @media (min-width: 769px) {
            #scroll-to-top { bottom: 2rem; }
        }

        /* ──────────────────────────────
           CONTENT STYLES (shared)
        ────────────────────────────── */
        .page-content ul {
            list-style-type: none;
            padding-left: 1.5rem;
            margin: 1.2rem 0;
        }

        .page-content ul li {
            position: relative;
            padding-left: 1.75rem;
            margin-bottom: 0.6rem;
            line-height: 1.6;
        }

        .page-content ul li::before {
            content: '▸';
            color: var(--blue);
            font-weight: bold;
            font-size: 1rem;
            position: absolute;
            left: 0;
            top: 0;
        }

        .page-content p {
            margin-bottom: 1.1rem;
            line-height: 1.75;
        }

        .page-content strong { color: var(--text); font-weight: 600; }

        .page-content blockquote {
            border-left: 4px solid var(--blue);
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            background: rgba(0,54,130,0.04);
            font-style: italic;
            color: var(--text-light);
            border-radius: 0 0.5rem 0.5rem 0;
        }
    </style>
</head>
<body class="antialiased">



<!-- ── DESKTOP NAVIGATION ── -->
<nav class="uf-topbar">
    <div class="uf-topbar-inner">
        @php
            $menus = [
                'presentation' => ['label' => 'Présentation',               'icon' => 'fa-user-tie'],
                'message'      => ['label' => 'Mon Message',                'icon' => 'fa-comment-dots'],
                'programme'    => ['label' => 'Notre Programme de Mandat',  'icon' => 'fa-list-check'],
                'projets'      => ['label' => 'Nos Projets Clés & Engagements', 'icon' => 'fa-rocket'],
                'gallery'      => ['label' => 'Galerie',                    'icon' => 'fa-images'],
            ];
        @endphp

        <ul class="uf-nav-list">
            @foreach($menus as $type => $menu)
                <li>
                    <a href="{{ route('public.page', $type) }}"
                       class="{{ request()->is('page/' . $type) || request()->routeIs('public.page', $type) ? 'active' : '' }}">
                        <i class="fas {{ $menu['icon'] }}"></i>
                        {{ $menu['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

<!-- Flash Messages -->
@if(session('success'))
    <div class="flash-wrap">
        <div style="background:#dcfce7;border-left:4px solid #22c55e;color:#166534;padding:0.75rem 1rem;border-radius:0.375rem;display:flex;align-items:center;gap:0.5rem;">
            <i class="fas fa-check-circle"></i>
            <p style="margin:0;">{{ session('success') }}</p>
            <button onclick="this.parentElement.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;color:#166534;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="flash-wrap">
        <div style="background:#fee2e2;border-left:4px solid #ef4444;color:#991b1b;padding:0.75rem 1rem;border-radius:0.375rem;display:flex;align-items:center;gap:0.5rem;">
            <i class="fas fa-exclamation-circle"></i>
            <p style="margin:0;">{{ session('error') }}</p>
            <button onclick="this.parentElement.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;color:#991b1b;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

<!-- Main Content -->
<main class="fade-in">
    @yield('content')
</main>

<!-- ── MOBILE NAVIGATION (bottom) ── -->
<nav class="mobile-nav md:hidden">
    <div class="mobile-nav-inner">
        <a href="{{ route('public.page', 'presentation') }}"
           class="mobile-nav-item {{ request()->is('page/presentation') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i>
            <span>Présentation</span>
        </a>
        <a href="{{ route('public.page', 'message') }}"
           class="mobile-nav-item {{ request()->is('page/message') ? 'active' : '' }}">
            <i class="fas fa-comment-dots"></i>
            <span>Mon Message</span>
        </a>
        <a href="{{ route('public.page', 'programme') }}"
           class="mobile-nav-item {{ request()->is('page/programme') ? 'active' : '' }}">
            <i class="fas fa-list-check"></i>
            <span>Programme</span>
        </a>
        <a href="{{ route('public.page', 'projets') }}"
           class="mobile-nav-item {{ request()->is('page/projets') ? 'active' : '' }}">
            <i class="fas fa-rocket"></i>
            <span>Projets</span>
        </a>
        <a href="{{ route('public.page', 'gallery') }}"
           class="mobile-nav-item {{ request()->is('page/gallery') ? 'active' : '' }}">
            <i class="fas fa-images"></i>
            <span>Galerie</span>
        </a>
    </div>
</nav>

<!-- Scroll to Top -->
<button id="scroll-to-top" aria-label="Retour en haut">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Scripts -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ duration: 700, once: true });

    const scrollBtn = document.getElementById('scroll-to-top');
    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            scrollBtn.style.display = 'flex';
        } else {
            scrollBtn.style.display = 'none';
        }
    });
    scrollBtn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.showLoading = function () {
        document.getElementById('loading-overlay').classList.remove('hidden');
        document.getElementById('loading-overlay').classList.add('flex');
    };
    window.hideLoading = function () {
        document.getElementById('loading-overlay').classList.add('hidden');
        document.getElementById('loading-overlay').classList.remove('flex');
    };
</script>

@stack('scripts')
</body>
</html>
