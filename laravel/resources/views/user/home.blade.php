@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" v-cloak>
            <user-info></user-info>
        </div>
    </div>
</div>
@endsection

<style>
    [v-cloak] {
        display: none;
    }
</style>
