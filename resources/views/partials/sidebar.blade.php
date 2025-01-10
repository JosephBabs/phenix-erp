<div class="sidebar">
    
    <ul class="sidebar-menu mb-4">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span><i class="fas fa-home"></i></span> Tableau de bord
            </a>
        </li>
        <li>
            <a href="{{ route('employees') }}" class="{{ request()->routeIs('employees') ? 'active' : '' }}">
                <span><i class="fas fa-layer-group"></i></span> Employés
            </a>
        </li>
        <li>
            <a href="{{ route('bons-paiement') }}" class="{{ request()->routeIs('bons-paiement') ? 'active' : '' }}">
                <span><i class="fas fa-file-invoice-dollar"></i></span> Bons de paiement
            </a>
        </li>
        <li>
            <a href="{{ route('paiements') }}" class="{{ request()->routeIs('paiements') ? 'active' : '' }}">
                <span><i class="fas fa-credit-card"></i></span> Paiements
            </a>
        </li>
        <li>
            <a href="{{ route('notes') }}" class="{{ request()->routeIs('notes') ? 'active' : '' }}">
                <span><i class="fas fa-sticky-note"></i></span> Note
            </a>
        </li>
        <li>
            <a href="{{ route('circulaires') }}" class="{{ request()->routeIs('circulaires') ? 'active' : '' }}">
                <span><i class="fas fa-bullhorn"></i></span> Circulaires
            </a>
        </li>
        <li>
            <a href="{{ route('entretien') }}" class="{{ request()->routeIs('entretien') ? 'active' : '' }}">
                <span><i class="fas fa-tools"></i></span> Entretien
            </a>
        </li>
        <li>
            <a href="{{ route('ressources') }}" class="{{ request()->routeIs('ressources') ? 'active' : '' }}">
                <span><i class="fas fa-box"></i></span> Ressources
            </a>
        </li>
        <li>
            <a href="{{ route('budget-projet') }}" class="{{ request()->routeIs('budget-projet') ? 'active' : '' }}">
                <span><i class="fas fa-chart-line"></i></span> Budget de projet
            </a>
        </li>
        <li>
            <a href="{{ route('stocks-inventaires') }}" class="{{ request()->routeIs('stocks-inventaires') ? 'active' : '' }}">
                <span><i class="fas fa-warehouse"></i></span> Stocks et inventaires
            </a>
        </li>
        <li>
            <a href="{{ route('notifications') }}" class="{{ request()->routeIs('notifications') ? 'active' : '' }}">
                <span><i class="fas fa-bell"></i></span> Notifications
            </a>
        </li>
        <li>
            <a href="{{ route('produits') }}" class="{{ request()->routeIs('produits') ? 'active' : '' }}">
                <span><i class="fas fa-boxes"></i></span> Produits
            </a>
        </li>
        <li>
            <a href="{{ route('approvisionnement') }}" class="{{ request()->routeIs('approvisionnement') ? 'active' : '' }}">
                <span><i class="fas fa-truck-loading"></i></span> Approvisionnement
            </a>
        </li>
    </ul>
</div>
