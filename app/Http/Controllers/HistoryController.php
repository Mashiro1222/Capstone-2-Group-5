<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetectionHistory;

class HistoryController extends Controller
{
    public function index()
    {
        $history = DetectionHistory::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('history'));
    }

    public function show($id)
    {
        $record = DetectionHistory::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('history-details', compact('record'));
    }
}
