<!-- App footer -->
@php
    $contactPages = \App\Models\Admin\Page::where('page_type_id' , 1)->get();
    $conditionsPages = \App\Models\Admin\Page::where('page_type_id' , 2)->get();
    $aboutPages = \App\Models\Admin\Page::where('page_type_id' , 3)->get();
@endphp
<footer class="footer " style="background-color: #fefefe;color: #000000;border-top: 1px solid #f0f0f0;">
    <div class="container">
        <div class="footer-brand">
            <a class="" href="{{route('web.home')}}">
                <img src="{{asset('front/asset/image/logo.webp')}}" alt="bees-army"/>
            </a>
        </div>
        <div class="footer-body">
            <div class="is-grid grid-3">
                <div class="footer-item">
                    <h3>إتصل بنا</h3>
                    <ul class="list-unstyled footer-list">
                        @foreach($contactPages as $contactPage)
                            <li>
                                <a href="{{route('web.pages.show',$contactPage->slug)}}" style="color: #000000;">
                                    {{$contactPage->name_ar}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-item">
                    <h3>الشروط والسياسات</h3>
                    <ul class="list-unstyled footer-list">
                        @foreach($conditionsPages as $conditionPage)
                            <li>
                                <a href="{{route('web.pages.show',$conditionPage->slug)}}" style="color: #000000;">
                                    {{$conditionPage->name_ar}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-item">
                    <h3>عن المتجر</h3>
                    <ul class="list-unstyled footer-list">
                        @foreach($aboutPages as $boutPage)
                            <li>
                                <a href="{{route('web.pages.show',$boutPage->slug)}}" style="color: #000000;">
                                    {{$boutPage->name_ar}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <ul class="list-unstyled footer-social">
            <li>
                <a class="facebook" target="_blank" href="https://www.facebook.com/">
                    <i class="yc yc-facebook"></i>
                </a>
            </li>
            <li>
                <a class="instagram" target="_blank" href="https://www.instagram.com/">
                    <i class="yc yc-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
    <script src="{{asset('assets/js/jquary-3.6.0.min.js')}}"></script>
    <script src="{{asset('front/asset/js/popper.min.js')}}"></script>
    <script src="{{asset('front/asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/asset/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/plugins/noty/noty.min.js') }}"></script>
    <script src="{{asset('assets/plugins/toaster/toast.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('front/asset/js/app677e.js')}}"></script>
    <script src="{{asset('front/asset/js/categories/list3f48.js')}}"></script>
    <script>
        toastr.options = {
            "closeButton": false,                // Show close button
            "debug": false,                     // Debug mode
            "newestOnTop": true,                // Display newest notification on top
            "progressBar": true,                // Show progress bar
            "positionClass": "toast-top-left", // Position in top right corner
            "preventDuplicates": false,         // Prevent duplicate notifications
            "onclick": null,                    // OnClick event
            "showDuration": "300",              // Show duration in milliseconds
            "hideDuration": "1000",             // Hide duration in milliseconds
            "timeOut": "2000",                  // Auto close timeout
            "extendedTimeOut": "1000",          // Extended timeout
            "showEasing": "swing",              // Show easing effect
            "hideEasing": "linear",             // Hide easing effect
            "showMethod": "fadeIn",             // Show method
            "hideMethod": "fadeOut"             // Hide method
        };
    </script>
</footer>
<!-- Hookables -->

