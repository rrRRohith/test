@if (\Session::has('error'))
<x-alert class="alert-dismissible fade show" dismiss="true" type="danger" message="{{ \Session::get('error') }}" />
@elseif (\Session::has('success'))
<x-alert class="alert-dismissible fade show" dismiss="true" type="success" message="{{ \Session::get('success') }}" />
@endif