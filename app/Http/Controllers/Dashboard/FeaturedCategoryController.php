<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeaturedCategory\CategoryRequest;
use Illuminate\Http\Request;
use App\Helper\MyHelper;
use App\Models\Admin\FeaturedCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;

class FeaturedCategoryController extends Controller
{
        /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function create()
    {
        //
    }

    /**
     * Display a listing of the countries.
     */
    public function index(): View
    {
        $this->authorize('read_category');

        return view('dashboard.FeaturedCategories.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = FeaturedCategory::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (FeaturedCategory $featuredCategory) {
                return $featuredCategory->id ?? '-';
            })->editColumn('name', function (FeaturedCategory $featuredCategory) {
                return App::getLocale() == 'ar' ? ($featuredCategory->title_ar ?? '-') : ($featuredCategory->title_en ?? '-');
            })->editColumn('created_at', function (FeaturedCategory $featuredCategory) {
                return $featuredCategory->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (FeaturedCategory $featuredCategory) {
                return view('dashboard.FeaturedCategories.buttons', compact('featuredCategory'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeaturedCategory $featuredCategory): View
    {
        $this->authorize('update_category');
        return view('dashboard.FeaturedCategories.edit', compact('featuredCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, FeaturedCategory $featuredCategory): RedirectResponse
    {

        $featuredCategory->update(Arr::except($request->validated(), 'image'));
        if ($request->hasFile('image')) {
            $oldFile = $featuredCategory->image;
            $file = $request->file('image');
//            if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updatePhoto($file, $featuredCategory, 'featuredCategory');
        }
        return redirect()->route('dashboard.featured_categories.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

}
