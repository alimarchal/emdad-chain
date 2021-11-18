@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
{{--@section('message', __($exception->getMessage() ?: 'Sorry you are forbidden to access this page.'))--}}
@section('message', 'This action is unauthorized or link has expired.' ?: 'Sorry you are forbidden to access this page.'))
