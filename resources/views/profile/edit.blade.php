<x-app-layout>
    <style>
        * {
            --primary: #07213C;
            --accent: #ECBF62;
            --light-bg: #F5F6F8;
            --white: #FFFFFF;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --border-color: #E5E7EB;
            --danger: #DC2626;
        }

        .profile-wrapper {
            background-color: var(--light-bg);
            min-height: 100vh;
            padding: 2rem;
        }

        .profile-main {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 2rem;
        }

        /* SIDEBAR */
        .profile-sidebar {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            height: fit-content;
            position: sticky;
            top: 2rem;
            box-shadow: 0 2px 8px rgba(7, 33, 60, 0.08);
        }

        .sidebar-user {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 4px 12px rgba(236, 191, 98, 0.3);
        }

        .user-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0 0 0.25rem 0;
        }

        .user-email {
            font-size: 0.85rem;
            color: var(--text-light);
            margin: 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background-color: var(--light-bg);
            color: var(--accent);
        }

        .sidebar-menu a.active {
            background-color: var(--primary);
            color: white;
        }

        .sidebar-icon {
            font-size: 1.3rem;
            min-width: 24px;
        }

        /* MAIN CONTENT */
        .profile-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(7, 33, 60, 0.08);
        }

        .content-header {
            padding: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .content-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0 0 0.5rem 0;
        }

        .content-header p {
            color: var(--text-light);
            margin: 0;
        }

        .content-body {
            padding: 2rem;
        }

        /* FORM SECTIONS */
        .form-section {
            margin-bottom: 2rem;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input,
        .form-input[type="text"],
        .form-input[type="email"],
        .form-input[type="password"] {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            color: var(--text-dark);
            transition: all 0.3s ease;
            font-family: inherit;
            background-color: #FAFAFA;
        }

        .form-input:focus,
        .form-input[type="text"]:focus,
        .form-input[type="email"]:focus,
        .form-input[type="password"]:focus {
            outline: none;
            border-color: var(--accent);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(236, 191, 98, 0.1);
        }

        .form-helper {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.25rem;
        }

        .form-error {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #051a2e;
            box-shadow: 0 4px 12px rgba(7, 33, 60, 0.2);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-secondary {
            background-color: var(--border-color);
            color: var(--primary);
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        .alert-info {
            background-color: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 1rem;
            border-radius: 8px;
            color: #92400E;
            margin-bottom: 1.5rem;
        }

        .alert-info a {
            color: #D97706;
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
        }

        .success-msg {
            color: #15803d;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-divider {
            border-top: 1px solid var(--border-color);
            margin: 2rem 0;
        }

        @media (max-width: 1024px) {
            .profile-main {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                position: relative;
                top: auto;
            }
        }

        @media (max-width: 768px) {
            .profile-wrapper {
                padding: 1rem;
            }

            .profile-sidebar {
                padding: 1.5rem;
            }

            .content-header,
            .content-body {
                padding: 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="profile-wrapper">
        <div class="profile-main">
            <!-- SIDEBAR -->
            <aside class="profile-sidebar">
                <div class="sidebar-user">
                    <div class="user-avatar">👤</div>
                    <h3 class="user-name">{{ Auth::user()->name }}</h3>
                    <p class="user-email">Ubah Profil</p>
                </div>

                <nav>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="#profile" class="active">
                                <span class="sidebar-icon">👤</span>
                                <span>Akun Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="#profile">
                                <span class="sidebar-icon">📋</span>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="#password">
                                <span class="sidebar-icon">🔐</span>
                                <span>Ubah Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="#delete">
                                <span class="sidebar-icon">⚠️</span>
                                <span>Hapus Akun</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="profile-content">
                <!-- Profile Header -->
                <div class="content-header" id="profile">
                    <h1>Profil Saya</h1>
                    <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                </div>

                <!-- Content Body -->
                <div class="content-body">
                    <!-- Profile Information Form -->
                    <div class="form-section">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="section-divider"></div>

                    <!-- Update Password Form -->
                    <div class="form-section" id="password">
                        <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--primary); margin-bottom: 1.5rem;">🔐 Ubah Password</h2>
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="section-divider"></div>

                    <!-- Delete Account Form -->
                    <div class="form-section" id="delete">
                        <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--danger); margin-bottom: 1.5rem;">⚠️ Hapus Akun</h2>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
