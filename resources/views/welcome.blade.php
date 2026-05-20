@extends('layouts.site')

@section('title', app(\App\Settings\GeneralSettings::class)->site_name . ' - ' . app(\App\Settings\GeneralSettings::class)->tagline)

@section('content')
    @include('site.partials.hero')
    @include('site.partials.features')
    @include('site.partials.products')
    @include('site.partials.testimonials')
    @include('site.partials.pricing')
    @include('site.partials.cta')
@endsection
