Hello, you got a request about "{{ $type }}"
<br><br>

Account information:

Full Name: ({{$user->first_name}})<br>
ID#: {{$user->id}}<br>
Unit NO: {{$user->data->unit}}<br><br>

have read and understood the Extended Visit rules and would like to invite the following relatives for a short stay at AOVC<br><br>

from: {{ $date_from }}<br><br>

till: {{ $date_till }}<br><br>

@if(is_array($guest_full_name))

Information:<br><br>

    @for($i = 0; $i < count($guest_full_name); ++$i)

        @if(!empty($guest_full_name[$i]))

        Full Name: {{ $guest_full_name[$i] }}<br>
        Relation to resident: {{ $relation_to_resident[$i] }}<br>
        Age:  {{ $age[$i] }}<br><br>
        <br><br>
        @endif

    @endfor

@endif

Resident note:<br><br>

{{ $resident_note }}

<br><br>
Kind Regards
Alhamara email system