@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="font-w700 mb-2">
                    Dash<span class="text-primary">mix</span> + Laravel <span class="text-danger">8</span>
                </h1>
                <h2 class="h4 font-w400 text-muted mb-4 invisible" data-toggle="appear" data-timeout="150">
                    Welcome to the starter kit! Build something amazing!
                </h2>
                <span class="m-2 d-inline-block invisible" data-toggle="appear" data-timeout="300">
                    <a class="btn btn-alt-primary px-4 py-3" href="/dashboard">
                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Enter Dashboard
                    </a>
                </span>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
