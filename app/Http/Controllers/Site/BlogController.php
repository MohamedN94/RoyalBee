<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function blogDetail(Blog $blog): View
    {
        return view('front.blog-detail', compact('blog'));
    }

    public function index(): View
    {
        return view('front.blogs');
    }
}
