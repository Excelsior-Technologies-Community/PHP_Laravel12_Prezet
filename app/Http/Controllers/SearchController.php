<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Prezet\Prezet\Models\Document;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->q;

        $results = Document::where('title', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->get();

        return view('prezet.search', compact(
            'results',
            'query'
        ));
    }
}