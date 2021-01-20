@if(Session::has('message'))
    <p class="alert {{ Session::get('status') ? 'alert-success' : 'alert-danger' }} alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
{{ Session::get('message') }}</p>
@endif


