Hello, you got a request about "{{ $type }}"
<br><br>

Account information:

Full Name: ({{$user->first_name}})<br>
ID#: {{$user->id}}<br>
Unit NO: {{$user->data->unit}}<br><br>

VILLA/APT. NO: {{ $villa_apt }}<br><br>


<h4>DAY, DATE AND TIME SERVICES ARE REQUIRED</h4><br>
day: {{$day}}
date: {{$date}}
time: {{$time}}

<h4>SERVICES REQUIRED</h4><br>

<strong>CLEANING SERVICES</strong>

@if(isset($cleaning) && is_array($cleaning))
@foreach($cleaning as $item)
{{ $item }}<br>
@endforeach
<br><br>
@endif

<strong>CARPET CLEANING</strong><br>

@if(isset($carpet) && is_array($carpet))
@foreach($carpet as $item)
{{ $item }}<br>
@endforeach
<br><br>
<br><br>
@endif

<strong>OTHER SERVICES</strong><br>
@if(isset($other) && is_array($other))
@foreach($other as $item)
{{ $item }}<br>
@endforeach
<br><br>
@endif

<strong>Permission is granted to enter my Villa/Unit on above mentioned date</strong><br>
{{ $permission }}<br>

<br><br>
Kind Regards
Alhamara email system