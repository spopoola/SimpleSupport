@extends('layouts.admin')

@section('content')
    <app v-if="$auth.check()"></app>

    <login v-else></login>
@stop