<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use App\Helper\MyHelper;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use Illuminate\Support\Arr;

class StateController extends Controller
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
        $this->authorize('read_state');

        return view('dashboard.State.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = State::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (State $State) {
                return $State->id ?? '-';
            })->editColumn('name', function (State $State) {
                return App::getLocale() == 'ar' ? ($State->name_ar ?? '-') : ($State->name_en ?? '-');
            })->editColumn('Country', function (State $State) {
                return App::getLocale() == 'ar' ? ($State->country->name_ar ?? '-') : ($State->country->name_en ?? '-');
            })->editColumn('created_at', function (State $State) {
                return $State->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (State $State) {
                return view('dashboard.State.buttons', compact('State'));
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
            'country_id' => 'required|exists:countries,id'
        ]);

        $Country=State::create($request->all());

        return redirect()->route('dashboard.states.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_state');
        $countries = Country::all();
        return view('dashboard.State.create', compact('countries'));
    }


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $State): View
    {
        $this->authorize('update_state');
        $countries = Country::all();
        return view('dashboard.State.edit', compact('State', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $State): RedirectResponse
    {
        $validatedData = $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'country_id' => 'required|exists:countries,id'
        ]);

        $State->update($request->all());

        return redirect()->route('dashboard.states.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $State)
    {
        $this->authorize('delete_state');

        $State->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }
}
