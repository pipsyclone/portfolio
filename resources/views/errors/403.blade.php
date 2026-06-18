@extends('layouts.error')

@section('code', '403')
@section('icon', 'fas fa-lock')
@section('title', __('Access Forbidden'))
@section('message', __('You do not have permission to access this page. If you believe this is an error, please contact the administrator.'))
