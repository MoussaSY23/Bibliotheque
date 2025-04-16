<!-- resources/views/partials/sidebar.blade.php -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Mon Application</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Tableau de bord</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('commandes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Commandes</p>
                    </a>
                </li>
                <!-- Ajoute d'autres liens ici -->
            </ul>
        </nav>
    </div>
</aside>
