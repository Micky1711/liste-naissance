@if(Session::has('info'))
    <div class="alert alert-info">
        <div><span class="glyphicon glyphicon-info-sign"></span> {{ Session::get('info') }}</div>
    </div>
@endif
@if(Session::has('success'))
  <div class="alert alert-success">
        <div><span class="glyphicon glyphicon-ok-sign"></span> {{ Session::get('success') }}</div>
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning">
        <div><span class="glyphicon glyphicon-warning-sign"></span> {{ Session::get('warning') }}</div>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        <div><span class="glyphicon glyphicon-remove-sign"></span> {{Session::get('error') }}</div>
    </div>
@endif