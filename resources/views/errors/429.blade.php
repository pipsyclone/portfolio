@extends('layouts.error')

@section('code', '429')
@section('icon', 'fas fa-gauge-high')
@section('title', __('Too Many Requests'))
@section('message', __('Whoa, slow down! You have made too many requests in a short period. Please wait a moment before trying again.'))
