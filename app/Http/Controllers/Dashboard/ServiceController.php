<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class ServiceController extends Controller
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
        $this->authorize('read_service');

        return view('dashboard.service.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Service::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Service $service) {
                return $service->id ?? '-';
            })->editColumn('title', function (Service $service) {
                return App::getLocale() == 'ar' ? ($service->title_ar ?? '-') : ($service->title_en ?? '-');
            })->editColumn('excerpt', function (Service $service) {
                return App::getLocale() == 'ar' ? ($service->short_description_ar ?? '-') : ($service->short_description_en ?? '-');
            })->editColumn('created_at', function (Service $service) {
                return $service->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Service $service) {
                return view('dashboard.service.buttons', compact('service'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_service');

        return view('dashboard.service.create')->withCategories(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'short_description_ar' => 'required',
            'short_description_en' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'icon' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'category_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Service');
            $image->move($destinationPath, $imageName);
        }
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $destinationIconPath = public_path('/uploads/icon');
            $icon->move($destinationIconPath, $iconName);
        }
        if ($request->hasFile('meta_jsonLd')) {
            $meta_jsonLd = $request->file('meta_jsonLd');
            $meta_jsonLdName = time() . '.' . $icon->getClientOriginalExtension();
            $destinationMeta_jsonLdPath = public_path('/uploads/meta_jsonLd');
            $meta_jsonLd->move($destinationMeta_jsonLdPath, $meta_jsonLdName);
        }

        Service::create([
            'title_en' => $request->title_en, 'title_ar' => $request->title_ar, 'description_ar' => $request->description_ar, 'description_en' => $request->description_en, 'short_description_ar' => $request->short_description_ar,
            'short_description_en' => $request->short_description_en, 'category_id' => $request->category_id, 'image' => '/uploads/Service/' . $imageName, 'icon' => '/uploads/icon/' . $iconName , 'meta_title' => $request->meta_title
            , 'meta_description' => $request->meta_description, 'meta_canonical' => $request->meta_canonical, 'meta_opengraph' => $request->meta_opengraph, 'meta_property' => $request->meta_property
            , 'meta_twitter' => $request->meta_twitter, 'meta_jsonLd' => '/uploads/meta_jsonLd/' . $meta_jsonLdName ,'meta_Keyword' => $request->meta_Keyword
        ]);


        return redirect()->route('dashboard.Services.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $Service): View
    {
        $this->authorize('update_service');
        return view('dashboard.service.edit', compact('Service'))->withCategories(Category::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $Service): RedirectResponse
    {
        $validatedData = $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'short_description_ar' => 'required',
            'short_description_en' => 'required',
            'category_id' => 'required|integer',
        ]);


        $updateData = [
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'short_description_ar' => $request->short_description_ar,
            'short_description_en' => $request->short_description_en,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            $validatedData = $request->validate(
                [
                    'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
                ],
                $messages = [
                    'image.required' => 'Please Choose Image',
                    'image.mimes' => 'Please Change type',
                ]
            );
            if (File::exists(public_path() . $Service->image)) {
                File::delete(public_path() . $Service->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Service');
            $image->move($destinationPath, $imageName);

            $Service->image = '/uploads/Service/' . $imageName;
        } elseif ($request->hasFile('icon')) {
            $validatedData = $request->validate(
                [
                    'icon' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
                ],
                $messages = [
                    'icon.required' => 'Please Choose Image',
                    'icon.mimes' => 'Please Change type',
                ]
            );
            if (File::exists(public_path() . $Service->icon)) {
                File::delete(public_path() . $Service->icon);
            }

            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $destinationIconPath = public_path('/uploads/icon');
            $icon->move($destinationIconPath, $iconName);

            $Service->icon = '/uploads/icon/' . $iconName;
        }elseif ($request->hasFile('meta_jsonLd')) {
            $validatedData = $request->validate(
                [
                    'meta_jsonLd' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
                ],
                $messages = [
                    'meta_jsonLd.required' => 'Please Choose Image',
                    'meta_jsonLd.mimes' => 'Please Change type',
                ]
            );
            if (File::exists(public_path() . $Service->meta_jsonLd)) {
                File::delete(public_path() . $Service->meta_jsonLd);
            }

            $meta_jsonLd = $request->file('meta_jsonLd');
            $meta_jsonLdName = time() . '.' . $meta_jsonLd->getClientOriginalExtension();
            $destinationMeta_jsonLdPath = public_path('/uploads/meta_jsonLd');
            $meta_jsonLd->move($destinationMeta_jsonLdPath, $meta_jsonLdName);

            $Service->meta_jsonLd = '/uploads/meta_jsonLd/' . $meta_jsonLdName;
        }

        $Service->title_en = $request->title_en;
        $Service->title_ar = $request->title_ar;
        $Service->description_ar = $request->description_ar;
        $Service->description_en = $request->description_en;
        $Service->short_description_ar = $request->short_description_ar;
        $Service->short_description_en = $request->short_description_en;
        $Service->category_id = $request->category_id;
        // MetaDta
        $Service->meta_title = $request->meta_title;
        $Service->meta_description = $request->meta_description;
        $Service->meta_canonical = $request->meta_canonical;
        $Service->meta_opengraph = $request->meta_opengraph;
        $Service->meta_property = $request->meta_property;
        $Service->meta_twitter = $request->meta_twitter;
        $Service->meta_Keyword = $request->meta_Keyword;
        // Save the changes
        $Service->save();

        return redirect()->route('dashboard.Services.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $Service)
    {
        $this->authorize('delete_service');

        $Service->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }
}
