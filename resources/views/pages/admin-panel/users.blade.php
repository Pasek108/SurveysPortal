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
    <x-admin-nav active_page="users" :notifications="$notifications" />
@endsection

@section('content')
    <h2 class="text-3xl font-bold">Users Management</h2>
@endsection
