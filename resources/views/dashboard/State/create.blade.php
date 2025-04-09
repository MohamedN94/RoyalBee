@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.State') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.states.create') }}" class="text-muted">{{ __('dashboard.create') }}</a>
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
                        <form action="{{ route('dashboard.states.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label>{{ __('dashboard.country') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="country_id"
                                                    class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.country') }}">
                                                    <option selected disabled>{{ __('dashboard.choose-country') }}
                                                    </option>
                                                    @foreach ($countries as $country)
                                                        @php
                                                            $locale = app()->getLocale();
                                                            $localizedName = 'name_' . $locale;
                                                        @endphp
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id', $selectedCountryId ?? '') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->$localizedName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country_id'))
                                                    <span
                                                        class="form-text text-danger">{{ $errors->first('country_id') }}</span>
                                                @endif
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
