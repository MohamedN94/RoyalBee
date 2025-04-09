<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Driver;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $this->authorize('read_role');

        return view('dashboard.roles.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Role::orderBy('created_at', 'desc');

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Role $role) {
                return $role->id ?? '-';
            })->editColumn('name', function (Role $role) {
                return App::getLocale() == 'ar' ? ($role->name_ar ?? '-') : ($role->name ?? '-');
            })->editColumn('created_at', function (Role $role) {
                return $role->created_at->format('d-m-Y h:i A');
            })->addColumn('action', function (Role $role) {
                return view('dashboard.roles.buttons', compact('role'));
            })->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $this->authorize('create_role');

        $permissions = Permission::get()->groupBy('model');

        return view('dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->except('permissions'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('dashboard.roles.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $this->authorize('update_role');

        $permissions = Permission::get()->groupBy('model');

        return view('dashboard.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->except('permissions'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('dashboard.roles.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->authorize('delete_role');

        $role->delete();

        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }
}
