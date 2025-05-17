@extends('layouts.admin-master')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            @can('manage-data')
                111111111
            @endcan
        </div>
    </section>
@endsection
