<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"></a></li>
                    <!-- Induk Menu -->
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@if (Route::currentRouteName() == 'chat')
                            PRIVATE CHAT
                        @elseif (Route::currentRouteName() == 'group')
                        GROUP CHAT
                        @else
                        MENU
                        @endif</a>
                        <!-- Submenu -->
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{route('chat')}}">PRIVATE CHAT</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('group')}}">GROUP CHAT</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft-edit"></i></a>
                        <!-- Submenu -->
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{route('group.create')}}">New Group</a>
                            </li>
                        </ul>
                    </li>
                </ul>


                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <img id="avatar" class="image" alt="avatar"><i></i></span>
                            <span class="user-name"> {{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/profile">
                                <i class="ft-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i
                                    class="ft-power"></i> {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

     $(document).ready(function () {
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/profile-image",
            dataType: "json",
            success: function (response) {
                // console.log("halo");
                // console.log(response);

                if(response.image_path != null){
                    var imageUrl = 'storage/'+response.image_path;
                    $('#avatar').attr('src', imageUrl);
                }else{
                    var imageUrl = '/app-assets/images/profile-kosong.jpg'
                    $('#avatar').attr('src', imageUrl);
                }

            }
        });
    });
</script>
