Hello, you got a request about "{{ $type }}"
<br><br>

Account information:

Full Name: ({{$user->first_name}})<br>
ID#: {{$user->id}}<br>
Unit NO: {{$user->data->unit}}


Villa/Apt: {{ $villa_apt }}<br><br>

Date & Time of Visit: {{ $date_time }}<br><br>


@if(is_array($name_of_guest) && sizeof($name_of_guest) > 1)

Name of Guest:<br>

@if(!empty($name_of_guest[0]))
First row :
Name of Guest: {{ $name_of_guest[0] }} - Age {{ $age_of_guest[0] }}<br><br>
@endif

@if(!empty($name_of_guest[1]))
Second row :
Name of Guest: {{ $name_of_guest[1] }} - Age {{ $age_of_guest[1] }}<br><br>
@endif

@else

Name of Guest: {{ $name_of_guest }} - Age {{ $age_of_guest }}<br><br>
@endif

<br><br>
Kind Regards
Alhamara email system