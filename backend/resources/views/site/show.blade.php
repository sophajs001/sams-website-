@extends('site.layout')

@section('content')
    {{-- Page content as edited from the CMS. For system pages, this holds the
         original markup pulled from the corresponding frontend HTML. --}}
    {!! $page->content !!}
@endsection
