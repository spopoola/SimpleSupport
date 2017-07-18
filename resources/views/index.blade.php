@extends('master')

@section('content')
    <section class="hero is-fullheight is-dark">
        <div class="hero-head">
            <div class="container">
                <nav class="nav top-nav">
                    <div class="container">
                        <div class="nav-left">
                            <a class="nav-item" href="../index.html">
                                <h1 class="title is-3">SimpleSupport</h1>
                            </a>
                        </div>
                        <span class="nav-toggle">
                          <span></span>
                          <span></span>
                          <span></span>
                        </span>
                        <div class="nav-right nav-menu">
                            <a class="nav-item">
                                About
                            </a>
                            <a class="nav-item">
                                FAQ
                            </a>
                            <a class="nav-item">
                                Contact
                            </a>
                            <a class="nav-item" href="{{ route('portal') }}">Login</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="columns is-vcentered">
                    <div class="column is-5">
                        <figure class="image is-4by3">
                            <img src="/images/support_user.jpg"
                                 class="promo-img" alt="Description">
                        </figure>
                    </div>
                    <div class="column is-6 is-offset-1">
                        <h1 class="title is-2">
                            A Simple Support Solution.
                        </h1>
                        <h2 class="subtitle is-4">
                            Specially created for small teams.
                        </h2>
                        <br>
                        <h2 class="subtitle is-2">
                            Beta Access coming soon!
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-foot">
            <div class="container">
                <div class="tabs is-centered">
                    <ul>
                        <li><a href="http://bulma.io">Simple Support</a></li>
                        <li><a>Copyright 2017 SimpleSupport</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@stop