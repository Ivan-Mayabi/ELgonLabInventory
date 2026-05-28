@extends('layouts.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Specialities')

{{-- Page Heading --}}
@section('page-title', 'Specialities')

{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Specialities</li>
@endsection

{{-- Main Content --}}
@section('content')
    <x-room-component class="w-full h-auto"/>
@endsection
