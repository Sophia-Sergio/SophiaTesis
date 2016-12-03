@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{!!$error!!}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('message'))
    <div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
@endif

@if(Session::has('message_positivo'))
    <div class="alert alert-success alert-dismissible" role="alert" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message_positivo')}}
    </div>
@endif