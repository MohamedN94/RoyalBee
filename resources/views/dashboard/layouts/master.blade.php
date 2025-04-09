@extends('dashboard.layouts.app')
@section('page')
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    @include('dashboard.includes.mobileHeader')
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            @include('dashboard.includes.sidebar')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include('dashboard.includes.header')
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    @yield('subheader')
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    @yield('content')
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                @include('dashboard.includes.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    @include('dashboard.includes.userTopBar')
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->
@endsection
<script src="https://cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description_ar', {
        height: 500, // Adjust the editor's height
        extraPlugins: 'image2,justify,font,colorbutton', // Add optional plugins if needed
        removePlugins: 'elementspath', // Optional: remove extra path from the bottom
        toolbar: [{
                name: 'document',
                items: ['Source', '-', 'Save', '-', 'Preview']
            },
            {
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Find', 'Replace']
            },
            '/',
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'insert',
                items: ['Link', 'Unlink', 'Image', 'Table']
            },
            '/',
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'tools',
                items: ['Maximize']
            },
        ],
    });
</script>
<style>
    .elementor-element .elementor-widget-container {
        transition: background .3s, border .3s, border-radius .3s, box-shadow .3s, transform var(--e-transform-transition-duration, .4s) !important;
    }

    .bottle {
        border-style: solid !important;
        border-width: 0 !important;
        background-color: rgba(255, 255, 255, 1) !important;
        align-items: center !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        border-radius: 28px !important;
        display: flex !important;
        justify-content: space-between !important;
        z-index: 100 !important;
        padding: 18px !important;
        background-size: cover !important;
        background-repeat: no-repeat !important;
        background-position: top center !important;
        background-image: url(https://assets.lightfunnels.com/account-1/images_library/117cc9f6-69bc-4fe5-b8db-b944cf8b72fa.Assetdfhdf.svg) !important;
        box-shadow: 0 3px 20px 0 rgba(146, 86, 3, .13), 0 0 16px 0 rgba(22, 22, 36, .03) !important;
        margin: 40px 0 !important;
    }

    .bottle .content {
        max-width: 100% !important;
        width: 60% !important;
    }

    .bottle .content .wrap {
        max-width: 100% !important;
        margin-right: auto !important;
        margin-left: auto !important;
        width: 450px !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
    }

    .bottle h2 {
        font-family: "Tajawal", sans-serif !important;
        text-align: center !important;
        line-height: 100% !important;
        letter-spacing: -1px !important;
        font-weight: 700 !important;
        color: rgba(221, 133, 0, 1) !important;
        font-size: 30px !important;
        position: relative !important;
        display: inline-block !important;
        margin: 20px 0 30px 0 !important;
    }

    .bottle h2::after {
        content: '' !important;
        display: block !important;
        width: 100% !important;
        height: 10px !important;
        box-shadow: 0 -.7em 0 0 rgba(251, 242, 229, 1) inset !important;
        position: absolute !important;
        left: 0 !important;
        bottom: -20px !important;
    }

    .bottle p {
        font-family: "Tajawal", sans-serif !important;
        color: rgba(103, 96, 95, 1) !important;
        font-weight: 500 !important;
        line-height: 160% !important;
        text-align: center !important;
        font-size: 17px !important;
        margin-top: 10px !important;
    }

    .bottle .image {
        width: 40% !important;
        max-width: 100% !important;
        display: flex !important;
        justify-content: center !important;
    }

    .elementor img {
        height: auto !important;
        max-width: 100% !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .bottle img {
        max-width: 100% !important;
        width: auto !important;
        border-style: solid !important;
        border-radius: 12px !important;
        border-width: 0 !important;
        max-height: 320px !important;
        height: 320px !important;
        width: 320px !important;
    }
</style>
@include('dashboard.partials._session')
