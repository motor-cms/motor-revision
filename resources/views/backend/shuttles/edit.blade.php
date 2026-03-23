@extends('motor-admin::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-admin::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('motor-revision::backend/shuttles.edit') }}
    {!! link_to_route('backend.shuttles.index', trans('motor-admin::backend/global.back'), [], ['class' => 'pull-right float-right btn btn-sm btn-danger']) !!}
@endsection

@section('main-content')
	@include('motor-admin::errors.list')
	@include('motor-revision::backend.shuttles.form')
@endsection
