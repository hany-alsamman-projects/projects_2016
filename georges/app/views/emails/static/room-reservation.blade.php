Hello, you got a request about "{{ $type }}"
<br><br>

Account information:

Full Name: ({{$user->first_name}})<br>
ID#: {{$user->id}}<br>
Unit NO: {{$user->data->unit}}<br><br>

Host: {{$host}}<br>
Mobile: {{$mobile}}<br>
Function Date: {{$function_date}}<br>
Day: {{$day}}<br>
Starting: {{$starting}}<br>
Till: {{$till}}<br><br>

FUNCTION TYPE:<br>
<strong>{{$function_type}}</strong><br><br>


CATERER INFORMATION:<br>

@if(is_array($food_catering_company))

    @for($i = 0; $i < count($food_catering_company); ++$i)

        @if(!empty($food_catering_company[$i]))

        Food Catering Company: {{ $food_catering_company[$i] }}<br>
        Mobile Number: {{ $mobile_number[$i] }}<br>
        <br><br>
        @endif

    @endfor
@endif

SPECIAL REQUIREMENTS:<br>

Tables: {{$tables_num}}<br>
Chairs: {{$chairs_num}}<br>
Lamp stand: {{$lamp_num}}<br><br>

ADDITIONAL REQUIREMENTS:<br>
@if(is_array($special))
@foreach($special as $item)
    <strong>{{ $item }}</strong> <br>
@endforeach
<br><br>
@endif

MAINTENANCE Department:<br>
@if(isset($maintenance) && is_array($maintenance))
@foreach($maintenance as $item)
    <strong>{{ $item }}</strong> <br>
@endforeach
<br><br>
@endif
ATTENDEES INFORMATION:<br>

@if(is_array($first_name))

    @for($i = 0; $i < count($first_name); ++$i)

    @if(!empty($first_name[$i]))

    first name: {{ $first_name[$i] }}<br>
    family name: {{ $family_name[$i] }}<br>
    nationality: {{ $nationality[$i] }}
    <br><br>
    @endif

    @endfor
@endif

Residents: {{$residents}}<br>

Non Residents: {{$non_residents}} <br>

Total: {{$total}} <br>


<br><br>
Kind Regards
Alhamara email system