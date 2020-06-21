<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{Storage::disk('public')->url('profile/'.Auth::user()->image)}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            @auth
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                <div class="email">{{Auth::user()->email}}</div>
            @endauth
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="{{(Auth::user()->role->id == 1) ? route('admin.profile') : route('author.profile') }}">
                           <i class="material-icons">person</i>Profile
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            <i class="material-icons col-red">login</i>
                            <span>Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
             @if(Request::is('admin*'))
                <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/tag*') ? 'active' : ''}}">
                    <a href="{{route('admin.tag')}}">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/category*') ? 'active' : ''}}">
                    <a href="{{route('admin.category')}}">
                        <i class="material-icons">category</i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/post*') ? 'active' : ''}}">
                    <a href="{{route('admin.post')}}">
                        <i class="material-icons">post_add</i>
                        <span>Post</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/approval/post') ? 'active' : ''}}">
                    <a href="{{route('admin.post.approval')}}">
                        <i class="material-icons">hourglass_top</i>
                        <span>Pending Post</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/subscriber') ? 'active' : ''}}">
                    <a href="{{route('admin.subscriber')}}">
                        <i class="material-icons">subscriptions</i>
                        <span>Subscriber</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/favourite-post') ? 'active' : ''}}">
                    <a href="{{route('admin.favourite-post')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Post</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/comment') ? 'active' : ''}}">
                    <a href="{{route('admin.comment')}}">
                        <i class="material-icons">comment</i>
                        <span>Comment</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/author') ? 'active' : ''}}">
                    <a href="{{route('admin.author')}}">
                        <i class="material-icons">people</i>
                        <span>Authors</span>
                    </a>
                </li>

                <li class="header">LABELS</li>
                <li class="{{Request::is('admin/profile') ? 'active' : ''}}">
                    <a href="{{route('admin.profile')}}">
                        <i class="material-icons">settings</i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <i class="material-icons col-red">login</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
              @endif


            @if(Request::is('author*'))
                <li class="{{Request::is('author/dashboard') ? 'active' : ''}}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{Request::is('author/post*') ? 'active' : ''}}">
                    <a href="{{route('author.post')}}">
                        <i class="material-icons">post_add</i>
                        <span>Post</span>
                    </a>
                </li>

                <li class="{{Request::is('author/favourite-post') ? 'active' : ''}}">
                    <a href="{{route('author.favourite-post')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Post</span>
                    </a>
                </li>
                <li class="{{Request::is('author/comment') ? 'active' : ''}}">
                    <a href="{{route('author.comment')}}">
                        <i class="material-icons">comment</i>
                        <span>Comment</span>
                    </a>
                </li>

                <li class="header">LABELS</li>
                <li class="{{Request::is('author/profile') ? 'active' : ''}}">
                    <a href="{{route('author.profile')}}">
                        <i class="material-icons">settings</i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a  href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <i class="material-icons col-red">login</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            @endif

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design Developed By Newaz Sharif</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>