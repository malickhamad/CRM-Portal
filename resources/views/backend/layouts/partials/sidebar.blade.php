@php
    $isAdmin = auth()->user()->hasRole('Admin');
    $isSubuser = auth()->user()->hasRole('Subuser');

@endphp
{{-- sidebar2 --}}
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="mdi:close"></iconify-icon>
    </button>
    <div class="align-center mr-3">
        <a href="{{ url('/') }}">
            <img src="{{ isset($siteSettings['site_logo']) && file_exists(storage_path('app/public/' . $siteSettings['site_logo'])) ? asset('storage/' . $siteSettings['site_logo']) : asset('asset/backend/images/fivestarlogo.png') }}"
                alt="Site Logo" style="height: 3rem; margin-top: 0.6rem;">
        </a>

    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li style="margin-bottom: 8px;">
                <a
                    href="{{ $isAdmin ? route('admin.dashboard') : ($isSubuser ? route('user.subuserdashboard') : route('user.dashboard')) }}">
                    <iconify-icon icon="mdi:view-dashboard-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>


            @can('plans-list')
                <li class="">
                    <a href="{{ route('admin.subscription-plans.index') }}">
                        <iconify-icon icon="mdi:clipboard-text-multiple-outline" class="menu-icon"></iconify-icon>
                        <span>Plans</span>
                    </a>
                    {{-- <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('admin.subscription-plans.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Plans
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subscription-plans.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Plan
                            </a>
                        </li>
                    </ul> --}}
                </li>
            @endcan

            {{-- @can('plan-features-list')
                <li class="">
                    <a href="{{ route('admin.plan-features.index') }}">
                        <iconify-icon icon="mdi:feature-search-outline" class="menu-icon"></iconify-icon>
                        <span>Plan Features</span>
                    </a>
                    <!-- <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('admin.plan-features.index') }}">
                                <i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> List Features
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.plan-features.create') }}">
                                <i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Create Feature
                            </a>
                        </li>
                    </ul> -->
                </li>
            @endcan --}}



            @can('category')
                <li class="">
                    <a href="{{ route('admin.categories.index') }}">
                        <iconify-icon icon="mdi:feature-search-outline" class="menu-icon"></iconify-icon>
                        <span>Categories
                        </span>
                    </a>
                    <!-- <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('admin.categories.index') }}">
                                            <i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>Categories

                                        </a>
                                    </li>
                                </ul> -->
                </li>
            @endcan


            @can('customers-list')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-home-6-line text-xl me-14 d-flex w-auto"></i>Customers
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('admin.customers.index') }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i>Customers
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.upgrade-requests.index') }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i>
                                <span>Requests</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan


            @can('user-subscription')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-home-6-line text-xl me-14 d-flex w-auto"></i>
                        <span>Subscription</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('user.subscription.show', auth()->id()) }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i> History
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.subscription', auth()->id()) }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Upgrade
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan


            @can('user-list')
                <li class=" ">
                    <a href="{{ $isAdmin ? route('admin.users.index') : route('user.subusers.index') }}">
                        <iconify-icon icon="mdi:account-group-outline" class="menu-icon"></iconify-icon>
                        <span>Users</span>
                    </a>

                </li>
            @endcan


            {{-- @can('admin-reports')
                <li class=" ">
                    <a href="{">
                        <i class="ri-bar-chart-box-line text-xl me-14 d-flex w-auto"></i>
                        <span>Reports</span>
                    </a>
                </li>
            @endcan --}}


            @can('activity-logs')
                <li>
                    <a href="{{ route('admin.logs.logs') }}">
                        <iconify-icon icon="mdi:history" class="menu-icon"></iconify-icon>
                        <span>Activities</span>
                    </a>
                </li>
            @endcan




            @can('payment-history')
                <li class="dropdown">
                    <a href="{{ route('admin.payments-history.index') }}">
                        <iconify-icon icon="mdi:cash-multiple" class="menu-icon"></iconify-icon>
                        <span>Payment History</span>
                    </a>
                    {{--
                            <li>
                                <a href="{{ route('admin.payments-history.index') }}">
                                    <i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Show
                                </a>
                            </li> --}}

                </li>
            @endcan






            @can('role-list')
                <li class="dropdown">
                    <a href="{{ $isAdmin ? route('admin.roles.index') : route('user.roles.index') }}">
                        <iconify-icon icon="mdi:account-cog-outline" class="menu-icon"></iconify-icon>
                        <span>Roles</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ $isAdmin ? route('admin.roles.index') : route('user.roles.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ $isAdmin ? route('admin.roles.create') : route('user.roles.create') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Add Roles
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan


            {{-- @can('permission-list')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:key-outline" class="menu-icon"></iconify-icon>
                        <span>Permissions</span>
                    </a>
                    <ul class="sidebar-submenu">

                        <li>
                            <a
                                href="{{ $isAdmin ? route('admin.permissions.create') : route('user.permissions.create') }}">
                                <i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Add Permission
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan --}}





            @can('settings')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                        <span>Settings</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ $isAdmin ? route('admin.permissions.index') : route('user.permissions.index') }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Permissions
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.index') }}"><i
                                    class="ri-circle-fill circle-icon text-success-main w-auto"></i>
                                Site Settings</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contacts.index') }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i>
                                <span>Contact Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.faqs.index') }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i> FAQ's
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.testimonials.index') }}">
                                <i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Testimonials
                            </a>
                        </li>

                    </ul>


                </li>
            @endcan


                <li style="margin-bottom: 8px;">
                <a
                    href="{{ route('services')}}">
                    <iconify-icon icon="mdi:view-dashboard-outline" class="menu-icon"></iconify-icon>
                    <span>Services</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
