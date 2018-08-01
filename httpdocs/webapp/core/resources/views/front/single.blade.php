@extends('front.layouts.master')
@section('content')
<section class="section-padding about-us-page">
         <div class="container">
             <div class="row">

                {!! $single->content !!}

             </div>
        </div>
</section>
@endsection