@extends('layouts.main') 
@section('css') 
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/prism.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/whether-icon.css">
    <!-- Plugins css Ends-->
@endsection 
@section('body')
<div class="container-fluid general-widget">
    <div class="row">
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="database"></i></div>
              <div class="media-body"><span class="m-0">User</span>
                <h4 class="mb-0 counter">{{$user}}</h4><i class="icon-bg" data-feather="database"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-secondary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
              <div class="media-body"><span class="m-0">Buku</span>
                <h4 class="mb-0 counter">{{$book}}</h4><i class="icon-bg" data-feather="shopping-bag"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-4 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
              <div class="media-body"><span class="m-0">Peminjaman</span>
                <h4 class="mb-0 counter">{{$pinjam}}</h4><i class="icon-bg" data-feather="message-circle"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection 
@section('script') 
    <!-- Plugins JS start-->
    <script src="/assets/js/prism/prism.min.js"></script>
    <script src="/assets/js/clipboard/clipboard.min.js"></script>
    <script src="/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="/assets/js/counter/counter-custom.js"></script>
    <script src="/assets/js/custom-card/custom-card.js"></script>
    <script src="/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="/assets/js/general-widget.js"></script>
    <script src="/assets/js/height-equal.js"></script>
    <script src="/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    {{-- <script src="/assets/js/theme-customizer/customizer.js"></script>--}}
@endsection