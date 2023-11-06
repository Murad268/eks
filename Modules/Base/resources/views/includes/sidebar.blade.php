<div class="sidebar">
    <ul>
        <li class="{{ request()->is('admin/categories*') ? 'active_route' : '' }}">
            <a href="{{ route('admin:categories.index') }}">Categories</a>
        </li>
        <li class="{{ request()->is('admin/blogs*') ? 'active_route' : '' }}">
            <a href="{{ route('admin:blogs.index') }}">Blogs</a>
        </li>


        <li class="">
            <a href="{{ route('admin.logout') }}">logout</a>
        </li>
    </ul>
</div>
