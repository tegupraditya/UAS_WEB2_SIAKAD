<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KhsController extends Controller
{
    public function index()
    {
        return view('mahasiswa.khs.index');
    }
}
