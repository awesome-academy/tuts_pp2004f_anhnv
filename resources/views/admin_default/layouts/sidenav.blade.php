<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('_admin/img/user1-128x128.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Viet Anh</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="{{ url('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Post</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Post List</a></li>
                    <li><a href="{{ route('admin.posts.create') }}"><i class="fa fa-file-o"></i> New Post</a></li>
                    <li><a href="{{ route('admin.drafts.index') }}"><i class="fa fa-edit"></i> Drafts</a></li>
                    <li><a href="{{ route('admin.drafts.trashed')}}"><i class="fa fa-trash"></i> Trash</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-image"></i> <span>Media</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
        </ul>
    </section>
</aside>
