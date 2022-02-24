<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active': '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active': '' }}" href="/dashboard/posts">
                    <span data-feather="file-text"></span>
                    All Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/comments*') ? 'active': '' }}" href="/dashboard/comments?status=active">
                    <span data-feather="message-circle"></span>
                    Comments
                </a>
            </li>
            <li class="nav-item">
                <hr class="border border-3 mx-3">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <span data-feather="navigation"></span>
                    Back to Blog
                </a>
            </li>
        </ul>
    </div>
</nav>