@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.categories') }}</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection
<style>
    .card-body {
        padding: 20px;
    }

    /* Style for each section */
    .section {
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
        /* Light gray border for separation */
        margin-bottom: 20px;
        /* Space between sections */
    }

    /* Remove bottom border for the last section */
    .card-body .section:last-of-type {
        border-bottom: none;
    }

    /* Add some spacing for heading */
    .section h4 {
        margin-bottom: 15px;
    }
</style>

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b ">
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops! Something went wrong:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="section">
                                    <h4>{{ __('dashboard.general_info') }}</h4>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.name_ar') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="name_ar"
                                                    value="{{ old('name_ar', $product->name_ar) }}"
                                                    class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name_ar') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.name_en') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="name_en"
                                                    value="{{ old('name_en', $product->name_en) }}"
                                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name_en') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sku') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="sku"
                                                    value="{{ old('sku', $product->sku) }}"
                                                    class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.sku') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('sku') ? $errors->first('sku') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.category') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="category_id"
                                                    class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.category') }}">
                                                    <option selected disabled>{{ __('dashboard.choose-category') }}
                                                    </option>
                                                    @foreach ($categories as $category)
                                                        @php
                                                            $locale = app()->getLocale();
                                                            $localizedName = 'name_' . $locale;
                                                        @endphp
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->$localizedName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                    <span
                                                        class="form-text text-danger">{{ $errors->first('category_id') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>

                                </div>

                                <!-- Descriptions Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.short_description') }}</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.short_description_en') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="short_desc_en" cols="30" rows="10"
                                                    class="form-control ckeditor lang-en
                                                {{ $errors->has('short_desc_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.short_desc_en') }}">
                                                    {{ old('short_desc_en', $product->short_desc_en) }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('short_desc_en') ? $errors->first('short_desc_en') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.short_description_ar') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="short_desc_ar" cols="30" rows="10"
                                                    class="form-control ckeditor
                                                 {{ $errors->has('short_desc_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.short_desc_ar') }}">
                                                    {{ old('short_desc_ar', $product->short_desc_ar) }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('short_desc_ar') ? $errors->first('short_desc_ar') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Descriptions Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.description') }}</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.description_en') }}
                                                    <span class="text-danger">*</span></label>
                                                <textarea type="text" name="description_en" cols="30" rows="10"
                                                    class="form-control ckeditor lang-en {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_en') }}">
                                                        {{ old('description_en', $product->description_en) }}
                                                    </textarea>

                                                <span
                                                    class="form-text text-danger">{{ $errors->has('description_en') ? $errors->first('description_en') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.description_ar') }}
                                                    <span class="text-danger">*</span></label>
                                                <textarea type="text" name="description_ar" cols="30" rows="10"
                                                    class="form-control ckeditor  {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_ar') }}">
                                                        {{ old('description_ar', $product->description_ar) }}
                                                    </textarea>

                                                <span
                                                    class="form-text text-danger">{{ $errors->has('description_ar') ? $errors->first('description_ar') : '' }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Pricing Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.pricing') }}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.price') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" name="price"
                                                    value="{{ old('price', $product->price) }}"
                                                    class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.price') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('price') ? $errors->first('price') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.discount_price') }}
                                                    ({{ __('dashboard.if_found') }}
                                                    )</label>
                                                <input type="number" name="discount_price"
                                                    value="{{ old('discount_price', $product->discount_price) }}"
                                                    class="form-control {{ $errors->has('discount_price') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.discount_price') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('discount_price') ? $errors->first('discount_price') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sale_start_date') }}</label>
                                                <input type="date" name="sale_start_date"
                                                    value="{{ old('sale_start_date', $product->sale_start_date) }}"
                                                    class="form-control {{ $errors->has('sale_start_date') ? 'is-invalid' : '' }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('sale_start_date') ? $errors->first('sale_start_date') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sale_end_date') }}</label>
                                                <input type="date" name="sale_end_date"
                                                    value="{{ old('sale_end_date', $product->sale_end_date) }}"
                                                    class="form-control {{ $errors->has('sale_end_date') ? 'is-invalid' : '' }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('sale_end_date') ? $errors->first('sale_end_date') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- New Fields Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.additional_info') }}</h4>
                                    <div class="row">


                                        <!-- Select Product Type -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="product-type" class="form-label">Product Type</label>
                                                <select class="form-control @error('type') is-invalid @enderror"
                                                    id="product-type" name="type"
                                                    onchange="toggleAttributesSection()">
                                                    <option value="simple"
                                                        {{ old('type', $product->type) == 'simple' ? 'selected' : '' }}>
                                                        Simple</option>
                                                    <option value="attribute"
                                                        {{ old('type', $product->type) == 'attribute' ? 'selected' : '' }}>
                                                        Attribute</option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div id="attribute-section" style="display: none;">
                                                <label class="form-label">Attributes</label>
                                                <div id="attributes-container">
                                                    @if ($product->type == 'attribute')
                                                        @foreach ($product->attributes as $attributeIndex => $attribute)
                                                            <div class="mb-3">
                                                                <label>Attribute Name</label>
                                                                <input type="text" name="attribute[name]"
                                                                    class="form-control @error('attributes.{{ $attributeIndex }}.name') is-invalid @enderror"
                                                                    value="{{ old("attributes.{$attributeIndex}.name", $attribute->attribute_name) }}"
                                                                    required>

                                                                <div>
                                                                    <label>Values</label>
                                                                    <div id="attribute-values-{{ $attributeIndex }}">
                                                                        @foreach ($attribute->values as $valueIndex => $value)
                                                                            <div class="input-group mb-3 value-block">
                                                                                <input type="text"
                                                                                    name="attribute[values][{{ $valueIndex }}][value]"
                                                                                    placeholder="Value"
                                                                                    class="form-control"
                                                                                    value="{{ old("attributes.{$attributeIndex}.values.{$valueIndex}.value", $value->value) }}"
                                                                                    required>
                                                                                <input type="decimal"
                                                                                    name="attribute[values][{{ $valueIndex }}][price]"
                                                                                    placeholder="Price"
                                                                                    class="form-control"
                                                                                    value="{{ old("attributes.{$attributeIndex}.values.{$valueIndex}.price", $value->price) }}"
                                                                                    required>
                                                                                @if ($valueIndex > 0)
                                                                                    <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        onclick="removeValue(this)">Remove</button>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        onclick="addValue({{ $attributeIndex }})">Add
                                                                        Value</button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="addValue(0)">Add Value</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.stock') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="stock"
                                                    value="{{ old('stock', $product->stock) }}"
                                                    class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.stock') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('stock') ? $errors->first('stock') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.tax_rate') }} </label>
                                                <input type="number" name="tax_rate"
                                                    value="{{ old('tax_rate', $product->tax_rate) }}"
                                                    class="form-control {{ $errors->has('tax_rate') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.tax_rate') }}"
                                                    step="0.01" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('tax_rate') ? $errors->first('tax_rate') : '' }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="section">
                                    <h4>{{ __('dashboard.images') }}</h4>
                                    <div class="row col-md-12">
                                        <div class="col-md-4 form-group m-form__group">
                                            <label class="col-form-label"
                                                for="images">{{ __('dashboard.image') }}</label>
                                            <span class="text-danger">*</span>
                                            <input type="file"
                                                class="form-control m-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                name="image" id="images" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                        </div>
                                        <div class="col-md-8">
                                            <img src="{{ asset($product->image) }}" class="loaded-image" alt="logo"
                                                style="display: {{ $product->image ? 'inline-block' : 'none' }}; width: 100px; margin: 10px 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-form-label"
                                                for="images">{{ __('dashboard.images') }}</label>
                                            <span class="text-danger">*</span>
                                            <input type="file" multiple
                                                class="form-control m-input {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                                                name="photo[]" id="images" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('photo') ? $errors->first('photo') : '' }}</span>
                                        </div>
                                        @if ($product->has('photos'))
                                            @foreach ($product->photos as $photo)
                                                @if (!empty($photo->photo) && $photo->count())
                                                    <div class="col-md-3" id="removable{{ $photo->id }}"
                                                        style="text-align: center;">
                                                        <img src="{{ asset(optional($photo)->photo) }}"
                                                            class="img-responsive center-block"
                                                            style="max-height: 100px;">
                                                        <div class="clearfix"></div>
                                                        <button id="{{ $photo->id }}"
                                                            data-token="{{ csrf_token() }}"
                                                            data-route="{{ URL::route('dashboard.photo.destroy', $photo->id) }}"
                                                            data-record-id="{{ $photo->id }}" type="button"
                                                            class="destroy btn btn-danger btn-xs btn-block"
                                                            style="margin-top: 5px">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="clearfix"></div>
                                            <br>
                                        @endif
                                    </div>
                                </div>
                                <div class="section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.video') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="video"
                                                    value="{{ old('video', $product->video) }}"
                                                    class="form-control {{ $errors->has('video') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.video') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('video') ? $errors->first('video') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.meta_title_ar') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="meta_title_ar"
                                                    value="{{ old('meta_title_ar', $product->meta_title_ar) }}"
                                                    class="form-control {{ $errors->has('meta_title_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_title_ar') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('meta_title_ar') ? $errors->first('meta_title_ar') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.meta_title_en') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="meta_title_en"
                                                    value="{{ old('meta_title_en', $product->meta_title_en) }}"
                                                    class="form-control {{ $errors->has('meta_title_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_title_en') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('meta_title_en') ? $errors->first('meta_title_en') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.alt_image') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="alt_image"
                                                    value="{{ old('alt_image', $product->alt_image) }}"
                                                    class="form-control {{ $errors->has('alt_image') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.alt_image') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('alt_image') ? $errors->first('alt_image') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Descriptions Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.meta_description') }}</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.meta_description_en') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="meta_description_en" cols="30" rows="10"
                                                    class="form-control ckeditor lang-en {{ $errors->has('meta_description_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_description_en') }}">
                                                        {{ old('meta_description_en', $product->meta_description_en) }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('meta_description_en') ? $errors->first('meta_description_en') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.meta_description_ar') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="meta_description_ar" cols="30" rows="10"
                                                    class="form-control ckeditor {{ $errors->has('meta_description_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_description_ar') }}">
                                                        {{ old('meta_description_ar', $product->meta_description_ar) }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('meta_description_ar') ? $errors->first('meta_description_ar') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                {!! csrf_field() !!}
                                <button type="submit"
                                    class="btn btn-primary mr-2">{{ __('dashboard.submit') }}</button>
                                <a href="{{ route('dashboard.products.index') }}" type="reset"
                                    class="btn btn-secondary">{{ __('dashboard.cancel') }}</a>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    @endsection
    @section('scripts')
        <script>
            $(document).on('click', '.destroy', function(e) {
                e.preventDefault();
                var that = $(this);
                var route = $(this).data('route');
                var token = $(this).data('token');
                var recordId = $(this).data('record-id');

                var n = new Noty({
                    text: 'هل أنت متأكد من الحذف ؟',
                    type: 'alert',
                    killer: true,
                    buttons: [
                        Noty.button('نعم', 'btn btn-success mr-2', function() {
                            $.ajax({
                                url: route,
                                type: 'post',
                                data: {
                                    _method: 'delete',
                                    _token: token
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status == 0) {
                                        new Noty({
                                            layout: 'topRight',
                                            type: 'error',
                                            text: response.text,
                                            killer: true,
                                            timeout: 2000,
                                        }).show();
                                    } else {
                                        $('#removable' + recordId).remove();
                                        new Noty({
                                            layout: 'topRight',
                                            type: 'success',
                                            text: response.text,
                                            killer: true,
                                            timeout: 2000,
                                        }).show();
                                    }
                                }
                            });
                        }),

                        Noty.button('لا', 'btn btn-danger mr-2', function() {
                            n.close();
                        })
                    ]
                });

                n.show();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to toggle the disabled state of the date fields
                function toggleDateFields() {
                    const discountPrice = parseFloat(document.querySelector('input[name="discount_price"]').value) || 0;
                    const saleStartDate = document.querySelector('input[name="sale_start_date"]');
                    const saleEndDate = document.querySelector('input[name="sale_end_date"]');

                    if (discountPrice <= 0) {
                        saleStartDate.disabled = true;
                        saleEndDate.disabled = true;
                    } else {
                        saleStartDate.disabled = false;
                        saleEndDate.disabled = false;
                    }
                }

                // Initial check on page load
                toggleDateFields();

                // Add an event listener to the discount_price input to check when its value changes
                document.querySelector('input[name="discount_price"]').addEventListener('input', toggleDateFields);
            });
        </script>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const productTypeSelect = document.getElementById('product-type');
                toggleAttributesSection();
                productTypeSelect.addEventListener('change', toggleAttributesSection);
            });

            function toggleAttributesSection() {
                const type = document.getElementById('product-type').value;
                const attributeSection = document.getElementById('attribute-section');
                const attributesContainer = document.getElementById('attributes-container');

                if (type === 'attribute') {
                    // Show the attribute section
                    if (attributeSection) {
                        attributeSection.style.display = 'block';
                    }
                    // Add attributes if none exist
                    ensureFirstAttributeExists();
                } else {
                    // Hide the attribute section
                    if (attributeSection) {
                        attributeSection.style.display = 'none';
                    }
                    // Clear all input fields for the attributes container
                    if (attributesContainer) {
                        attributesContainer.innerHTML = '';
                    }
                }
            }

            function ensureFirstAttributeExists() {
                const container = document.getElementById('attributes-container');
                if (container && !container.children.length) {
                    addAttribute();
                }
            }

            function addAttribute() {
                const container = document.getElementById('attributes-container');
                if (container && container.children.length > 0) return; // Avoid adding extra attributes

                const attributeHTML = `
                    <div class="mb-3">
                        <label>Attribute Name</label>
                        <input type="text" name="attribute[name]" class="form-control" required>
                        
                        <div>
                            <label>Values</label>
                            <div id="attribute-values-0"></div>
                            <button type="button" class="btn btn-secondary" onclick="addValue(0)">Add Value</button>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', attributeHTML);
                addValue(0); // Automatically add the first value input field
            }

            function addValue(attributeIndex = 0) {
                const valueContainer = document.getElementById('attribute-values-' + attributeIndex);
                if (!valueContainer) return;

                const valueIndex = valueContainer.children.length;

                const valueHTML = `
                    <div class="input-group mb-3 value-block">
                        <input type="text" name="attribute[values][${valueIndex}][value]" 
                            placeholder="Value" class="form-control" required>
                        <input type="decimal" name="attribute[values][${valueIndex}][price]" 
                            placeholder="Price" class="form-control" required>
                        ${valueIndex > 0 ? `<button type="button" class="btn btn-danger" onclick="removeValue(this)">Remove</button>` : ''}
                    </div>
                `;
                valueContainer.insertAdjacentHTML('beforeend', valueHTML);
            }

            function removeValue(button) {
                const valueBlock = button.closest('.value-block');
                if (valueBlock) {
                    valueBlock.remove();
                }
            }
        </script>
    @endsection
