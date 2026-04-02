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




            {{-- @can('new-application') --}}
                <li>
                    <a href="{{ route('admin.services') }}">
                        <iconify-icon icon="mdi:file-document-outline" class="menu-icon"></iconify-icon>
                        <span>New Application</span>
                    </a>
                </li>
            {{-- @endcan --}}



    <li>
        <a href="{{ route('admin.settings.index') }}">
            <iconify-icon icon="mdi:magnify" class="menu-icon"></iconify-icon>
            <span>Find Application</span>
        </a>
    </li>



    <li>
        <a href="{{ route('admin.users.index') }}">
            <iconify-icon icon="mdi:note-outline" class="menu-icon"></iconify-icon>
            <span>Notepad</span>
        </a>
    </li>



            @can('user-list')
                <li class=" ">
                    <a href="{{ $isAdmin ? route('admin.users.index') : route('user.subusers.index') }}">
                        <iconify-icon icon="mdi:account-group-outline" class="menu-icon"></iconify-icon>
                        <span>Users</span>
                    </a>

                </li>
            @endcan



            @can('activity-logs')
                <li>
                    <a href="{{ route('admin.logs.logs') }}">
                        <iconify-icon icon="mdi:history" class="menu-icon"></iconify-icon>
                        <span>Activities</span>
                    </a>
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




        </ul>
    </div>
</aside>
