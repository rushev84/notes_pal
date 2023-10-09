<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes;

        return view('note.index', [
            'notes' => $notes,
        ]);
    }
}
