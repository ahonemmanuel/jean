<?php
// app/Http/Controllers/PublicPageController.php

namespace App\Http\Controllers;

class PublicPageController extends Controller
{
    /**
     * Pages disponibles avec leurs titres
     */
    private const PAGES = [
        'presentation' => 'Présentation du Candidat',
        'message'      => 'Mon Message',
        'programme'    => 'Notre Programme de Mandat',
        'projets'      => 'Nos Projets Clés & Nos Engagements',
        'gallery'      => 'Galerie',
    ];

    /**
     * Afficher une page statique par son type
     */
    public function show(string $type)
    {
        if (!array_key_exists($type, self::PAGES)) {
            abort(404);
        }

        // Objet statique — aucune base de données
        $page = (object) [
            'type'  => $type,
            'title' => self::PAGES[$type],
        ];

        return view('public.pages.show', compact('page'));
    }
}
