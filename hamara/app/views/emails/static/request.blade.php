Hello, you got a request about "{{ $type }}"
<br><br>

inquery information:<br><br>


Name: {{ $Name }}<br><br>
Tel. Off: {{ $Tel_Off }}<br><br>
Address: {{ $Address }}<br><br>
E-mail: {{ $E_mail }}<br><br>
Nationality: {{ $Nationality }}<br><br>
Status: {{ $Status }}<br><br>

<strong>Sponsor/Company:</strong>
Name: {{ $SponsorName }}<br>
Tel: {{ $SponsorTel }}<br>
Type of Accommodation: {{ $Type_of }}<br><br>

@if(isset($Depname) && is_array($Depname) )

@if(!empty($Depname[$i]))
    @for($i = 0; $i < count($Depname); ++$i)

    Name: {{ $Depname[$i] }}<br>
    Spouse: {{ $Depspouse[$i] }}<br>
    Gender: {{ $gender[$i] }}<br>
    Age: {{ $age[$i] }}<br>
    School: {{ $school[$i] }}
    <br><br>
    @endfor
@endif

@endif

<br><br>
Kind Regards
Alhamara email system