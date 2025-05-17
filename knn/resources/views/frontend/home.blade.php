@extends('layouts.frontend')
    
@section('content')
@php
    $assets = asset('template/frontend/');
@endphp

    
@endsection

@push('js')
<script>
jQuery(document).ready(function($) {

    $('.owl-prev').text('<').css({
        width: '20px'
    });
    $('.owl-next').text('>').css({
        width: '20px'
    });
        
});    
</script>
@endpush


@push('modal')


@endpush