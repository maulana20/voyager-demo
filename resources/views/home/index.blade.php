@extends('layouts.app')

@section('og-meta')
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ trans('home.website') }}" />
<meta property="og:description" content="Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:site_name" content="{{ trans('home.website') }}" />
<meta property="og:image" content="{{ asset('img/logo.svg') }}" />
<meta property="og:image:secure_url" content="{{ asset('img/logo.svg') }}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ trans('home.website') }}" />
<meta name="twitter:description" content="Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." />
<meta name="twitter:image" content="{{ asset('img/logo.svg') }}" />
@endsection

@section('load-styles')
@endsection

@section('content')
<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">        
            <a class="navbar-brand mr-auto js-scroll-trigger" href="{{ url('/') }}">
                <span class="text-white font-1-5-rem">{{ trans('home.website') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item px-2">
                        <a href="{{ url('#posts') }}" class="btn btn-white js-scroll-trigger">{{ trans('home.explore_post') }}</a>
                    </li>
                </ul>
            </div>
            <div style="color: white;">
                <span onclick="window.open('{{ url('?lang=id') }}', '_self')" {!! ($lang == 'id') ? 'style="font-weight: bold;"' : '' !!}>ID</span> | <span onclick="window.open('{{ url('?lang=en') }}', '_self')" {!! ($lang == 'en') ? 'style="font-weight: bold;"' : '' !!}>EN</span>
            </div>
        </div>
    </nav>
</header>
<main>
    <section id="home">
        <div class="box-head-mask"></div>
        <div class="bg-blue text-white pt-4 pb-1">
            <div class="box-head d-flex align-content-center">
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <div class="px-md-4 pt-5">
                                <h1 class="head-title font-weight-bold font-3-rem mb-4">{{ trans('home.website') }}</h1>
                                <p class="head-desc">{{ trans('home.head_desc') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 my-auto d-flex justify-content-center">
                            <div class="pt-md-5">
                                <img src="{{ asset('img/header-illustrator.png') }}" alt="This is the body for the latest post">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#about" class="box-scroll js-scroll-trigger">
                    <img src="{{ asset('img/mouse.png') }}" height="40" alt="Scroll">
                    <p>Scroll</p>
                </a>
            </div>
        </div>
        <div class="box-wave-head d-none d-sm-block"></div>
    </section>
    <section class="section-about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-auto d-flex justify-content-center">
                    <div class="box-img-out py-4">
                        <img src="{{ asset('img/about-illustrator.png') }}" alt="DSF Web Services" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 my-auto">
                    <div class="box-desc">
                        <p class="desc-sub font-16 mb-3">Who We Are</p>
                        <h2 class="desc-title mb-4">{{ trans('home.website') }}</h2>
                        <div class="box-dot">
                            <p class="text-ex">{{ trans('home.head_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" id="posts">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-5">
                    <h2 class="desc-title mb-4">
                        <b>{{ trans('home.my_posts') }}</b>
                    </h2>
                </div>
                <div class="col-md-7">
                    <div class="box-dot">
                        <p class="text-ex">
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-theme posts">
            @foreach ($posts as $index => $post)
            @php $post = $post->translate($lang); @endphp
                <div class="item">
                    <div class="item-inside">
                        <h5><b>{{ $post->title }}</b></h5>
                        <p>{{ $post->excerpt }}</p>
                        <p>
                        @foreach ($post->tags as $tag)
                            @php $query = [ 'lang' => $lang, 'tag' => $tag->name ]; @endphp
                            <span onclick="window.open('{{ url('?' . http_build_query($query)) }}', '_self')" style="color: blue; padding-right: 2px;">#{{ $tag->name }}</span>
                        @endforeach
                        </p>
                    </div>
                    <div class="item-image">
                        <img src="{{ $post->full_image }}" alt="cloud-computingx-dipo-star-dws">
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <section class="py-5" id="pages">
        <div class="container">
            <div class="card border-0 mb-5 bg-gray box-join-us">
                <div class="card-body box-join-us-body box-desc px-5">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <h2 class="desc-title mb-4">{{ trans('home.my_pages') }}</h2>
                        </div>
                        <div class="col-md-7">
                            <div class="box-dot">
                                <p class="text-ex">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    @foreach ($pages as $index => $page)
                    @php $page = $page->translate($lang); @endphp
                        <div class="col-lg-4 px-lg-5 mb-3">
                            <div class="box-image">
                                <img src="{{ $page->full_image }}" alt="dipo-star-join-us" class="img-fluid">
                            </div>
                            <h5 class="my-4"><b>{{ $page->title }}</b></h5>
                            <p>{{ $page->excerpt }}</p>
                            <p>
                            @foreach ($page->tags as $tag)
                                @php $query = [ 'lang' => $lang, 'tag' => $tag->name ]; @endphp
                                <span onclick="window.open('{{ url('?' . http_build_query($query)) }}', '_self')" style="color: blue; padding-right: 2px;">#{{ $tag->name }}</span>
                            @endforeach
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
<footer class="bg-blue text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="py-2 mb-2">
                    <img src="{{ asset('img/logo.svg') }}" class="mb-2" height="50" alt="Voyager Demo">
                    <p class="title-footer font-1-5-rem mb-0"><span class="font-weight-bold">{{ trans('home.website')}}</p>
                    <p>Voyager Demo</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="py-2">
                    <h6 class="font-weight-bold mb-4">Contact Us</h6>
                    <p>Head Office</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="py-2">
                    <h6 class="font-weight-bold mb-4">Links</h6>
                    <div class="row box-links">
                        <div class="col-md-7">
                            <ul class="list-unstyled">
                                <li><a href="#about" class="js-scroll-trigger">Who We Are</a></li>
                                <li><a href="#posts" class="js-scroll-trigger">{{ trans('home.my_posts') }}</a></li>
                                <li><a href="#pages" class="js-scroll-trigger">{{ trans('home.my_pages') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <ul class="list-unstyled">
                                <li><a href="#" target="_blank">Demo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection
