@extends('emails/layouts/default')

{{-- Page content --}}
@section('content')

Full name: {{ $full_name }} <br>

Mobile Number: {{ $phone_number }} <br>

Country/Location: {{ $residence }} <br>

Occupation: {{ $career }} <br>

University/Company: {{ $company }}<br>

Subject: {{ $subject }}<br>

Message: {{ $messages }}<br>

@stop