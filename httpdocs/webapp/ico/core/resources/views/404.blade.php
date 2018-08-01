@extends('layouts.app')

@section('content')
{{-- @php $front = \App\Frontend::first(); @endphp --}}
<section class="contact-section contact-bg" id="contact" style="background-image: url({{asset('assets/images/logo/bc.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="contact-form-wrapper text-center">
                	 <h3 style="color: #cc0000;">Sorry! Page Not Found</h3>
                	 <h4><a href="{{route('home')}}">Back To Home</a></h4>
               	</div>
            </div>
        </div>
    </div>
</section>
@endsection