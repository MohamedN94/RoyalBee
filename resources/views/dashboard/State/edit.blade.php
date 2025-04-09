@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.State') }}</h5>
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
                        <form action="{{ route('dashboard.states.update', $State->id) }}" method="POST"
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
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.name_ar') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="name_ar"
                                                    value="{{ old('name_ar', $State->name_ar) }}"
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
                                                    value="{{ old('name_en', $State->name_en) }}"
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
                                                            {{ old('country_id', $State->country_id ?? '') == $country->id ? 'selected' : '' }}>
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
