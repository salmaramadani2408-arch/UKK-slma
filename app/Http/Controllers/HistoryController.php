<?php

namespace App\Http\Controllers;

use App\Models\HistoryDisposisi;

class HistoryController extends Controller
{
    public function index()
    {
        $history = HistoryDisposisi::with('disposisi')
                                   ->latest()
                                   ->get();
        
        return view('history.index', compact('history'));
    }
}