<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Menampilkan halaman Home (landing page).
     */
    public function home(): View
    {
        return view('home');
    }

    /**
     * Menampilkan halaman Info Ajar.
     */
    public function infoajar(): View
    {
        return view('infoajar');
    }

    /**
     * Menampilkan halaman Statistik.
     */
    public function statistik(): View
    {
        return view('statistik');
    }

    // menampilkan halaman formulir
    public function formulir(): View
    {
        return view('formulir');
    }
}