<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Site\Seo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class SeoController extends Controller
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
        $this->authorize('read_seo');

        return view('dashboard.seo.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        // phone', 'about_ar', 'about_en', 'address_ar', 'address_en', 'email', 'logo',
        // 'support_number', 'facebook', 'twitter', 'linkedIn', 'instagram'
        $model = Seo::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Seo $seo) {
                return $seo->id ?? '-';
            })->editColumn('page_title', function (Seo $seo) {
                return $seo->page_title ?? '-';
            })->editColumn('created_at', function (Seo $seo) {
                return $seo->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Seo $seo) {
                return view('dashboard.seo.buttons', compact('seo'));
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
    // public function create(Request $request): View
    // {
    //     $this->authorize('create_seo');

    //     return view('dashboard.information.create')->withCategories(Category::all());
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title_ar' => 'required',
    //         'title_en' => 'required',
    //         'description_ar' => 'required',
    //         'description_en' => 'required',
    //         'short_description_ar' => 'required',
    //         'short_description_en' => 'required',
    //         'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
    //         'icon' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
    //         'category_id' => 'required|integer',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $destinationPath = public_path('/uploads/Infromation');
    //         $image->move($destinationPath, $imageName);
    //     }
    //     if ($request->hasFile('icon')) {
    //         $icon = $request->file('icon');
    //         $iconName = time() . '.' . $icon->getClientOriginalExtension();
    //         $destinationIconPath = public_path('/uploads/icon');
    //         $icon->move($destinationIconPath, $iconName);
    //     }

    //     Information::create([
    //         'title_en' => $request->title_en, 'title_ar' => $request->title_ar, 'description_ar' => $request->description_ar, 'description_en' => $request->description_en, 'short_description_ar' => $request->short_description_ar,
    //         'short_description_en' => $request->short_description_en, 'category_id' => $request->category_id, 'image' => '/uploads/Information/' . $imageName, 'icon' => '/uploads/icon/' . $iconName
    //     ]);


    //     return redirect()->route('dashboard.Information.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    // }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seo $SEO): View
    {
        $this->authorize('update_seo');
        return view('dashboard.seo.edit', compact('SEO'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seo $seo): RedirectResponse
    {
        $validatedData = $request->validate([
            'page_title' => 'required',
        ]);

        $updateData = [
            'phone' => $request->phone,
            'about_en' => $request->about_en,
            'about_ar' => $request->about_ar,
            'address_ar' => $request->address_ar,
            'address_en' => $request->address_en, // fixed the key from description_en to address_en
        ];

        if ($request->hasFile('meta_jsonLd')) {
            $validatedData = $request->validate([
                'meta_jsonLd' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
            ], [
                'meta_jsonLd.required' => 'Please Choose Image',
                'meta_jsonLd.mimes' => 'Please Change type',
            ]);

            $metaJsonLdPath = public_path() . $seo->meta_jsonLd;

            if (File::exists($metaJsonLdPath)) {
                File::delete($metaJsonLdPath);
            }

            $metaJsonLd = $request->file('meta_jsonLd');
            $metaJsonLdName = time() . '.' . $metaJsonLd->getClientOriginalExtension();
            $destinationMetaJsonLdPath = public_path('/uploads/meta_jsonLd');
            $metaJsonLd->move($destinationMetaJsonLdPath, $metaJsonLdName);

            $updateData['meta_jsonLd'] = '/uploads/meta_jsonLd/' . $metaJsonLdName;
        }

        $seo->update(array_merge($updateData, [
            'page_title' => $request->page_title,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_canonical' => $request->meta_canonical,
            'meta_opengraph' => $request->meta_opengraph,
            'meta_property' => $request->meta_property,
            'meta_twitter' => $request->meta_twitter,
            'meta_Keyword' => $request->meta_Keyword,
        ]));

        $seo->save();


        return redirect()->route('dashboard.SEO.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Information $Information)
    // {
    //     $this->authorize('delete_seo');

    //     $Information->delete();
    //     return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    // }
}
