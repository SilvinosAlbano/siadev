<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function edit($id)
    {
        // Your logic to edit an article
        return view('articles.edit', compact('id'));
    }
}

