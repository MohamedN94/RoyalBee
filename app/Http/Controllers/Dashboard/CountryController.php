<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use App\Helper\MyHelper;
use Illuminate\Support\Arr;

class CountryController extends Controller
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
        $this->authorize('read_country');

        return view('dashboard.country.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Country::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Country $Country) {
                return $Country->id ?? '-';
            })->editColumn('name', function (Country $Country) {
                return App::getLocale() == 'ar' ? ($Country->name_ar ?? '-') : ($Country->name_en ?? '-');
            })->editColumn('code', function (Country $Country) {
                return $Country->code ?? '-';
            })->editColumn('created_at', function (Country $Country) {
                return $Country->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Country $Country) {
                return view('dashboard.country.buttons', compact('Country'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }


        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'code' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $Country=Country::create($request->all());

        if ($request->hasFile('image')) {
            $file = $request->image;
            MyHelper::addPhoto($file, $Country, 'Country');
        }

        return redirect()->route('dashboard.countries.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_country');

        return view('dashboard.country.create');
    }


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country): View
    {
        $this->authorize('update_country');
        return view('dashboard.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $Country): RedirectResponse
    {
        $validatedData = $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'code' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $Country->update(Arr::except($request->all(), 'image'));
        if ($request->hasFile('image')) {
            $oldFile = $Country->image;
            $file = $request->file('image');
            if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updatePhoto($file, $Country, 'Country');
        }

        return redirect()->route('dashboard.countries.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $Country)
    {
        $this->authorize('delete_country');

        $Country->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }
}
