<section class="navbar-fixed">    
    <nav class="orange darken-4">
        <div class="containerMedium">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s4 m2">
                        <a href="/" class="brand-logo left">Lingo</a>
                    </div>
                    <div class="col m6 hide-on-med-and-down">
                        <form action="{{route('liveSearch')}}" method="GET">
                            @csrf
                            <div class="col m8 input-field">
                                <input id="search" type="search" placeholder="Your search begins here..." class="searchNav" name="search" required>
                                <span><ul class="searchResults collection hidden searchDropdown"></ul></span>
                            </div>
                        </form>
                    </div>
                    <div class="col s6 m1">
                        <a href="#"><i class="material-icons right hide-on-large-only">notifications</i></a>
                    </div>
                    <div class="col s2 m3">
                        @guest
                            <a class='dropdown-trigger right hide-on-large-only' data-target='dropdownGuest'><i class="material-icons">menu</i></a>
                            <ul class="right hide-on-med-and-down">
                                <li><a class="modal-trigger" href="#modalLogin">Login</a></li>
                                <li><a class="modal-trigger" href="#modalSignup">Signup</a></li>  
                            </ul>
                        @else
                            <a class='dropdown-trigger right' data-target='dropdownUser'>
                                <img src="/uploads/profilepic/{{$user->profilepic}}" class="profilePicNav">
                            </a>
                            <h6 class="right welcome hide-on-med-and-down">Welcome, {{$user->name}}</h6>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <ul id="dropdownGuest" class="dropdown-content">
        <li><a class="modal-trigger" href="#modalLogin"><strong>Login</strong></a></li>
        <li><a class="modal-trigger" href="#modalSignup"><strong>Signup</strong></a></li>
    </ul>
    <ul id="dropdownUser" class="dropdown-content">
        <li><a href="/profile"><strong>My Profile</strong></a></li>
        <li><a href="/contacts"><strong>Contacts</strong></a></li>
        <li><a class="modal-trigger" href="#modalLogout"><strong>Logout</strong></a></li>
    </ul>

    <div id="modalLogin" class="modal">
        <div class="modal-content">   
            <h4 class="center">Login</h4>
            <div class="row">
                <div class="col s12">
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="name" placeholder="Username" value="{{Request::old('name')}}">
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <div class="input-field center-align">
                            <button type="submit" class="btn orange darken-2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div id="modalSignup" class="modal">
        <div class="modal-content">
           <h4 class="center">Signup</h4>
            <div class="row">
                <div class="col s12">
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="name" placeholder="Username" value="{{Request::old('name')}}" required>
                        </div>
                        <div class="input-field">
                            <input type="email" name="email" placeholder="Email" class="validate" value="{{Request::old('email')}}" required>
                            <span class="helper-text" data-error="Invalid Email" data-success="right"></span>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                        <div class="input-field center-align">
                            <button type="submit" class="btn orange darken-2">Signup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modalLogout" class="modal">
        <div class="modal-content">
            <h4 class="center">Leaving so soon?</h4>
            <p class="center">We're sad to see you go</p>
            <div class="row">
                <div class="col s6 m6">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <div class="input-field center-align">
                            <button type="submit" class="btn orange darken-2">Logout</button>
                        </div>
                    </form>
                </div>
                <div class="col s6 m6">
                    <div class="input-field center-align">
                        <a class="btn orange darken-2" href="/">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>