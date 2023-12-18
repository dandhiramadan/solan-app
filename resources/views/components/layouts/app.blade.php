<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/assets/"
    data-template="horizontal-menu-template">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>{{ $title ?? 'Page Title' }}</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
        <link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="/assets/css/demo.css" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/swiper/swiper.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
        <link rel="stylesheet" href="/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

        <!-- Page CSS -->
        <link rel="stylesheet" href="/assets/vendor/css/pages/cards-advance.css" />

        <!-- Helpers -->
        <script src="/assets/vendor/js/helpers.js"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
        <script src="/assets/vendor/js/template-customizer.js"></script>
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="/assets/js/config.js"></script>

        @livewireStyles
        @stack('styles')
    </head>
    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
            <div class="layout-container">

            @include('components.partials.navbar')

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                    <div class="container-xxl d-flex h-100">
                    <ul class="menu-inner">
                        <!-- Dashboards -->
                        <li class="menu-item active">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item active">
                            <a href="index.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                <div data-i18n="Analytics">Analytics</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="dashboards-crm.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-3d-cube-sphere"></i>
                                <div data-i18n="CRM">CRM</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="app-ecommerce-dashboard.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                                <div data-i18n="eCommerce">eCommerce</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="app-logistics-dashboard.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-truck"></i>
                                <div data-i18n="Logistics">Logistics</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="app-academy-dashboard.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-book"></i>
                                <div data-i18n="Academy">Academy</div>
                            </a>
                            </li>
                        </ul>
                        </li>

                        <!-- Layouts -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                            <div data-i18n="Layouts">Layouts</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a href="layouts-without-menu.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-menu-2"></i>
                                <div data-i18n="Without menu">Without menu</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                                <i class="menu-icon tf-icons ti ti-layout-distribute-vertical"></i>
                                <div data-i18n="Vertical">Vertical</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="layouts-fluid.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-maximize"></i>
                                <div data-i18n="Fluid">Fluid</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="layouts-container.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-arrows-maximize"></i>
                                <div data-i18n="Container">Container</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="layouts-blank.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-square"></i>
                                <div data-i18n="Blank">Blank</div>
                            </a>
                            </li>
                        </ul>
                        </li>

                        <!-- Apps -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-layout-grid-add"></i>
                            <div data-i18n="Apps">Apps</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a href="app-email.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-mail"></i>
                                <div data-i18n="Email">Email</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="app-chat.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-messages"></i>
                                <div data-i18n="Chat">Chat</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="app-calendar.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-calendar"></i>
                                <div data-i18n="Calendar">Calendar</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="app-kanban.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                                <div data-i18n="Kanban">Kanban</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                                <div data-i18n="eCommerce">eCommerce</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="app-ecommerce-dashboard.html" class="menu-link">
                                    <div data-i18n="Dashboard">Dashboard</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Products">Products</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="app-ecommerce-product-list.html" class="menu-link">
                                        <div data-i18n="Product List">Product List</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-product-add.html" class="menu-link">
                                        <div data-i18n="Add Product">Add Product</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-category-list.html" class="menu-link">
                                        <div data-i18n="Category List">Category List</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Order">Order</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="app-ecommerce-order-list.html" class="menu-link">
                                        <div data-i18n="Order List">Order List</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-order-details.html" class="menu-link">
                                        <div data-i18n="Order Details">Order Details</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Customer">Customer</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="app-ecommerce-customer-all.html" class="menu-link">
                                        <div data-i18n="All Customers">All Customers</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <div data-i18n="Customer Details">Customer Details</div>
                                    </a>
                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                        <a href="app-ecommerce-customer-details-overview.html" class="menu-link">
                                            <div data-i18n="Overview">Overview</div>
                                        </a>
                                        </li>
                                        <li class="menu-item">
                                        <a href="app-ecommerce-customer-details-security.html" class="menu-link">
                                            <div data-i18n="Security">Security</div>
                                        </a>
                                        </li>
                                        <li class="menu-item">
                                        <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                            <div data-i18n="Address & Billing">Address & Billing</div>
                                        </a>
                                        </li>
                                        <li class="menu-item">
                                        <a href="app-ecommerce-customer-details-notifications.html" class="menu-link">
                                            <div data-i18n="Notifications">Notifications</div>
                                        </a>
                                        </li>
                                    </ul>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="app-ecommerce-manage-reviews.html" class="menu-link">
                                    <div data-i18n="Manage Reviews">Manage Reviews</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-ecommerce-referral.html" class="menu-link">
                                    <div data-i18n="Referrals">Referrals</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Settings">Settings</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                        <div data-i18n="Store details">Store details</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                        <div data-i18n="Payments">Payments</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                        <div data-i18n="Checkout">Checkout</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                        <div data-i18n="Shipping & Delivery">Shipping & Delivery</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                        <div data-i18n="Locations">Locations</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                        <div data-i18n="Notifications">Notifications</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-book"></i>
                                <div data-i18n="Academy">Academy</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="app-academy-dashboard.html" class="menu-link">
                                    <div data-i18n="Dashboard">Dashboard</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-academy-course.html" class="menu-link">
                                    <div data-i18n="My Course">My Course</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-academy-course-details.html" class="menu-link">
                                    <div data-i18n="Course Details">Course Details</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-truck"></i>
                                <div data-i18n="Logistics">Logistics</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="app-logistics-dashboard.html" class="menu-link">
                                    <div data-i18n="Dashboard">Dashboard</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-logistics-fleet.html" class="menu-link">
                                    <div data-i18n="Fleet">Fleet</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                                <div data-i18n="Invoice">Invoice</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="app-invoice-list.html" class="menu-link">
                                    <div data-i18n="List">List</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-invoice-preview.html" class="menu-link">
                                    <div data-i18n="Preview">Preview</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-invoice-edit.html" class="menu-link">
                                    <div data-i18n="Edit">Edit</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-invoice-add.html" class="menu-link">
                                    <div data-i18n="Add">Add</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-users"></i>
                                <div data-i18n="Users">Users</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="app-user-list.html" class="menu-link">
                                    <div data-i18n="List">List</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="View">View</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="app-user-view-account.html" class="menu-link">
                                        <div data-i18n="Account">Account</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-user-view-security.html" class="menu-link">
                                        <div data-i18n="Security">Security</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-user-view-billing.html" class="menu-link">
                                        <div data-i18n="Billing & Plans">Billing & Plans</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-user-view-notifications.html" class="menu-link">
                                        <div data-i18n="Notifications">Notifications</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="app-user-view-connections.html" class="menu-link">
                                        <div data-i18n="Connections">Connections</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Roles & Permissions">Roles & Permission</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="app-access-roles.html" class="menu-link">
                                    <div data-i18n="Roles">Roles</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="app-access-permission.html" class="menu-link">
                                    <div data-i18n="Permission">Permission</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                        </ul>
                        </li>

                        <!-- Pages -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-file"></i>

                            <div data-i18n="Pages">Pages</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-files"></i>
                                <div data-i18n="Front Pages">Front Pages</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Landing">Landing</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Pricing">Pricing</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Payment">Payment</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="../front-pages/checkout-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Checkout">Checkout</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="../front-pages/help-center-landing.html" class="menu-link" target="_blank">
                                    <div data-i18n="Help Center">Help Center</div>
                                </a>
                                </li>
                            </ul>
                            </li>

                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-user-circle"></i>
                                <div data-i18n="User Profile">User Profile</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="pages-profile-user.html" class="menu-link">
                                    <div data-i18n="Profile">Profile</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-profile-teams.html" class="menu-link">
                                    <div data-i18n="Teams">Teams</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-profile-projects.html" class="menu-link">
                                    <div data-i18n="Projects">Projects</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-profile-connections.html" class="menu-link">
                                    <div data-i18n="Connections">Connections</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Account Settings">Account Settings</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="pages-account-settings-account.html" class="menu-link">
                                    <div data-i18n="Account">Account</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-account-settings-security.html" class="menu-link">
                                    <div data-i18n="Security">Security</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-account-settings-billing.html" class="menu-link">
                                    <div data-i18n="Billing & Plans">Billing & Plans</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-account-settings-notifications.html" class="menu-link">
                                    <div data-i18n="Notifications">Notifications</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-account-settings-connections.html" class="menu-link">
                                    <div data-i18n="Connections">Connections</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="pages-faq.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-help"></i>
                                <div data-i18n="FAQ">FAQ</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="pages-pricing.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-diamond"></i>
                                <div data-i18n="Pricing">Pricing</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-3d-cube-sphere"></i>
                                <div data-i18n="Misc">Misc</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="pages-misc-error.html" class="menu-link" target="_blank">
                                    <div data-i18n="Error">Error</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-misc-under-maintenance.html" class="menu-link" target="_blank">
                                    <div data-i18n="Under Maintenance">Under Maintenance</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-misc-comingsoon.html" class="menu-link" target="_blank">
                                    <div data-i18n="Coming Soon">Coming Soon</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="pages-misc-not-authorized.html" class="menu-link" target="_blank">
                                    <div data-i18n="Not Authorized">Not Authorized</div>
                                </a>
                                </li>
                            </ul>
                            </li>

                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-lock"></i>
                                <div data-i18n="Authentications">Authentications</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Login">Login</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="auth-login-basic.html" class="menu-link" target="_blank">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-login-cover.html" class="menu-link" target="_blank">
                                        <div data-i18n="Cover">Cover</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Register">Register</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="auth-register-basic.html" class="menu-link" target="_blank">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-register-cover.html" class="menu-link" target="_blank">
                                        <div data-i18n="Cover">Cover</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-register-multisteps.html" class="menu-link" target="_blank">
                                        <div data-i18n="Multi-steps">Multi-steps</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Verify Email">Verify Email</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="auth-verify-email-basic.html" class="menu-link" target="_blank">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-verify-email-cover.html" class="menu-link" target="_blank">
                                        <div data-i18n="Cover">Cover</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Reset Password">Reset Password</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="auth-reset-password-basic.html" class="menu-link" target="_blank">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-reset-password-cover.html" class="menu-link" target="_blank">
                                        <div data-i18n="Cover">Cover</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Forgot Password">Forgot Password</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-forgot-password-cover.html" class="menu-link" target="_blank">
                                        <div data-i18n="Cover">Cover</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Two Steps">Two Steps</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="auth-two-steps-basic.html" class="menu-link" target="_blank">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="auth-two-steps-cover.html" class="menu-link" target="_blank">
                                        <div data-i18n="Cover">Cover</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-forms"></i>
                                <div data-i18n="Wizard Examples">Wizard Examples</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="wizard-ex-checkout.html" class="menu-link">
                                    <div data-i18n="Checkout">Checkout</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="wizard-ex-property-listing.html" class="menu-link">
                                    <div data-i18n="Property Listing">Property Listing</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="wizard-ex-create-deal.html" class="menu-link">
                                    <div data-i18n="Create Deal">Create Deal</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="modal-examples.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-square"></i>
                                <div data-i18n="Modal Examples">Modal Examples</div>
                            </a>
                            </li>
                        </ul>
                        </li>

                        <!-- Components -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-toggle-left"></i>
                            <div data-i18n="Components">Components</div>
                        </a>
                        <ul class="menu-sub">
                            <!-- Cards -->
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-id"></i>
                                <div data-i18n="Cards">Cards</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="cards-basic.html" class="menu-link">
                                    <div data-i18n="Basic">Basic</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="cards-advance.html" class="menu-link">
                                    <div data-i18n="Advance">Advance</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="cards-statistics.html" class="menu-link">
                                    <div data-i18n="Statistics">Statistics</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="cards-analytics.html" class="menu-link">
                                    <div data-i18n="Analytics">Analytics</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="cards-actions.html" class="menu-link">
                                    <div data-i18n="Actions">Actions</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <!-- User interface -->
                            <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-color-swatch"></i>
                                <div data-i18n="User interface">User interface</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="ui-accordion.html" class="menu-link">
                                    <div data-i18n="Accordion">Accordion</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-alerts.html" class="menu-link">
                                    <div data-i18n="Alerts">Alerts</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-badges.html" class="menu-link">
                                    <div data-i18n="Badges">Badges</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-buttons.html" class="menu-link">
                                    <div data-i18n="Buttons">Buttons</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-carousel.html" class="menu-link">
                                    <div data-i18n="Carousel">Carousel</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-collapse.html" class="menu-link">
                                    <div data-i18n="Collapse">Collapse</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-dropdowns.html" class="menu-link">
                                    <div data-i18n="Dropdowns">Dropdowns</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-footer.html" class="menu-link">
                                    <div data-i18n="Footer">Footer</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-list-groups.html" class="menu-link">
                                    <div data-i18n="List groups">List groups</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-modals.html" class="menu-link">
                                    <div data-i18n="Modals">Modals</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-navbar.html" class="menu-link">
                                    <div data-i18n="Navbar">Navbar</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-offcanvas.html" class="menu-link">
                                    <div data-i18n="Offcanvas">Offcanvas</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-pagination-breadcrumbs.html" class="menu-link">
                                    <div data-i18n="Pagination & Breadcrumbs">Pagination &amp; Breadcrumbs</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-progress.html" class="menu-link">
                                    <div data-i18n="Progress">Progress</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-spinners.html" class="menu-link">
                                    <div data-i18n="Spinners">Spinners</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-tabs-pills.html" class="menu-link">
                                    <div data-i18n="Tabs & Pills">Tabs &amp; Pills</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-toasts.html" class="menu-link">
                                    <div data-i18n="Toasts">Toasts</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-tooltips-popovers.html" class="menu-link">
                                    <div data-i18n="Tooltips & Popovers">Tooltips &amp; Popovers</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="ui-typography.html" class="menu-link">
                                    <div data-i18n="Typography">Typography</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <!-- Extended components -->
                            <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-components"></i>
                                <div data-i18n="Extended UI">Extended UI</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="extended-ui-avatar.html" class="menu-link">
                                    <div data-i18n="Avatar">Avatar</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-blockui.html" class="menu-link">
                                    <div data-i18n="BlockUI">BlockUI</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-drag-and-drop.html" class="menu-link">
                                    <div data-i18n="Drag & Drop">Drag &amp; Drop</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-media-player.html" class="menu-link">
                                    <div data-i18n="Media Player">Media Player</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                                    <div data-i18n="Perfect Scrollbar">Perfect Scrollbar</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-star-ratings.html" class="menu-link">
                                    <div data-i18n="Star Ratings">Star Ratings</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-sweetalert2.html" class="menu-link">
                                    <div data-i18n="SweetAlert2">SweetAlert2</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-text-divider.html" class="menu-link">
                                    <div data-i18n="Text Divider">Text Divider</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Timeline">Timeline</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a href="extended-ui-timeline-basic.html" class="menu-link">
                                        <div data-i18n="Basic">Basic</div>
                                    </a>
                                    </li>
                                    <li class="menu-item">
                                    <a href="extended-ui-timeline-fullscreen.html" class="menu-link">
                                        <div data-i18n="Fullscreen">Fullscreen</div>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-tour.html" class="menu-link">
                                    <div data-i18n="Tour">Tour</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-treeview.html" class="menu-link">
                                    <div data-i18n="Treeview">Treeview</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="extended-ui-misc.html" class="menu-link">
                                    <div data-i18n="Miscellaneous">Miscellaneous</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <!-- Icons -->
                            <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
                                <div data-i18n="Icons">Icons</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="icons-tabler.html" class="menu-link">
                                    <div data-i18n="Tabler">Tabler</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="icons-font-awesome.html" class="menu-link">
                                    <div data-i18n="Fontawesome">Fontawesome</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                        </ul>
                        </li>

                        <!-- Forms -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-forms"></i>
                            <div data-i18n="Forms">Forms</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-toggle-left"></i>
                                <div data-i18n="Form Elements">Form Elements</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="forms-basic-inputs.html" class="menu-link">
                                    <div data-i18n="Basic Inputs">Basic Inputs</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-input-groups.html" class="menu-link">
                                    <div data-i18n="Input groups">Input groups</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-custom-options.html" class="menu-link">
                                    <div data-i18n="Custom Options">Custom Options</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-editors.html" class="menu-link">
                                    <div data-i18n="Editors">Editors</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-file-upload.html" class="menu-link">
                                    <div data-i18n="File Upload">File Upload</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-pickers.html" class="menu-link">
                                    <div data-i18n="Pickers">Pickers</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-selects.html" class="menu-link">
                                    <div data-i18n="Select & Tags">Select &amp; Tags</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-sliders.html" class="menu-link">
                                    <div data-i18n="Sliders">Sliders</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-switches.html" class="menu-link">
                                    <div data-i18n="Switches">Switches</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="forms-extras.html" class="menu-link">
                                    <div data-i18n="Extras">Extras</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-layout-navbar"></i>
                                <div data-i18n="Form Layouts">Form Layouts</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="form-layouts-vertical.html" class="menu-link">
                                    <div data-i18n="Vertical Form">Vertical Form</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="form-layouts-horizontal.html" class="menu-link">
                                    <div data-i18n="Horizontal Form">Horizontal Form</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="form-layouts-sticky.html" class="menu-link">
                                    <div data-i18n="Sticky Actions">Sticky Actions</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-text-wrap-disabled"></i>
                                <div data-i18n="Form Wizard">Form Wizard</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="form-wizard-numbered.html" class="menu-link">
                                    <div data-i18n="Numbered">Numbered</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="form-wizard-icons.html" class="menu-link">
                                    <div data-i18n="Icons">Icons</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="form-validation.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-checkbox"></i>
                                <div data-i18n="Form Validation">Form Validation</div>
                            </a>
                            </li>
                        </ul>
                        </li>

                        <!-- Tables -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-layout-grid"></i>
                            <div data-i18n="Tables">Tables</div>
                        </a>
                        <ul class="menu-sub">
                            <!-- Tables -->
                            <li class="menu-item">
                            <a href="tables-basic.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-table"></i>
                                <div data-i18n="Tables">Tables</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-layout-grid"></i>
                                <div data-i18n="Datatables">Datatables</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="tables-datatables-basic.html" class="menu-link">
                                    <div data-i18n="Basic">Basic</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="tables-datatables-advanced.html" class="menu-link">
                                    <div data-i18n="Advanced">Advanced</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="tables-datatables-extensions.html" class="menu-link">
                                    <div data-i18n="Extensions">Extensions</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                        </ul>
                        </li>

                        <!-- Charts & Maps -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-chart-bar"></i>
                            <div data-i18n="Charts & Maps">Charts & Maps</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-chart-pie"></i>
                                <div data-i18n="Charts">Charts</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="charts-apex.html" class="menu-link">
                                    <div data-i18n="Apex Charts">Apex Charts</div>
                                </a>
                                </li>
                                <li class="menu-item">
                                <a href="charts-chartjs.html" class="menu-link">
                                    <div data-i18n="ChartJS">ChartJS</div>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="menu-item">
                            <a href="maps-leaflet.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-map"></i>
                                <div data-i18n="Leaflet Maps">Leaflet Maps</div>
                            </a>
                            </li>
                        </ul>
                        </li>

                        <!-- Misc -->
                        <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-box-multiple"></i>
                            <div data-i18n="Misc">Misc</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a href="https://pixinvent.ticksy.com/" target="_blank" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                                <div data-i18n="Support">Support</div>
                            </a>
                            </li>
                            <li class="menu-item">
                            <a
                                href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                target="_blank"
                                class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-description"></i>
                                <div data-i18n="Documentation">Documentation</div>
                            </a>
                            </li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </aside>
                <!-- / Menu -->

                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    {{ $slot }}
                </div>
                <!--/ Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                    <div
                        class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                        <div>
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-medium">Pixinvent</a>
                        </div>
                        <div class="d-none d-lg-inline-block">
                        <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                            >License</a
                        >
                        <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                            >More Themes</a
                        >

                        <a
                            href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                            target="_blank"
                            class="footer-link me-4"
                            >Documentation</a
                        >

                        <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                            >Support</a
                        >
                        </div>
                    </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

        <!--/ Layout wrapper -->

        <!-- Core JS -->
        <script src="/assets/vendor/js/core.js"></script>

        <!-- Vendors JS -->
        <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>
        <script src="/assets/vendor/libs/swiper/swiper.js"></script>
        <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

        <!-- Main JS -->
        <script src="/assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="/assets/js/dashboards-analytics.js"></script>

        @stack('scripts')
        @livewireScripts
    </body>
</html>
