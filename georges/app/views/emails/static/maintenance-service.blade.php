Hello, you got a request about "{{ $type }}"
<br><br>

Account information:

Full Name: ({{$user->first_name}})<br>
ID#: {{$user->id}}<br>
Unit NO: {{$user->data->unit}}


Function Date: {{ $function_date }}<br>
Location: {{ $location }} - time: {{ $time }}<br><br>


Description of Service(s) Required:<br>

@foreach($service as $item)

{{ $item }}

@endforeach

<br><br>

Permission is granted to enter my villa/unit if I am out:<br>
<strong>{{ $permission }}</strong><br><br>

@if($permission != 'yes')
I will be available on date {{ $available_date }} - time {{ $available_time }} <br>
@endif

<br><br>
Kind Regards
Alhamara email system