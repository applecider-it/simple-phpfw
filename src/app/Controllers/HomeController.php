<?php

namespace App\Controllers;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    /** トップ画面 */
    public function index()
    {
        return $this->render('home.index');
    }

    /** PWAマニフェストJSON */
    public function manifest()
    {
        return $this->render('pwa.manifest', layout: null);
    }
}
