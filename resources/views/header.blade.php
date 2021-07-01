<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>{{Session::get('page-title')}} | E-Mart.LK</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('css')}}/fontawesome.css">
    <link rel="stylesheet" href="{{asset('css')}}/templatemo-sixteen.css">
    <link rel="stylesheet" href="{{asset('css')}}/owl.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="" style="top:0">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href=""><h2>E-mart <em>.lk</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="@if(Session::get('page-title') == 'Home') ? nav-item active : nav-item @endif">
                <a class="nav-link" href="/">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="@if(Session::get('page-title') == 'Products') ? nav-item active : nav-item @endif">
                <a class="nav-link" href="/product">Our Products</a>
              </li>
              <li class="@if(Session::get('page-title') == 'About us') ? nav-item active : nav-item @endif">
                <a class="nav-link" href="">About Us</a>
              </li>
              <li class="@if(Session::get('page-title') == 'Contact us') ? nav-item active : nav-item @endif">
                <a class="nav-link" href="">Contact Us</a>
              </li>
              @if(Session::has('user-name'))
                <li class="@if(Session::get('page-title') == 'Logout') ? nav-item active : nav-item @endif">
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                </li>
                @if(session()->get('user-name') != 'Admin')
                  <li class="@if(Session::get('page-title') == 'Cart') ? nav-item active : nav-item @endif">
                      <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart" style="font-size:15px"></i><sup id="item-count" style="margin-left:5px;font-size:15px;color:#f33f3f"></sup></a>
                  </li>
                @else
                  <li class="@if(Session::get('page-title') == 'Admin') ? nav-item active : nav-item @endif">
                      <a class="nav-link" href="{{route('admin')}}">Admin</a>
                  </li>
                @endif
              @else
                <li class="@if(Session::get('page-title') == 'Login') ? nav-item active : nav-item @endif">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="@if(Session::get('page-title') == 'SignUp') ? nav-item active : nav-item @endif">
                    <a class="nav-link" href="{{route('signup')}}">Sign Up</a>
                </li>
                
              @endif
            </ul>
          </div>
        </div>
      </nav>
    </header>
