@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="container">
            <div class="card-panel red-text errorFlash red lighten-4 ">
                {{$error}}
            </div>
        </div>
    @endforeach
@endif