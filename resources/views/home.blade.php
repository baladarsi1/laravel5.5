@extends('layouts.app')

@section('custom-css')

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div id="app">
                            <h1>Hello App!</h1>
                            <div class="col-md-2">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <router-link to="/imagesIndex" id="imageIndex" class="nav-link">my Images</router-link>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-10">
                                <router-view></router-view>
                            </div>

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
