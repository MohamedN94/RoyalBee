<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Reel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class ReelController extends Controller
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
        $this->authorize('read_reel');

        return view('dashboard.reel.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Reel::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Reel $Reel) {
                return $Reel->id ?? '-';
            })->editColumn('name', function (Reel $Reel) {
                return App::getLocale() == 'ar' ? ($Reel->name_ar ?? '-') : ($Reel->name_en ?? '-');
            })->editColumn('created_at', function (Reel $Reel) {
                return $Reel->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Reel $Reel) {
                return view('dashboard.reel.buttons', compact('Reel'));
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
            'video' => 'required|url',
        ]);

        Reel::create($request->all());

        return redirect()->route('dashboard.Reels.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_reel');

        return view('dashboard.reel.create');
    }


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reel $Reel): View
    {
        $this->authorize('update_reel');
        return view('dashboard.reel.edit', compact('Reel'))->withReel(Reel::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reel $Reel): RedirectResponse
    {
        $validatedData = $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'video' => 'required|url',
        ]);

        $Reel->update($request->all());

        return redirect()->route('dashboard.Reels.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reel $Reel)
    {
        $this->authorize('delete_reel');

        $Reel->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }
}

