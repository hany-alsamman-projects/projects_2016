@extends('emails/layouts/default')

@section('content')

Hello, {{ $user->first_name }}

I HAVE READ AND FULLY UNDERSTOOD, AND AGREE THAT I (AND FAMILY MEMBERS IF APPLICABLE) INTEND TO ABIDE BY THE ABOVE GUIDELINES,
POLICIES AND PROCEDURES OF AL-HAMRA OASIS VILLAGE COMPOUND IN
ORDER TO SUPPORT AND ENJOY THE COMPOUND LIFE STYLE.
THIS USER ID : #{{ $user->id }} has submit at {{ date("j, n, Y") }}
by the e-services system and he is signature as digital sign

@stop
