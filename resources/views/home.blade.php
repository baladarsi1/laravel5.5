@extends('layouts.app')

@section('custom-css')

@stop

@section('content')

        <!-- template for the modal component -->
        <script type="text/x-template" id="modal-template">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-container">

                            <div class="modal-header">
                                <slot name="header">
                                    Rename Image
                                </slot>
                            </div>

                            <div class="modal-body">
                                <slot name="body">
                                    <ImageComponent></ImageComponent>
                                </slot>
                            </div>

                            <div class="modal-footer">
                                <slot name="footer">
                                    default footer
                                    <button class="modal-default-button" @click="$emit('close')">
                                    OK
                                    </button>
                                </slot>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </script>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                            <div class="col-md-6">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <router-link to="/foo" class="nav-link active">Go to Foo</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/bar" class="nav-link">Go to Bar</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/uploadImage" class="nav-link">upload Image</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/companiesIndex" class="nav-link">my Companies</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/imagesIndex" id="imageIndex" class="nav-link">my Images</router-link>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <router-view></router-view>
                            </div>

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
