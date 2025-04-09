@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.categories')}}</h5>
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
    border-bottom: 1px solid #ddd; /* Light gray border for separation */
    margin-bottom: 20px; /* Space between sections */
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
                        <form action="{{route('dashboard.products.update',$product->id)}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="section">
                                    <h4>{{ __('dashboard.general_info') }}</h4>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('dashboard.name_ar')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="name_ar"
                                                       value="{{old('name_ar',$product->name_ar)}}"
                                                       class="form-control {{$errors->has('name_ar')? 'is-invalid':''}}"
                                                       placeholder="{{__('dashboard.enter').' '.__('dashboard.name_ar')}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('name_ar')? $errors->first("name_ar"):''}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('dashboard.name_en')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="name_en"
                                                       value="{{old('name_en',$product->name_en)}}"
                                                       class="form-control {{$errors->has('name_en')? 'is-invalid':''}}"
                                                       placeholder="{{__('dashboard.enter').' '.__('dashboard.name_en')}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('name_en')? $errors->first("name_en"):''}}</span>
                                            </div>
                                        </div>
    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sku') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.sku') }}" />
                                                <span class="form-text text-danger">{{ $errors->has('sku') ? $errors->first('sku') : '' }}</span>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.category') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="category_id"
                                                        class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                                        placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.category') }}">
                                                    <option selected disabled>{{ __('dashboard.choose-category') }}</option>
                                                    @foreach($categories as $category)
                                                        @php
                                                            $locale = app()->getLocale();
                                                            $localizedName = 'name_' . $locale;
                                                        @endphp
                                                        <option
                                                            value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
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
                                    <h4>{{ __('dashboard.description') }}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('dashboard.description_en')}}
                                                    <span class="text-danger">*</span></label>
                                                <textarea type="text" name="description_en" cols="30" rows="10"
                                                          class="form-control ckeditor lang-en {{$errors->has('description_en')? 'is-invalid':''}}"
                                                          placeholder="{{__('dashboard.enter').' '.__('dashboard.description_en')}}">
                                                        {{old('description_en',$product->description_en)}}
                                                    </textarea>
        
                                                <span
                                                    class="form-text text-danger">{{$errors->has('description_en')? $errors->first("description_en"):''}}</span>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('dashboard.description_ar')}}
                                                    <span class="text-danger">*</span></label>
                                                <textarea type="text" name="description_ar" cols="30" rows="10"
                                                          class="form-control ckeditor  {{$errors->has('description_ar')? 'is-invalid':''}}"
                                                          placeholder="{{__('dashboard.enter').' '.__('dashboard.description_ar')}}">
                                                        {{old('description_ar',$product->description_ar)}}
                                                    </textarea>
        
                                                <span
                                                    class="form-text text-danger">{{$errors->has('description_ar')? $errors->first("description_ar"):''}}</span>
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
                                                <label>{{__('dashboard.price')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" name="price" value="{{old('price',$product->price)}}"
                                                       class="form-control {{$errors->has('price')? 'is-invalid':''}}"
                                                       placeholder="{{__('dashboard.enter').' '.__('dashboard.price')}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('price')? $errors->first("price"):''}}</span>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('dashboard.discount_price')}} ({{__('dashboard.if_found')}}
                                                    )</label>
                                                <input type="number" name="discount_price"
                                                       value="{{old('discount_price',$product->discount_price)}}"
                                                       class="form-control {{$errors->has('discount_price')? 'is-invalid':''}}"
                                                       placeholder="{{__('dashboard.enter').' '.__('dashboard.discount_price')}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('discount_price')? $errors->first("discount_price"):''}}</span>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sale_start_date') }}</label>
                                                <input type="date" name="sale_start_date" value="{{ old('sale_start_date', $product->sale_start_date) }}" class="form-control {{ $errors->has('sale_start_date') ? 'is-invalid' : '' }}" />
                                                <span class="form-text text-danger">{{ $errors->has('sale_start_date') ? $errors->first('sale_start_date') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.sale_end_date') }}</label>
                                                <input type="date" name="sale_end_date" value="{{ old('sale_end_date', $product->sale_end_date) }}" class="form-control {{ $errors->has('sale_end_date') ? 'is-invalid' : '' }}" />
                                                <span class="form-text text-danger">{{ $errors->has('sale_end_date') ? $errors->first('sale_end_date') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- New Fields Section -->
                                <div class="section">
                                    <h4>{{ __('dashboard.additional_info') }}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.stock') }} <span class="text-danger">*</span></label>
                                                <input type="number" name="stock" value="{{ old('stock' , $product->stock) }}" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.stock') }}"/>
                                                <span class="form-text text-danger">{{ $errors->has('stock') ? $errors->first('stock') : '' }}</span>
                                            </div>
                                        </div>
                                
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.tax_rate') }} </label>
                                                <input type="number" name="tax_rate" value="{{ old('tax_rate' , $product->tax_rate) }}" class="form-control {{ $errors->has('tax_rate') ? 'is-invalid' : '' }}" placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.tax_rate') }}" step="0.01"/>
                                                <span class="form-text text-danger">{{ $errors->has('tax_rate') ? $errors->first('tax_rate') : '' }}</span>
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
                                                   name="image" id="images"/>
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
                                                   name="photo[]" id="images"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('photo') ? $errors->first('photo') : '' }}</span>
                                        </div>
                                        @if($product->has('photos'))
                                            @foreach($product->photos as $photo)
                                                @if(!empty($photo->photo) && $photo->count())
                                                    <div class="col-md-3" id="removable{{$photo->id}}"  style="text-align: center;">
                                                        <img src="{{asset(optional($photo)->photo)}}"
                                                             class="img-responsive center-block"
                                                             style="max-height: 100px;">
                                                        <div class="clearfix"></div>
                                                        <button id="{{$photo->id}}" data-token="{{ csrf_token() }}"
                                                                data-route="{{URL::route('dashboard.photo.destroy',$photo->id)}}"
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

                            </div>
                    </div>
                    <div class="card-footer">
                        {!! csrf_field() !!}
                        <button type="submit"
                                class="btn btn-primary mr-2">{{__('dashboard.submit')}}</button>
                        <a href="{{route('dashboard.products.index')}}" type="reset"
                           class="btn btn-secondary">{{__('dashboard.cancel')}}</a>
                    </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
    <!--end::Container-->
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.destroy', function (e) {
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
                    Noty.button('نعم', 'btn btn-success mr-2', function () {
                        $.ajax({
                            url: route,
                            type: 'post',
                            data: {_method: 'delete', _token: token},
                            dataType: 'json',
                            success: function (response) {
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

                    Noty.button('لا', 'btn btn-danger mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
    
@endsection
