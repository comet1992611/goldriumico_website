@extends('front.layouts.master')
@section('content')
<div class="container">
			    <div class="row">
			        <div class="col-md-12 text-center">
			            <hr/>
			        </div>
			    </div>
			</div>
<section class="section-padding about-us-page">
         <div class="container">
             <div class="row">

                <div class="col-md-12 text-center">
                     <div class="contact-form">
                      <div class="row">
                          <div class="col-md-8 col-md-offset-2">

                                 <div class="contact-icon">
                                      <i class="fa fa-envelope-o"></i>
                                  </div>
                                  <h2 class="title">Send Your Masseage</h2>
                                  <form action="{{route('contact.mail')}}" method="POST" enctype="multipart/form-data">
                                  	{{csrf_field()}}
                                      <input type="text" class="name" name="name" placeholder="Name">
                                      <input type="email" class="email" name="email" placeholder="Email">
                                      <hr/>
                                      <textarea name="comment" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                      <div class="row">
                                          <div class="col-md-6 col-md-offset-3">
                                              <input class="btn-lg" type="submit" value="Send Message">
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>

             </div>
        </div>
</section>
@endsection
