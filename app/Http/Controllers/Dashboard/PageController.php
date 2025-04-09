<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\PageRequest;
use App\Models\Admin\Page;
use App\Models\Admin\Country;
use App\Models\Admin\PageType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{

    /**
     * PageController constructor.
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
        $this->authorize('read_page');

        return view('dashboard.pages.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Page::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Page $page) {
                return $page->id ?? '-';
            })->editColumn('name', function (Page $page) {
                return App::getLocale() == 'ar' ? ($page->name_ar ?? '-') : ($page->name_en ?? '-');
            })->editColumn('created_at', function (Page $page) {
                return $page->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action',  'dashboard.pages.buttons')
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request): RedirectResponse
    {
        $page = Page::create($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->image;
            MyHelper::addPhoto($file, $page, 'categories');
        }
        return redirect()->route('dashboard.pages.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_page');

        return view('dashboard.pages.create', [
            'pageTypes' => PageType::select(['id','name_ar', 'name_en'])->get()
        ]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page): View
    {
        $this->authorize('update_page');
        return view('dashboard.pages.edit', [
            'page' => $page,
            'pageTypes' => PageType::select(['id','name_ar', 'name_en'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page): RedirectResponse
    {

        $page->update($request->validated());


        return redirect()->route('dashboard.pages.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete_page');
        if (!$page) {
            return response()->json(['status' => 'error', 'message' => __('dashboard.productNotFound')]);
        }
        $page->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }


}
