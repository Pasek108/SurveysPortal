@extends('layouts.admin-panel-layout')

@section('head')
    <x-head title="Admin dashboard" />
@endsection

@php
$notifications = [
    'messages' => 0,
    'reports' => 23,
    'contact' => 167,
];
@endphp

@section('admin-nav')
    <x-admin-nav active_page="surveys" :notifications="$notifications" />
@endsection

@section('content')
    <h2 class="text-3xl font-bold">Surveys Management</h2>
@endsection