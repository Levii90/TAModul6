<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PetugasProfileController extends Controller
{
    public function show(): View
    {
        return view('petugas.profile', [
            'petugas' => Auth::user(),
        ]);
    }
}
