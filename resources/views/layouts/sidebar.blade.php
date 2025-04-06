@auth
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users-cog"></i> <span>管理者管理</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/posts*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.posts.index') }}">
                <i class="fas fa-newspaper"></i> <span>投稿管理</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/category*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="fas fa-list"></i> <span>カテゴリー管理</span>
                </a>
            </li>
        </ul>
    </aside>
    <div class="mt-4 p-3 hide-sidebar-mini">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg btn-block">
            <i class="fas fa-sign-out-alt"></i> ログアウト
            </button>
        </form>
    </div>
</div>
@endauth