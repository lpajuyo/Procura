@extends('errors::illustrated-layout')

@section('code', '497')
@section('title', __('Client Error'))

@section('image')
    <div style="background-image: url({{ asset('/svg/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __($exception->getMessage())) 
 {{-- ('Sorry, the page you are looking for could not be found.')) --}}
