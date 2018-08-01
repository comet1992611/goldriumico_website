<?php
header ("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here

function checkhexcolor($color) {
	return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if( isset( $_GET[ 'color' ] ) AND $_GET[ 'color' ] != '' ) {
	$color = "#".$_GET[ 'color' ];
}

if( !$color OR !checkhexcolor( $color ) ) {
	$color = "#336699";
}

?>


.navbar-area ul li.active,
.boxed-btn,
.back-to-top,
.about-us .about-img .hover,
.road-map .road-map-wrapper .timeline .item .item-content .content,
.our-team-area .single-team-member .team-content,
.our-team-area .single-team-member .team_img .hover .social,
.testimonial-area .owl-dots div.active,
.blog-section .single-blog-post .thumb .hover,
.blog-section .single-blog-post .boxed-btn:hover,
.navbar-area ul li:hover a,
.contact-section .contact-form-wrapper input[type=submit],
.faq-section .accordion-wrapper .panel-title a,
.faq-section .accordion-wrapper .panel-title a:after,
.subscription-section .subscription-form button[type=submit],
.header-area .header-right-content #clockdiv > div,
.boxed-btn.white.animated-btn:after{
    background-color: <?php echo $color;?>;
}
/*border color*/
.header-area h1,
.road-map .road-map-wrapper .timeline .item .item-icon,
.testimonial-area .testimonial-carousel .single-testimonial-carousel .author-details .thumbnai img,
.testimonial-area .owl-dots div.active,
.contact-section .contact-form-wrapper input,
.contact-section .contact-form-wrapper textarea,
.subscription-section .subscription-form button[type=submit]{
  border-color: <?php echo $color;?>;
}
/*box shadow color*/
.about-us .about-img .hover{
  box-shadow: 0 0 5px <?php echo $color;?>;
}
/* color*/
.about-us .content h2 span,
.what-we-do .single-what-we-do:hover .content h4,
.section-title h2 span,
.contact-section .contact-form-wrapper h2 span,
.faq-section .accordion-wrapper .panel-title a.collapsed,
.faq-section .accordion-wrapper .panel-title a.collapsed:after,
.footer-section .social-links li a:hover,
.what-we-do .single-what-we-do:hover .icon{
  color: <?php echo $color;?>;
}
/*svg fill color*/
.what-we-do .single-what-we-do:hover .icon .svg{
  fill: <?php echo $color;?>;
}
/*border right color*/
.road-map .road-map-wrapper .timeline .row:nth-child(odd) .item .item-content .content:after{
  border-right-color: <?php echo $color;?>;
}
/*border left color*/
.road-map .road-map-wrapper .timeline .row:nth-child(even) .item .item-content .content:after,
.header-right-content{
  border-left-color: <?php echo $color;?> !important;
}
.road-map .road-map-wrapper .timeline .item .item-icon{
  box-shadow: 0px 0px 5px 5px <?php echo $color;?>;
}
/*border left color*/
.blog-section .single-blog-post .thumb img{
  border-bottom-color: <?php echo $color;?> !important;
}   
.back-to-top{
  display: none;
}
.header-right-content.full-border{
  border-color:<?php echo $color;?>;
}
.slicknav_nav a:hover, .slicknav_nav .slicknav_row:hover{
    background-color: <?php echo $color;?> !important;
}
.road-map-wrapper .timeline .row:nth-child(2n) .item .item-content .content:after{
	border-right: 10px solid <?php echo $color;?> !important;
}