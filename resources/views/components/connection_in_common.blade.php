@if(!empty($commons))
@foreach($commons as $common)
<div class="my-2 shadow text-white bg-dark p-1">
<div class="d-flex justify-content-between">
<table class="ms-1">
<td class="align-middle">
<div class="p-2 shadow rounded mt-2  text-white bg-dark">{{$common->name}} - {{$common->email}}</div>
</td>
</table>
</div>
</div>
@endforeach
@endif
