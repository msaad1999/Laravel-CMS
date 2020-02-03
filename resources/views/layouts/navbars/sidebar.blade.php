<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel CMS') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::user()->role->name == 'administrator')
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Actions
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usermanagement" aria-expanded="true" aria-controls="usermanagement">
                <i class="fas fa-fw fa-cog"></i>
                <span>User Management</span>
            </a>
            <div id="usermanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{ route('users.index') }}">View Users</a>
                <a class="collapse-item" href="{{ route('users.create') }}">Create User</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postmanagement" aria-expanded="true" aria-controls="postmanagement">
                <i class="fas fa-fw fa-cog"></i>
                <span>Post Management</span>
            </a>
            <div id="postmanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{ route('posts.index') }}">View Posts</a>
                <a class="collapse-item" href="{{ route('posts.create') }}">Create Post</a>
                <a class="collapse-item" href="{{ route('comments.index') }}">Manage Comments</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Categories</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mediamanagement" aria-expanded="true" aria-controls="mediamanagement">
                <i class="fas fa-fw fa-cog"></i>
                <span>Media Management</span>
            </a>
            <div id="mediamanagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{ route('media.index') }}">View Media</a>
                <a class="collapse-item" href="{{ route('media.create') }}">Upload Media</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    @endif

    <!-- Heading -->
    <div class="sidebar-heading">
      Content
    </div>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('posts.blog-home') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Blogs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
