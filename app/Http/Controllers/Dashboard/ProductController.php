<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\ProductAttribute;
use App\Models\Admin\ProductAttributeValue;
use App\Models\Admin\Review;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * ProductController constructor.
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
        $this->authorize('read_product');

        return view('dashboard.products.index');
    }

    public function show(DataTables $dataTables, Request $request)
    {
        $model = Product::orderBy('created_at', 'desc');
        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Product $product) {
                return $product->id ?? '-';
            })->editColumn('name', function (Product $product) {
                return App::getLocale() == 'ar' ? ($product->name_ar ?? '-') : ($product->name_en ?? '-');
            })->editColumn('sku', function (Product $product) {
                return $product->sku ?? '-';
            })->editColumn('created_at', function (Product $product) {
                return $product->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Product $product) {
                return view('dashboard.products.buttons', compact('product'));
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
    public function store(ProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $product = Product::create($request->validated());

            if ($request['type'] === 'attribute') {
                $attribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_name' => $request['attribute']['name'],
                ]);

                foreach ($request['attribute']['values'] as $value) {
                    ProductAttributeValue::create([
                        'attribute_id' => $attribute->id,
                        'value' => $value['value'],
                        'price' => $value['price'],
                    ]);
                }
            }

            if ($request->hasFile('image')) {
                $file = $request->image;
                MyHelper::addPhoto($file, $product, 'products');
            }

            if ($request->has('photo')) {
                foreach ($request->file('photo') as $image) {
                    MyHelper::addPhotos($image, $product, 'products', 'photos');
                }
            }

            DB::commit();

            return redirect()->route('dashboard.products.index')
                ->with(['status' => 'success', 'message' => __('dashboard.addedSuccessfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Product store failed', ['error' => $e->getMessage()]);

            return redirect()->back()
                ->with(['status' => 'error', 'message' => __('dashboard.errorOccurred')])
                ->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create_product');

        return view('dashboard.products.create', [
            'categories' => Category::select(['id', 'name_ar', 'name_en'])->get()
        ]);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $this->authorize('update_product');
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::select(['id', 'name_ar', 'name_en'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {

        if ($request->input('type') == 'attribute') {
            $attributesData = $request['attribute']['name'];

            $product->attributes()->delete();
            $product->attributeValues()->delete();
    
            $attribute = $product->attributes()->create([
                'attribute_name' => $attributesData,
            ]);
    
            foreach ($request['attribute']['values'] as $valueData) {
                $attribute->values()->create([
                    'value' => $valueData['value'],
                    'price' => $valueData['price'],
                ]);
            }
        }
    
        $product->update(Arr::except($request->validated(), 'image'));
        if ($request->hasFile('image')) {
            $oldFile = $product->image;
            $file = $request->file('image');
            if ($oldFile != null) unlink(public_path($oldFile));
            MyHelper::updatePhoto($file, $product, 'products');
        }
        if ($request->has('photo')) {
            foreach ($request->file('photo') as $image) {
                MyHelper::updatePhotos($image, $product, 'products', 'photos');
            }
        }
        return redirect()->route('dashboard.products.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete_product');

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => __('dashboard.productNotFound')]);
        }


        if ($product->image != null) {
            File::delete(public_path($product->image));
        }

        // Delete all photos associated with the product
        foreach ($product->photos as $photo) {
            File::delete(public_path($photo->photo));
        }

        if ($product->photos()->count()) {
            $product->photos()->delete();
        }

        $product->delete();
        return response()->json(['status' => 'success', 'message' => __('dashboard.deletedSuccessfully')]);
    }

    public function toggleTrendingProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->trending_product = !$product->trending_product;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => $product->trending_product ? __('Added to Trending') : __('Removed from Trending'),
            'trending_product' => $product->trending_product,
        ]);
    }

    // Toggle Best Seller
    public function toggleBestSeller(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->best_seller = !$product->best_seller;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => $product->best_seller ? __('Added to Best Seller') : __('Removed from Best Seller'),
            'best_seller' => $product->best_seller,
        ]);
    }

    public function visible(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->is_visible = !$product->is_visible;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => $product->is_visible ? __('Show') : __('Hide'),
            'visible' => $product->is_visible,
        ]);
    }
}
