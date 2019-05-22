@extends('errors::minimal')

@section('title', __(constLang('error_404')))
@section('code', '404')
@section('message', __(constLang('error_404')))
@section('redirect', __(constLang('back')))
