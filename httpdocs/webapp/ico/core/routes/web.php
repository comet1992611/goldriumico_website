<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index')->name('index');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/register/{reference}', 'FrontController@register');
});

//Payment IPN
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::get('/ipnbtc', 'PaymentController@ipnbtc')->name('ipn.btc');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipncoin', 'PaymentController@ipncoin')->name('ipn.coinPay');
Route::post('/ipncoin-gate', 'PaymentController@coinGateIPN')->name('ipn.coinGate');
Route::get('/coin-gate', 'PaymentController@coingatePayment')->name('coinGate');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::get('/ipnblock', 'PaymentController@blockIpn')->name('ipn.block');
Route::get('/cron', 'PaymentController@cron');


//Subscribe
Route::get('/subscribe', 'FrontController@subscribe')->name('subscribe');
Route::get('/contact-email', 'FrontController@contactEmail')->name('contactEmail');

//Authorization
Route::get('/authorization', 'FrontController@authorization')->name('authorization');
Route::post('/sendemailver', 'FrontController@sendemailver')->name('sendemailver');
Route::post('/emailverify', 'FrontController@emailverify')->name('emailverify');
Route::post('/sendsmsver', 'FrontController@sendsmsver')->name('sendsmsver');
Route::post('/smsverify', 'FrontController@smsverify')->name('smsverify');
Route::post('/g2fa-verify', 'FrontController@verify2fa')->name('go2fa.verify');
Auth::routes();

//Forgot Password
Route::post('/forgot-pass', 'FrontController@forgotPass')->name('forgot.pass');
Route::get('/reset/{token}', 'FrontController@resetLink')->name('reset.passlink');
Route::post('/reset/password', 'FrontController@passwordReset')->name('reset.passw');


//User Routes
Route::group(['middleware' => ['auth']], function() {
Route::group(['prefix' => 'home'], function () {

Route::get('/', 'HomeController@index')->name('home');
Route::get('/referal', 'HomeController@referal')->name('referal');
Route::get('/my-coin', 'HomeController@myCoin')->name('myCoin');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile-update', 'ProfileController@update')->name('profile.update');

//Buy ICO
Route::get('/buy-ico', 'HomeController@buyIco')->name('buy.ico');
Route::post('/buy-preview', 'HomeController@buyPreview')->name('buy.preview');
Route::get('/buy-confirm', 'PaymentController@buyConfirm')->name('buy.confirm');

//Change Password
Route::get('/change-password', 'HomeController@changepass')->name('changepass');
Route::post('/change-passw', 'HomeController@chnpass')->name('changep');

//TwoFactor-Auth
Route::get('/g2fa', 'HomeController@google2fa')->name('go2fa');
Route::post('/g2fa-create', 'HomeController@create2fa')->name('go2fa.create');
Route::post('/g2fa-disable', 'HomeController@disable2fa')->name('disable.2fa');

});
});

Route::group(['prefix' => 'admin'], function () {

  // General Settings
  Route::get('/general', 'GeneralController@index')->name('general');
  Route::post('/general-update', 'GeneralController@update')->name('general.update');
  Route::get('/logo', 'GeneralController@logo')->name('logo');
  Route::post('/logo-update', 'GeneralController@logoupdate')->name('logo.update');
  Route::get('/change-password', 'GeneralController@changepass')->name('change.password');
  Route::post('/password-update', 'GeneralController@updatepass')->name('password.update');

  //Email Template
  Route::get('/template', 'EtemplateController@index')->name('template');
  Route::post('/template-update', 'EtemplateController@update')->name('template.update');

  //Sms Api
  Route::get('/sms-api', 'EtemplateController@smsApi')->name('sms.api');
  Route::post('/sms-update', 'EtemplateController@smsUpdate')->name('sms.update');

  //Sell Log
  Route::get('/sell-log', 'UsersController@sellLog')->name('sellLog');

 //ICO Claender
  Route::resource('ico', 'IcoController', ['except' => [
    'create', 'show','edit','destroy'
]]);

//Gateway
Route::resource('gateway', 'GatewayController', ['except' => [
    'create', 'show','edit'
]]);

//Roadmap
Route::resource('road', 'RoadController', ['except' => [
    'create', 'show','edit'
]]);

//Faq
Route::resource('faq', 'FaqController', ['except' => [
    'create', 'show','edit'
]]);

//Faq
Route::resource('testim', 'TestimController', ['except' => [
    'create', 'show','edit'
]]);

//Services
Route::resource('services', 'ServiceController', ['except' => [
    'create', 'show','edit'
]]);

//Team
Route::resource('teams', 'TeamController', ['except' => [
    'create', 'show','edit'
]]);

//Frontend Template
Route::get('/banner', 'FrontendController@banner')->name('banner');
Route::post('/banner-update', 'FrontendController@bannerUpdate')->name('banner.update');

Route::get('/about', 'FrontendController@about')->name('about');
Route::post('/about-update', 'FrontendController@aboutUpdate')->name('about.update');
Route::post('/service-update', 'FrontendController@serviceUpdate')->name('service.update');
Route::post('/roadmap-update', 'FrontendController@roadmapUpdate')->name('roadmap.update');
Route::post('/team-update', 'FrontendController@teamUpdate')->name('team.update');
Route::post('/testm-update', 'FrontendController@testmUpdate')->name('testm.update');
Route::post('/fqsec-update', 'FrontendController@fqsecUpdate')->name('fqsec.update');
Route::get('/subsc', 'FrontendController@subsc')->name('subsc');
Route::post('/subsc-update', 'FrontendController@subscUpdate')->name('subsc.update');
Route::get('/footer', 'FrontendController@footer')->name('footer');
Route::post('/footer-update', 'FrontendController@footerUpdate')->name('footer.update');

Route::get('/background', 'FrontendController@background')->name('background');
Route::post('/background-update', 'FrontendController@backgroundUpdate')->name('background.update');

//User Management
  Route::get('/users', 'UsersController@index')->name('users');;
  Route::post('/user-search', 'UsersController@userSearch')->name('search.users');
  Route::get('/user/{user}', 'UsersController@single')->name('user.single');
  Route::get('/user-banned', 'UsersController@banusers')->name('user.ban');

  Route::get('/mail/{user}', 'UsersController@email')->name('email');
  Route::post('/sendmail', 'UsersController@sendemail')->name('send.email');
  Route::put('/user/pass-change/{user}', 'UsersController@userPasschange')->name('user.passchange');
  Route::put('/user/status/{user}', 'UsersController@statupdate')->name('user.status');
  Route::get('/broadcast', 'UsersController@broadcast')->name('broadcast');
  Route::post('/broadcast/email', 'UsersController@broadcastemail')->name('broadcast.email');

  Route::get('/subscribers', 'UsersController@subscribers')->name('admin.subscribers');
  Route::post('/subscribers-email', 'UsersController@subsEmail')->name('subscribers.email');

  //Admin Auth
  Route::get('/', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

});
