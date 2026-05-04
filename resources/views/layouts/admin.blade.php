<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Apple Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --apple-blue: #0071e3;
            --apple-blue-dark: #0060c0;
            --apple-blue-light: #e8f1fd;
            --apple-gray-100: #f5f5f7;
            --apple-gray-200: #e8e8ed;
            --apple-gray-300: #d2d2d7;
            --apple-gray-500: #86868b;
            --apple-gray-700: #3a3a3c;
            --apple-black: #1d1d1f;
            --sidebar-w: 240px;
            --topbar-h: 56px;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Inter',system-ui,sans-serif;background:var(--apple-gray-100);color:var(--apple-black);user-select:none;-webkit-user-select:none}
        input,textarea,select{user-select:auto;-webkit-user-select:auto}

        /* TOP BAR */
        .adm-top{
            position:fixed;top:0;left:0;right:0;height:var(--topbar-h);
            background:rgba(255,255,255,0.85);
            backdrop-filter:saturate(180%) blur(20px);
            -webkit-backdrop-filter:saturate(180%) blur(20px);
            border-bottom:1px solid var(--apple-gray-200);
            display:flex;align-items:center;gap:0;z-index:1200;
        }
        .adm-top .brand{
            width:var(--sidebar-w);display:flex;align-items:center;gap:10px;
            padding:0 20px;font-size:17px;font-weight:700;color:var(--apple-black);
            letter-spacing:-0.3px;flex-shrink:0;
        }
        .adm-top .brand-icon{
            width:32px;height:32px;border-radius:8px;
            background:var(--apple-black);display:flex;align-items:center;justify-content:center;
        }
        .adm-top .brand-icon .material-icons-round{font-size:18px;color:#fff}
        .adm-top .top-right{margin-left:auto;display:flex;align-items:center;gap:4px;padding-right:20px}
        .adm-top .top-btn{
            display:flex;align-items:center;gap:6px;padding:6px 14px;border-radius:20px;
            font-size:13px;font-weight:500;color:var(--apple-gray-700);
            text-decoration:none;border:none;background:none;cursor:pointer;
            transition:background .15s;
        }
        .adm-top .top-btn:hover{background:var(--apple-gray-100);color:var(--apple-black)}
        .adm-top .top-btn .material-icons-round{font-size:17px}
        .adm-top .avatar{
            width:32px;height:32px;border-radius:50%;
            background:var(--apple-blue);color:#fff;
            font-size:13px;font-weight:700;display:flex;align-items:center;justify-content:center;
            cursor:pointer;margin-left:4px;
        }

        /* SIDEBAR */
        .adm-side{
            position:fixed;top:var(--topbar-h);left:0;bottom:0;
            width:var(--sidebar-w);background:#fff;
            border-right:1px solid var(--apple-gray-200);
            overflow-y:auto;overflow-x:hidden;z-index:1100;
            padding:12px 0 20px;
        }
        .side-section-title{
            padding:16px 16px 6px;font-size:11px;font-weight:600;
            letter-spacing:0.06em;text-transform:uppercase;color:var(--apple-gray-500);
        }
        .side-item{
            display:flex;align-items:center;gap:12px;
            margin:2px 10px;padding:10px 14px;border-radius:10px;
            font-size:14px;font-weight:500;color:var(--apple-gray-700);
            text-decoration:none;transition:all .15s;cursor:pointer;
        }
        .side-item .material-icons-round{font-size:19px;color:var(--apple-gray-500)}
        .side-item:hover{background:var(--apple-gray-100);color:var(--apple-black)}
        .side-item:hover .material-icons-round{color:var(--apple-black)}
        .side-item.active{background:var(--apple-blue-light);color:var(--apple-blue);font-weight:600}
        .side-item.active .material-icons-round{color:var(--apple-blue)}
        .side-divider{border:none;border-top:1px solid var(--apple-gray-200);margin:8px 16px}
        .side-badge{
            margin-left:auto;background:var(--apple-blue);color:#fff;
            border-radius:10px;padding:1px 8px;font-size:11px;font-weight:700;
        }

        /* MAIN */
        .adm-main{
            margin-left:var(--sidebar-w);margin-top:var(--topbar-h);
            padding:28px 32px 48px;min-height:calc(100vh - var(--topbar-h));
        }

        /* PAGE HEADER */
        .page-hdr{margin-bottom:24px}
        .page-hdr h1{font-size:26px;font-weight:700;color:var(--apple-black);letter-spacing:-0.5px;line-height:1.2}
        .page-hdr .breadcrumb{display:flex;align-items:center;gap:6px;margin-top:5px;font-size:13px;color:var(--apple-gray-500)}
        .page-hdr .breadcrumb a{color:var(--apple-blue);text-decoration:none}
        .page-hdr .breadcrumb a:hover{text-decoration:underline}

        /* UTILS */
        .swal2-container.swal2-top-end, .swal2-container.swal2-top-right {
            top: 60px !important;
        }

        /* CARDS */
        .adm-card{background:#fff;border-radius:14px;border:1px solid var(--apple-gray-200);overflow:hidden}
        .adm-card-body{padding:22px 24px}
        .adm-card-title{font-size:15px;font-weight:600;color:var(--apple-black)}

        /* STAT CARDS */
        .stat-card{
            background:#fff;border-radius:14px;border:1px solid var(--apple-gray-200);
            padding:22px 20px;display:flex;flex-direction:column;gap:4px;
            transition:box-shadow .2s,transform .2s;
        }
        .stat-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.08);transform:translateY(-1px)}
        .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:8px}
        .stat-icon .material-icons-round{font-size:22px}
        .stat-label{font-size:12px;font-weight:500;color:var(--apple-gray-500);letter-spacing:.01em}
        .stat-value{font-size:26px;font-weight:700;color:var(--apple-black);line-height:1.1;letter-spacing:-0.5px}
        .stat-meta{font-size:12px;color:var(--apple-gray-500);margin-top:4px;display:flex;align-items:center;gap:4px}
        .stat-meta .material-icons-round{font-size:14px}

        /* BUTTONS */
        .btn-apple{
            display:inline-flex;align-items:center;gap:7px;padding:0 18px;height:36px;
            border-radius:8px;font-family:'Inter',sans-serif;font-size:14px;font-weight:500;
            border:none;cursor:pointer;text-decoration:none;transition:all .15s;white-space:nowrap;
        }
        .btn-apple .material-icons-round{font-size:17px}
        .btn-filled{background:var(--apple-blue);color:#fff;box-shadow:0 2px 6px rgba(0,113,227,.35)}
        .btn-filled:hover{background:var(--apple-blue-dark);box-shadow:0 4px 12px rgba(0,113,227,.4);color:#fff}
        .btn-tonal{background:var(--apple-blue-light);color:var(--apple-blue)}
        .btn-tonal:hover{background:#d3e8ff;color:var(--apple-blue)}
        .btn-outlined{background:transparent;color:var(--apple-blue);border:1.5px solid var(--apple-blue)}
        .btn-outlined:hover{background:var(--apple-blue-light);color:var(--apple-blue)}
        .btn-ghost{background:transparent;color:var(--apple-gray-700);border:1.5px solid var(--apple-gray-300)}
        .btn-ghost:hover{background:var(--apple-gray-100);color:var(--apple-black)}
        .btn-danger{background:#ff3b30;color:#fff}
        .btn-danger:hover{background:#d70015;color:#fff}
        .btn-danger-light{background:#fff2f1;color:#ff3b30;border:1.5px solid #ffd5d3}
        .btn-danger-light:hover{background:#ffe5e3;color:#d70015}
        .btn-sm{height:30px;padding:0 14px;font-size:13px;border-radius:7px}

        /* TABLE */
        .adm-table{width:100%;border-collapse:collapse;font-size:14px}
        .adm-table thead tr{border-bottom:1.5px solid var(--apple-gray-200)}
        .adm-table thead th{
            padding:11px 16px;font-size:11.5px;font-weight:600;
            color:var(--apple-gray-500);text-transform:uppercase;letter-spacing:.05em;white-space:nowrap;
        }
        .adm-table tbody tr{border-bottom:1px solid var(--apple-gray-100);transition:background .12s}
        .adm-table tbody tr:hover{background:#fafafa}
        .adm-table tbody tr:last-child{border-bottom:none}
        .adm-table td{padding:13px 16px;vertical-align:middle}

        /* CHIPS */
        .chip{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500}
        .chip-pending{background:#fff4d9;color:#9a6700}
        .chip-paid{background:#d4edda;color:#155724}
        .chip-shipped{background:#cce5ff;color:#004085}
        .chip-completed{background:#f0f0f2;color:#3a3a3c}
        .chip-failed{background:#ffe0de;color:#c5221f}

        /* FLASH ALERTS */
        .flash-alert{
            display:flex;align-items:center;gap:10px;padding:13px 18px;
            border-radius:10px;font-size:14px;margin-bottom:20px;
        }
        .flash-alert .material-icons-round{font-size:20px}
        .flash-success{background:#d4edda;color:#155724;border:1px solid #c3e6cb}
        .flash-error{background:#ffe0de;color:#c5221f;border:1px solid #ffc9c6}

        /* STATUS SELECT */
        .status-select{
            border:1.5px solid var(--apple-gray-300)!important;border-radius:8px;
            font-size:12.5px;font-weight:500;height:30px;padding:0 26px 0 10px;cursor:pointer;
            appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='%2386868b'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat:no-repeat;background-position:right 8px center;
        }
        .status-select.status-pending{background-color:#fff4d9;color:#9a6700;border-color:#f0cc5a!important}
        .status-select.status-paid{background-color:#d4edda;color:#155724;border-color:#4caf50!important}
        .status-select.status-shipped{background-color:#cce5ff;color:#004085;border-color:#3d8bcd!important}
        .status-select.status-completed{background-color:#f0f0f2;color:#3a3a3c}
        .status-select.status-failed{background-color:#ffe0de;color:#c5221f;border-color:#f44336!important}

        /* FORM */
        .form-section{background:#fff;border-radius:14px;border:1px solid var(--apple-gray-200);margin-bottom:18px;overflow:hidden}
        .form-section-hdr{padding:16px 20px;border-bottom:1px solid var(--apple-gray-100);display:flex;align-items:center;gap:12px}
        .form-section-hdr .sec-icon{width:34px;height:34px;border-radius:8px;background:var(--apple-blue-light);display:flex;align-items:center;justify-content:center}
        .form-section-hdr .sec-icon .material-icons-round{font-size:17px;color:var(--apple-blue)}
        .form-section-hdr .sec-title{font-size:14px;font-weight:600;color:var(--apple-black)}
        .form-section-hdr .sec-desc{font-size:12px;color:var(--apple-gray-500);margin-top:2px}
        .form-section-body{padding:20px}

        .f-label{display:block;font-size:12px;font-weight:500;color:var(--apple-gray-500);margin-bottom:6px;letter-spacing:.02em}
        .f-label .req{color:#ff3b30}
        .f-input{
            width:100%;height:38px;padding:0 12px;font-size:14px;font-family:'Inter',sans-serif;
            color:var(--apple-black);background:#fafafa;
            border:1.5px solid var(--apple-gray-200);border-radius:8px;outline:none;transition:all .15s;
        }
        .f-input:focus{background:#fff;border-color:var(--apple-blue);box-shadow:0 0 0 3px rgba(0,113,227,.12)}
        .f-input.invalid{border-color:#ff3b30}
        .f-hint{font-size:11.5px;color:var(--apple-gray-500);margin-top:5px}
        .f-error{font-size:11.5px;color:#ff3b30;margin-top:5px;display:none}

        /* ACTION BAR */
        .adm-action-bar{
            display:flex;justify-content:flex-end;align-items:center;gap:10px;
            margin-top:20px;padding:14px 0;border-top:1px solid var(--apple-gray-200);
            position:sticky;bottom:0;background:rgba(245,245,247,.95);
            backdrop-filter:blur(10px);z-index:50;
        }

        /* OPTIONS TABLE */
        .opts-table-wrap{border:1.5px solid var(--apple-gray-200);border-radius:10px;overflow:hidden}
        .opts-table-wrap table{width:100%;border-collapse:collapse;font-size:13px}
        .opts-table-wrap thead th{background:var(--apple-gray-100);padding:10px 12px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--apple-gray-500);border-bottom:1.5px solid var(--apple-gray-200)}
        .opts-table-wrap tbody td{padding:9px 12px;border-bottom:1px solid var(--apple-gray-100);vertical-align:middle}
        .opts-table-wrap tbody tr:last-child td{border-bottom:none}
        .opts-table-wrap .form-control,.opts-table-wrap .form-select{border-radius:7px;border-color:var(--apple-gray-200);font-size:13px;background:#fafafa}
        .opts-table-wrap .form-control:focus,.opts-table-wrap .form-select:focus{border-color:var(--apple-blue);box-shadow:0 0 0 3px rgba(0,113,227,.1)}

        /* EMPTY STATE */
        .empty-state{padding:48px;text-align:center;color:var(--apple-gray-500)}
        .empty-state .material-icons-round{font-size:44px;opacity:.35;display:block;margin-bottom:10px}
        .empty-state p{font-size:14px}

        /* SCROLLBAR */
        .adm-side::-webkit-scrollbar{width:3px}
        .adm-side::-webkit-scrollbar-thumb{background:var(--apple-gray-200);border-radius:3px}

        /* PAGINATION */
        .pagination{display:flex;gap:3px;list-style:none;padding:0;margin:0}
        .page-item .page-link{
            display:flex;align-items:center;justify-content:center;
            width:34px;height:34px;border-radius:8px;border:none;
            color:var(--apple-gray-700);font-size:14px;font-weight:500;
            background:transparent;text-decoration:none;transition:background .12s;
        }
        .page-item .page-link:hover{background:var(--apple-gray-100);color:var(--apple-black)}
        .page-item.active .page-link{background:var(--apple-blue);color:#fff}
        .page-item.disabled .page-link{color:var(--apple-gray-300)}

        /* TABLES in stats */
        .adm-table thead th:first-child,.adm-table td:first-child{padding-left:20px}
        .adm-table thead th:last-child,.adm-table td:last-child{padding-right:20px}
    </style>
</head>
<body>
    <!-- TOP BAR -->
    <header class="adm-top">
        <div class="brand">
            <div class="brand-icon">
                <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.8562 10.8712C14.8398 8.16361 17.0645 6.84918 17.1654 6.78652C15.913 4.95461 13.9749 4.69463 13.292 4.67323C11.6664 4.50294 10.0917 5.63294 9.27092 5.63294C8.43577 5.63294 7.15197 4.70762 5.79979 4.73362C4.0191 4.75962 2.37894 5.77218 1.46747 7.35923C-0.373406 10.5516 1.00282 15.269 2.79374 17.8631C3.67667 19.1354 4.71708 20.5583 6.08272 20.5078C7.39121 20.4542 7.89209 19.6582 9.47124 19.6582C11.0361 19.6582 11.5034 20.5078 12.8797 20.4818C14.281 20.4542 15.176 19.1889 16.0388 17.9289C17.0315 16.4712 17.4429 15.0601 17.4647 14.9851C17.432 14.9729 14.8766 13.9892 14.8562 10.8712ZM12.3082 3.12581C13.0333 2.24765 13.523 1.03498 13.3897 0.166992C12.3394 0.209825 11.0706 0.869151 10.3168 1.74731C9.64197 2.52731 9.04334 3.75481 9.20141 4.59546C10.3694 4.68571 11.5645 3.99849 12.3082 3.12581Z" fill="white"/>
                </svg>
            </div>
            Apple Admin
        </div>
        <div class="top-right">
            <a href="{{ route('home') }}" target="_blank" class="top-btn">
                <span class="material-icons-round">open_in_new</span> Trang chủ
            </a>
            <div style="width:1px;height:20px;background:var(--apple-gray-200);margin:0 4px"></div>
            <a href="{{ route('logout') }}" class="top-btn" style="color:#ff3b30">
                <span class="material-icons-round">logout</span> Đăng xuất
            </a>
            <div class="avatar" title="{{ session('user_name', 'Admin') }}">
                {{ strtoupper(substr(session('user_name', 'A'), 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- SIDEBAR -->
    <nav class="adm-side">
        <div class="side-section-title">Tổng quan</div>
        <a href="{{ route('admin.dashboard') }}" class="side-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="material-icons-round">grid_view</span> Dashboard
        </a>
        <a href="{{ route('admin.orders') }}" class="side-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <span class="material-icons-round">receipt_long</span> Đơn hàng
        </a>
        <a href="{{ route('admin.applecare') }}" class="side-item {{ request()->routeIs('admin.applecare') ? 'active' : '' }}">
            <span class="material-icons-round">verified_user</span> AppleCare+
        </a>
        <a href="{{ route('admin.products') }}" class="side-item {{ request()->routeIs('admin.products') || request()->routeIs('add-product') || request()->routeIs('edit-product') ? 'active' : '' }}">
            <span class="material-icons-round">inventory_2</span> Sản phẩm
        </a>
        <hr class="side-divider">
        <div class="side-section-title">Báo cáo</div>
        <a href="{{ route('statistics') }}" class="side-item {{ request()->routeIs('statistics') ? 'active' : '' }}">
            <span class="material-icons-round">bar_chart</span> Thống kê doanh thu
        </a>
        <hr class="side-divider">
        <div class="side-section-title">Hệ thống</div>
        <a href="{{ route('home') }}" class="side-item">
            <span class="material-icons-round">language</span> Trang người dùng
        </a>
        <a href="{{ route('logout') }}" class="side-item" style="color:#ff3b30">
            <span class="material-icons-round" style="color:#ff3b30">logout</span> Đăng xuất
        </a>
    </nav>

    <!-- MAIN -->
    <main class="adm-main">
        @if(session('success'))
        <div class="flash-alert flash-success">
            <span class="material-icons-round">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-alert flash-error">
            <span class="material-icons-round">error</span>
            {{ session('error') }}
        </div>
        @endif
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
