@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.products') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.products.create') }}" class="text-muted">{{ __('dashboard.create') }}</a>
                    </li>
                </ul>
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
                        <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
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
                                <!-- Category and Names Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.general_info') }}</h4>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.name_ar') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name_ar" value="{{ old('name_ar') }}"
                                                    class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name_ar') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.name_en') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name_en" value="{{ old('name_en') }}"
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
                                                <input type="text" name="sku" value="{{ old('sku') }}"
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
                                                            {{ old('category_id', $selectedCategoryId ?? '') == $category->id ? 'selected' : '' }}>
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
                                                <label>{{ __('dashboard.short_description_ar') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="short_desc_ar" cols="30" rows="10"
                                                    class="form-control ckeditor {{ $errors->has('short_desc_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.short_desc_ar') }}">{{ old('short_desc_ar') }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('short_desc_ar') ? $errors->first('short_desc_ar') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.short_description_en') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="short_desc_en" cols="30" rows="10"
                                                    class="form-control ckeditor lang-en {{ $errors->has('short_desc_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.short_desc_en') }}">{{ old('short_desc_en') }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('short_desc_en') ? $errors->first('short_desc_en') : '' }}</span>
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
                                                <label>{{ __('dashboard.description_ar') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="description_ar" cols="30" rows="10"
                                                    class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_ar') }}">{{ old('description_ar') }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('description_ar') ? $errors->first('description_ar') : '' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.description_en') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="description_en" cols="30" rows="10"
                                                    class="form-control ckeditor lang-en {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_en') }}">{{ old('description_en') }}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('description_en') ? $errors->first('description_en') : '' }}</span>
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
                                                <label>{{ __('dashboard.price') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                                    class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.price') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('price') ? $errors->first('price') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.discount_price') }}
                                                    ({{ __('dashboard.if_found') }})</label>
                                                <input type="number" name="discount_price"
                                                    value="{{ old('discount_price') }}"
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
                                                    value="{{ old('sale_start_date') }}"
                                                    class="form-control {{ $errors->has('sale_start_date') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.sale_start_date') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('sale_start_date') ? $errors->first('sale_start_date') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sale_end_date') }}</label>
                                                <input type="date" name="sale_end_date"
                                                    value="{{ old('sale_end_date') }}"
                                                    class="form-control {{ $errors->has('sale_end_date') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.sale_end_date') }}" />
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
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="product-type" class="form-label">Product Type</label>
                                                <select class="form-control @error('type') is-invalid @enderror"
                                                    id="product-type" name="type" class="form-select"
                                                    onchange="toggleAttributesSection()">
                                                    <option value="simple"
                                                        {{ old('type') == 'simple' ? 'selected' : '' }}>Simple</option>
                                                    <option value="attribute"
                                                        {{ old('type') == 'attribute' ? 'selected' : '' }}>Attribute
                                                    </option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div id="attribute-section" style="display: none;">
                                                <label class="form-label">Attribute</label>
                                                <div id="attributes-container"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.stock') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="stock" value="{{ old('stock') }}"
                                                    class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.stock') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('stock') ? $errors->first('stock') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.tax_rate') }} </label>
                                                <input type="number" name="tax_rate" value="{{ old('tax_rate') }}"
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
                                    <div class="row">
                                        <!-- Image Fields -->
                                        <div class="col-md-6 form-group m-form__group">
                                            <label class="col-form-label"
                                                for="images">{{ __('dashboard.image') }}</label>
                                            <span class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control m-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                name="image" id="images" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                        </div>

                                        <div class="col-md-6 form-group m-form__group">
                                            <label class="col-form-label"
                                                for="images">{{ __('dashboard.images') }}</label>
                                            <span class="text-danger">*</span></label>
                                            <input type="file" multiple
                                                class="form-control m-input {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                                                name="photo[]" id="images" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('photo') ? $errors->first('photo') : '' }}</span>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.video') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="video" value="{{ old('video') }}"
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
                                                    value="{{ old('meta_title_ar') }}"
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
                                                    value="{{ old('meta_title_en') }}"
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
                                                <input type="text" name="alt_image" value="{{ old('alt_image') }}"
                                                    class="form-control {{ $errors->has('alt_image') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.alt_image') }}" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('alt_image') ? $errors->first('alt_image') : '' }}</span>
                                            </div>
                                        </div>


                                        <!-- Descriptions Section -->
                                        <div class="col-md-12">
                                            <h4>{{ __('dashboard.meta_description') }}</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('dashboard.meta_description_ar') }} <span
                                                                class="text-danger">*</span></label>
                                                        <textarea name="meta_description_ar" cols="30" rows="10"
                                                            class="form-control ckeditor {{ $errors->has('meta_description_ar') ? 'is-invalid' : '' }}"
                                                            placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_description_ar') }}">{{ old('meta_description_ar') }}</textarea>
                                                        <span
                                                            class="form-text text-danger">{{ $errors->has('meta_description_ar') ? $errors->first('meta_description_ar') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('dashboard.meta_description_en') }} <span
                                                                class="text-danger">*</span></label>
                                                        <textarea name="meta_description_en" cols="30" rows="10"
                                                            class="form-control ckeditor lang-en {{ $errors->has('meta_description_en') ? 'is-invalid' : '' }}"
                                                            placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_description_en') }}">{{ old('meta_description_en') }}</textarea>
                                                        <span
                                                            class="form-text text-danger">{{ $errors->has('meta_description_en') ? $errors->first('meta_description_en') : '' }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                {!! csrf_field() !!}
                                <button type="submit"
                                    class="btn btn-primary mr-2">{{ __('dashboard.submit') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ __('dashboard.cancel') }}</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const discountPriceField = document.querySelector('input[name="discount_price"]');
                const saleStartDateField = document.querySelector('input[name="sale_start_date"]');
                const saleEndDateField = document.querySelector('input[name="sale_end_date"]');

                function updateFields() {
                    const discountPrice = parseFloat(discountPriceField.value);

                    if (isNaN(discountPrice) || discountPrice <= 0) {
                        // Disable and make fields optional
                        saleStartDateField.disabled = true;
                        saleEndDateField.disabled = true;
                        saleStartDateField.removeAttribute('required');
                        saleEndDateField.removeAttribute('required');
                    } else {
                        // Enable and make fields required
                        saleStartDateField.disabled = false;
                        saleEndDateField.disabled = false;
                        // saleStartDateField.setAttribute('required', 'required');
                        // saleEndDateField.setAttribute('required', 'required');
                    }
                }

                // Initialize fields on page load
                updateFields();

                // Add event listener to discount price field
                discountPriceField.addEventListener('input', updateFields);

                // Ensure no negative values are allowed in discount price
                discountPriceField.addEventListener('input', function() {
                    if (parseFloat(discountPriceField.value) < 0) {
                        discountPriceField.value = '';
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const productType = document.getElementById('product-type').value;
                if (productType === 'attribute') {
                    toggleAttributesSection(); // Make sure the "Attribute" section is visible
                }
            });

            function toggleAttributesSection() {
                const type = document.getElementById('product-type').value;
                var priceInput = document.getElementById('price');

                const attributeSection = document.getElementById('attribute-section');
                const attributeInputs = document.querySelectorAll(
                    '#attributes-container input, #attributes-container select'
                );

                if (type === 'attribute') {
                    attributeSection.style.display = 'block';
                    ensureFirstAttributeExists();

                    // Make attribute inputs required
                    attributeInputs.forEach(input => {
                        input.required = true;
                    });
                    priceInput.disabled = true;

                } else {
                    attributeSection.style.display = 'none';
                    document.getElementById('attributes-container').innerHTML = '';

                    // Remove required attribute from inputs
                    attributeInputs.forEach(input => {
                        input.required = false;
                    });
                    priceInput.disabled = false;

                }
            }

            function ensureFirstAttributeExists() {
                const container = document.getElementById('attributes-container');
                if (!container.children.length) {
                    addAttribute();
                }
            }

            function addAttribute() {
                const container = document.getElementById('attributes-container');
                // Prevent additional attributes (as per previous restriction)
                if (container.children.length > 0) return;

                const attributeHTML = `
                    <div class="mb-3">
                        <label>Attribute Name</label>
                        <input type="text" name="attribute[name]" class="form-control @error('attributes.attribute_name') is-invalid @enderror" required>
                        
                        <div>
                            <label>Values</label>
                            <div id="attribute-values"></div>
                            <button type="button" class="btn btn-secondary" onclick="addValue()">Add Value</button>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', attributeHTML);

                // Automatically add the first value
                addValue(true);
            }

            function addValue(isFirstValue = false) {
                const valueContainer = document.getElementById('attribute-values');
                const valueIndex = valueContainer.children.length;
                const isRequiredValue = isFirstValue || valueIndex === 0;

                const valueHTML = `
                    <div class="input-group mb-3 value-block">
                        <input type="text" name="attribute[values][${valueIndex}][value]" 
                            placeholder="Value" 
                            class="form-control" 
                            ${isRequiredValue ? 'required' : ''}>
                        <input type="number" name="attribute[values][${valueIndex}][price]" 
                            placeholder="Price" 
                            class="form-control" 
                            ${isRequiredValue ? 'required' : ''}>
                        ${!isRequiredValue ? 
                            `<button type="button" class="btn btn-danger" onclick="removeValue(this)">Remove</button>` 
                            : ''}
                    </div>
                `;
                valueContainer.insertAdjacentHTML('beforeend', valueHTML);
            }

            function removeValue(button) {
                button.closest('.value-block').remove();
            }
        </script>
    @endsection
