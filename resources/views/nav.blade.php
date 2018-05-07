<section class="navbar-fixed">    
    <nav class="orange darken-4">
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo left">Genuine</a>
                @guest
                    <a class='dropdown-trigger right hide-on-large-only' data-target='dropdownGuest'><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a class="modal-trigger" href="#modalLogin">Login</a></li>
                        <li><a class="modal-trigger" href="#modalSignup">Signup</a></li>  
                    </ul>
                @else
                    <a class='dropdown-trigger right' data-target='dropdownUser'>
                        <img src="/uploads/profilepic/{{Auth::user()->profilepic}}" class="profilePicNav">
                    </a>
                    <h6 class="right welcome">Welcome, {{Auth::user()->name}}</h6>
                @endguest
            </div>
        </div>
    </nav>
    <ul id="dropdownGuest" class="dropdown-content">
        <li><a class="modal-trigger" href="#modalLogin"><strong>Login</strong></a></li>
        <li><a class="modal-trigger" href="#modalSignup"><strong>Signup</strong></a></li>
    </ul>
    <ul id="dropdownUser" class="dropdown-content">
        <li><a href="{{route('profilePage', ['id' => 'Auth::user()->id'])}}"><strong>My Profile</strong></a></li>
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
                        <div class="input-field">
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
                        <div class="input-field">
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