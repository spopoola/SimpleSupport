@extends('master')

@section('content')
    <app v-if="$auth.check()"></app>

    <login v-else></login>
@stop