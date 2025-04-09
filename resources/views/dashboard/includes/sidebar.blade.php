<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="{{ route('dashboard.index') }}" class="brand-logo">
            <h2 class="text-white">Bees</h2>
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ request()->is('en') || request()->is('ar') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                    <path
                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('dashboard.dashboard') }}</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">{{ __('dashboard.pages') }}</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color: #FF2157;"></i>
                </li>
                @hasRoleOnModel('user')
                <li class="menu-item {{ request()->is('*/users*') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a @can('read_user')
                       href="{{ route('dashboard.users.index') }}"
                       @elsecan('create_user')
                       href="{{ route('dashboard.users.create') }}"
                       @endcan
                        class="menu-link">


                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="currentColor"></path>
                                <rect opacity="0.3" x="8" y="3" width="8" height="8"
                                    rx="4" fill="currentColor"></rect>
                            </svg>
                        </span>

                        <span class="menu-text">{{ __('dashboard.users') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel
                @hasRoleOnModel('role')
                <li class="menu-item  {{ request()->is('*/roles*') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a @can('read_role')
                           href="{{ route('dashboard.roles.index') }}"
                       @elsecan('create_role')
                           href="{{ route('dashboard.roles.create') }}"
                       @endcan
                        class="menu-link">
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.5 11C8.98528 11 11 8.98528 11 6.5C11 4.01472 8.98528 2 6.5 2C4.01472 2 2 4.01472 2 6.5C2 8.98528 4.01472 11 6.5 11Z"
                                    fill="currentColor"></path>
                                <path opacity="0.3"
                                    d="M13 6.5C13 4 15 2 17.5 2C20 2 22 4 22 6.5C22 9 20 11 17.5 11C15 11 13 9 13 6.5ZM6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22ZM17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span> <span class="menu-text">{{ __('dashboard.roles') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel


                @hasRoleOnModel('category')
                <li class="menu-item {{ request()->is('*/Categories*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.Categories.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.categories') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('page')
                <li class="menu-item {{ request()->is('*/pages*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.pages.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.pages') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('slider')
                <li class="menu-item {{ request()->is('*/sliders*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.sliders.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.sliders') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('product')
                <li class="menu-item {{ request()->is('*/products*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.products.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.products') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('payment')
                <li class="menu-item {{ request()->is('*/payments*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.payments.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.payments') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('info')
                <li class="menu-item {{ request()->is('*/Information*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.Information.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.info') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('info')
                <li class="menu-item {{ request()->is('*/settings*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.settings.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.settings') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('seo')
                <li class="menu-item {{ request()->is('*/SEO*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.SEO.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.seo') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('contact')
                    <li class="menu-item {{ request()->is('*/Contact*') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('dashboard.Contact.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('dashboard.Contact') }}</span>
                        </a>
                    </li>

                @endhasRoleOnModel

                @hasRoleOnModel('coupon')

                <li class="menu-item {{ request()->is('*/coupons*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.coupons.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.coupons') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('category')
                <li class="menu-item {{ request()->is('*/featured_categories*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.featured_categories.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.featured_categories') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel

                @hasRoleOnModel('blog')
                    <li class="menu-item {{ request()->is('*/Blogs*') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('dashboard.Blogs.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('dashboard.blog') }}</span>
                        </a>
                    </li>
                @endhasRoleOnModel
                
                @hasRoleOnModel('reel')
                    <li class="menu-item {{ request()->is('*/Reels*') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('dashboard.Reels.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('dashboard.Reel') }}</span>
                        </a>
                    </li>
                @endhasRoleOnModel

                @hasRoleOnModel('country')
                    <li class="menu-item {{ request()->is('*/countries*') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('dashboard.countries.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('dashboard.countries') }}</span>
                        </a>
                    </li>
                @endhasRoleOnModel

                @hasRoleOnModel('state')
                <li class="menu-item {{ request()->is('*/states*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.states.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.State') }}</span>
                    </a>
                </li>
                @endhasRoleOnModel


            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
