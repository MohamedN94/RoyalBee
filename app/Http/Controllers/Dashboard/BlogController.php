<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogRequest;
use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class BlogController extends Controller
{

    /**
     * BlogController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the countries.
     */
    public function index(): View
    {
        $this->authorize('read_blog');

        return view('dashboard.blog.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Blog::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Blog $Blog) {
                return $Blog->id ?? '-';
            })->editColumn('title', function (Blog $Blog) {
                return App::getLocale() == 'ar' ? ($Blog->title_ar ?? '-') : ($Blog->title_en ?? '-');
            })->editColumn('created_at', function (Blog $Blog) {
                return $Blog->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Blog $Blog) {
                return view('dashboard.blog.buttons', compact('Blog'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request): RedirectResponse
    {
        $blog = Blog::create($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->image;
            MyHelper::addPhoto($file, $blog, 'blog');
        }
        return redirect()->route('dashboard.Blogs.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_blog');

        return view('dashboard.blog.create');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $Blog): View
    {
        $this->authorize('update_blog');
        return view('dashboard.blog.edit', compact('Blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $Blog): RedirectResponse
    {
        $Blog->update(Arr::except($request->validated(), 'image'));
        if ($request->hasFile('image')) {
            $oldFile = $Blog->image;
            $file = $request->file('image');
            if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updatePhoto($file, $Blog, 'blog');
        }

        return redirect()->route('dashboard.Blogs.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $Blog)
    {
        $this->authorize('delete_blog');
        if ($Blog->image != null) {
            File::delete(public_path($Blog->image));
        }
        $Blog->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }


}

