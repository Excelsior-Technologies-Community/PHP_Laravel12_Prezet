<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        Like::create([
            'document_id' => $request->document_id
        ]);

        return back()->with(
            'success',
            'Post liked successfully!'
        );
    }
}