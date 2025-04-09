<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use App\Models\Admin\Slider;
use App\Models\Admin\Country;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class SliderController extends Controller
{

    /**
     * SliderController constructor.
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
        $this->authorize('read_slider');

        return view('dashboard.sliders.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Slider::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Slider $slider) {
                return $slider->id ?? '-';
            })->editColumn('title', function (Slider $slider) {
                return App::getLocale() == 'ar' ? ($slider->title_ar ?? '-') : ($slider->title_en ?? '-');
            })->editColumn('created_at', function (Slider $slider) {
                return $slider->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', 'dashboard.sliders.buttons')
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
    public function store(SliderRequest $request): RedirectResponse
    {
        $data= $request->validated();
        $data['status'] = $request->has('status') ? 1 : 0;
        $slider = Slider::create($data);
        if ($request->hasFile('image')) {
            $file = $request->image;
            MyHelper::addPhoto($file, $slider, 'sliders');
        }

        if ($request->hasFile('image_ar')) {
            $file = $request->image_ar;
            $destinationPath = public_path() . '/uploads/sliders/';
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given


            $slider->image_ar = 'uploads/sliders/' . $name;
            $slider->save();
        }

        if ($request->hasFile('mobile_image')) {
            $file = $request->mobile_image;
            $destinationPath = public_path() . '/uploads/sliders/';
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given


            $slider->mobile_image = 'uploads/sliders/' . $name;
            $slider->save();
        }
        if ($request->hasFile('mobile_image_ar')) {
            $file = $request->mobile_image_ar;
            $destinationPath = public_path() . '/uploads/sliders/';
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $file->move($destinationPath, $name); // uploading file to given


            $slider->mobile_image_ar = 'uploads/sliders/' . $name;
            $slider->save();
        }

        return redirect()->route('dashboard.sliders.index')->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_slider');

        return view('dashboard.sliders.create');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider): View
    {
        $this->authorize('update_slider');
        return view('dashboard.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider): RedirectResponse
    {

        $slider->update(Arr::except($request->validated(), 'image','mobile_image','image_ar','mobile_image_ar'));

        if ($request->hasFile('image')) {
            $oldFile = $slider->image;
            $file = $request->file('image');
            if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updatePhoto($file, $slider, 'sliders');
        }

        if ($request->hasFile('image_ar')) {
            $oldFile = $slider->image_ar;
            $image = $request->file('image_ar');

            $destinationPath = public_path() . '/uploads/sliders/' ;
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $image->move($destinationPath, $name); // uploading file to given

            $slider->update(['image_ar' => 'uploads/sliders/' . $name]);

        }

        if ($request->hasFile('mobile_image')) {
            $oldFile = $slider->mobile_image;
            $image = $request->file('mobile_image');
            // if ($oldFile != null) unlink(public_path($oldFile));

            $destinationPath = public_path() . '/uploads/sliders/' ;
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $image->move($destinationPath, $name); // uploading file to given

            $slider->update(['mobile_image' => 'uploads/sliders/' . $name]);

        }

        if ($request->hasFile('mobile_image_ar')) {
            $oldFile = $slider->mobile_image_ar;
            $image = $request->file('mobile_image_ar');
            // if ($oldFile != null) unlink(public_path($oldFile));

            $destinationPath = public_path() . '/uploads/sliders/' ;
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $image->move($destinationPath, $name); // uploading file to given

            $slider->update(['mobile_image_ar' => 'uploads/sliders/' . $name]);

        }

        return redirect()->route('dashboard.sliders.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $this->authorize('delete_slider');
        if ($slider->image != null) {
            File::delete(public_path($slider->image));
        }
        $slider->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }


}
