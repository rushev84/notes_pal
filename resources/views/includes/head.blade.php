<nav class="navbar bg-primary" data-bs-theme="dark" style="margin-bottom: 30px;">
    <div class="d-flex align-items-center" style="width: 100%;">
        <div style="flex-grow: 1; padding: 0 5px;"></div>
        <div style="display: flex; align-items: center; padding: 0 5px; color: white;">{{ Auth::user()->name }}</div>
        <div style="padding: 0 5px;">
            <a href="{{ route('login.logout') }}" class="btn btn-light" type="submit">Выйти</a>
        </div>
    </div>
</nav>
