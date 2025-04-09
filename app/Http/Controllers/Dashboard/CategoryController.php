<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Country;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{

    /**
     * CategoryController constructor.
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
        $this->authorize('read_category');

        return view('dashboard.category.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Category::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Category $category) {
                return $category->id ?? '-';
            })->editColumn('name', function (Category $category) {
                return App::getLocale() == 'ar' ? ($category->name_ar ?? '-') : ($category->name_en ?? '-');
            })->editColumn('created_at', function (Category $category) {
                return $category->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Category $category) {
                return view('dashboard.category.buttons', compact('category'));
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
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->image;
            MyHelper::addPhoto($file, $category, 'categories');
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->banner_image;
            MyHelper::addPhoto($file, $category, 'categories');
        }
        return redirect()->route('dashboard.Categories.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_category');

        return view('dashboard.category.create');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $Category): View
    {
        $this->authorize('update_category');
        return view('dashboard.category.edit', compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $Category): RedirectResponse
    {

        $Category->update(Arr::except($request->validated(), ['image', 'banner_image']));
        if ($request->hasFile('image')) {
            $oldFile = $Category->image;
            $file = $request->file('image');
            if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updatePhoto($file, $Category, 'categories');
        }
        if ($request->hasFile('banner_image')) {
            $oldFile = $Category->banner_image;
            $file = $request->file('banner_image');
             if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updateImage($file, 'banner_image', $Category, 'categories');
        }
        return redirect()->route('dashboard.Categories.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category)
    {
        $this->authorize('delete_category');
        if ($Category->image != null) {
            File::delete(public_path($Category->image));
        }
        $Category->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }


}
