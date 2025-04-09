<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class ContactController extends Controller
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
        $this->authorize('read_info');

        return view('dashboard.contact.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        // phone', 'about_ar', 'about_en', 'address_ar', 'address_en', 'email', 'logo',
        // 'support_number', 'facebook', 'twitter', 'linkedIn', 'instagram'
        $model = Contact::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Contact $Contact) {
                return $Contact->id ?? '-';
            })->editColumn('name', function (Contact $Contact) {
                return $Contact->name ?? '-';
            })->editColumn('created_at', function (Contact $Contact) {
                return $Contact->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Contact $Contact) {
                return view('dashboard.contact.buttons', compact('Contact'));
            })
            ->rawColumns(['action'])
            ->startsWithSearch()
            ->make(true);
    }


    function showAll(Request $request) : View {
        $contact=Contact::find($request->id);
        return view('dashboard.contact.message',compact('contact'));
    }
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request): View
    // {
    //     $this->authorize('create_info');

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
    // public function edit(Information $Information): View
    // {
    //     $this->authorize('update_info');
    //     return view('dashboard.information.edit', compact('Information'))->withInformation(Information::all());
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Information $Information): RedirectResponse
    // {
    //     $validatedData = $request->validate([
    //         'phone' => 'required',
    //         'about_ar' => 'required',
    //         'about_en' => 'required',
    //         'address_ar' => 'required',
    //         'address_en' => 'required',
    //         'email' => 'required',
    //         'support_number' => 'required',
    //     ]);


    //     $updateData = [
    //         'phone' => $request->phone,
    //         'about_en' => $request->about_en,
    //         'about_ar' => $request->about_ar,
    //         'address_ar' => $request->address_ar,
    //         'address_en' => $request->description_en,
    //     ];

    //     if ($request->hasFile('logo')) {
    //         $validatedData = $request->validate(
    //             [
    //                 'logo' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
    //             ],
    //             $messages = [
    //                 'logo.required' => 'Please Choose Image',
    //                 'logo.mimes' => 'Please Change type',
    //             ]
    //         );
    //         if (File::exists(public_path() . $Information->header_image)) {
    //             File::delete(public_path() . $Information->header_image);
    //         }

    //         $image = $request->file('logo');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $destinationPath = public_path('/uploads/Information');
    //         $image->move($destinationPath, $imageName);

    //         $Information->header_image = '/uploads/Information/' . $imageName;

    //     }elseif($request->hasFile('logo2')){
    //         $validatedData = $request->validate(
    //             [
    //                 'logo2' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
    //             ],
    //             $messages = [
    //                 'logo2.required' => 'Please Choose Image',
    //                 'logo2.mimes' => 'Please Change type',
    //             ]
    //         );
    //         if (File::exists(public_path() . $Information->footer_iamge)) {
    //             File::delete(public_path() . $Information->footer_iamge);
    //         }

    //         $image = $request->file('logo2');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $destinationPath = public_path('/uploads/Information');
    //         $image->move($destinationPath, $imageName);

    //         $Information->footer_image = '/uploads/Information/' . $imageName;

    //     }elseif($request->hasFile('video')){
    //         $validatedData = $request->validate(
    //             [
    //                 'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm'
    //             ],
    //             $messages = [
    //                 'video.required' => 'Please Choose video',
    //                 'video.mimes' => 'Please Change type',
    //             ]
    //         );
    //         if (File::exists(public_path() . $Information->video)) {
    //             File::delete(public_path() . $Information->video);
    //         }

    //         $video = $request->file('video');
    //         $videoName = time() . '.' . $video->getClientOriginalExtension();
    //         $destinationVideoPath = public_path('/uploads/Information');
    //         $video->move($destinationVideoPath, $videoName);

    //         $Information->video = '/uploads/Information/' . $videoName;

    //     }

    //     $Information->phone = $request->phone;
    //     $Information->about_en = $request->about_en;
    //     $Information->about_ar = $request->about_ar;
    //     $Information->address_ar = $request->address_ar;
    //     $Information->address_en = $request->address_en;
    //     $Information->email = $request->email;
    //     $Information->support_number = $request->support_number;
    //     $Information->facebook = $request->facebook;
    //     $Information->twitter = $request->twitter;
    //     $Information->linkedIn = $request->linkedIn;
    //     $Information->instagram = $request->instagram;

    //     // Save the changes
    //     $Information->save();

    //     return redirect()->route('dashboard.Information.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Information $Information)
    // {
    //     $this->authorize('delete_info');

    //     $Information->delete();
    //     return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    // }
}
