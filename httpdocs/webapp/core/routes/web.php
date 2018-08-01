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

Auth::routes();

Route::post('/login', 'Auth\LoginController@postLogin')->name('postLogin');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/refer/{reference}', 'FrontController@register');
});


Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/cron', 'FrontController@cron')->name('cron');
Route::post('/search', 'FrontController@search')->name('search');
Route::get('/subscribe', 'SubscribeController@store')->name('subscribe');
//Front Controller
Route::get('/', 'FrontController@index')->name('index');
Route::get('/page/{page}', 'FrontController@page')->name('page');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::post('/contact/mail', 'FrontController@conmail')->name('contact.mail');

Route::get('/unauthorized', 'FrontController@unauthorized')->name('unauthorized');
Route::post('/sendemailver', 'FrontController@sendemailver')->name('sendemailver');
Route::post('/emailverify', 'FrontController@emailverify')->name('emailverify');
Route::post('/sendsmsver', 'FrontController@sendsmsver')->name('sendsmsver');
Route::post('/smsverify', 'FrontController@smsverify')->name('smsverify');

//Forgot Password
Route::post('/forgot-pass', 'FrontController@forgotPass')->name('forgot.pass');
Route::get('/reset/{token}', 'FrontController@resetLink')->name('reset.passlink');
Route::post('/reset/password', 'FrontController@passwordReset')->name('reset.passw');



//User
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/convert', 'HomeController@convert')->name('convert');
Route::get('/user/profile', 'HomeController@userprofile')->name('user.profile');
Route::post('/user/update', 'HomeController@userupdate')->name('user.update');
Route::get('/home/refered', 'HomeController@refered')->name('refered.users');
Route::get('/home/transactions', 'HomeController@bittrans')->name('transactions');
Route::get('/home/bitlog', 'HomeController@bittrans')->name('bitlog');
Route::get('/home/coinlog', 'HomeController@cointrans')->name('coinlog');
Route::get('/change/password', 'HomeController@changepass')->name('changepass');
Route::post('/change/passw', 'HomeController@chnpass')->name('changep');
Route::post('/change/avatar', 'HomeController@cngavatar')->name('cngavatar');

//Update Package
Route::post('/update-package', 'HomeController@updatepackage')->name('updatepak');

// Verify Doccument
Route::get('/home/document', 'HomeController@document')->name('document');
Route::post('/home/doc-verify', 'HomeController@doc_verify')->name('doc.verify');

//Withdraw
Route::get('/home/withdraw', 'HomeController@withdraw')->name('withdraw');
Route::get('/home/withdraw/confirm','HomeController@wdconfirm')->name('withdraw.wdconfirm');

//Deposit
Route::get('/home/buy', 'HomeController@deposit')->name('deposit');
Route::post('/home/buy/preview', 'PaymentController@depconfirm')->name('deposit.confirm')->middleware('auth');


// Payment
Route::post('/ipncoin', 'PaymentController@ipncoin')->name('ipn.coinPay');

//User Withdraw
Route::post('/withdraw/req', 'WithdrawController@wdrequest')->name('withdraw.req');

//Money Transaction
Route::get('/request-money', 'UaccountController@requestMoney')->name('money.requests')->middleware('auth');
Route::post('/send-money', 'UaccountController@sendMoney')->name('send.money')->middleware('auth');
Route::post('/convert-money', 'UaccountController@convertMoney')->name('convert.money')->middleware('auth');

Route::get('/sell', 'UaccountController@sellcoin')->name('sell.coin')->middleware('auth');
Route::post('/sell/preview', 'UaccountController@sellview')->name('sell.view')->middleware('auth');
Route::post('/sell/now', 'UaccountController@sellconfirm')->name('sell.now')->middleware('auth');

//Google-Auth
Route::get('/home/g2fa', 'HomeController@google2fa')->name('go2fa');
Route::post('/home/g2fa/create', 'HomeController@create2fa')->name('go2fa.create');
Route::post('/home/g2fa/verify', 'FrontController@verify2fa')->name('go2fa.verify');
Route::post('/home/g2fa/disable', 'HomeController@disable2fa')->name('disable.2fa');




//Admin Routes
Route::group(['middleware' => ['auth:admin']], function() {
Route::prefix('admin')->group(
    function () {

    // Change Pass
    Route::get('/change/password', 'ChangepassController@changepass')->name('admin.changepass');
    Route::post('/change/passw', 'ChangepassController@chnpass')->name('admin.changep');

   //General Settings
    Route::get('/gsettings', 'GsettingController@index');
	Route::get('/gsettings/email', 'GsettingController@email');
	Route::get('/gsettings/sms', 'GsettingController@sms');
	Route::put('/gsettings/{gsetting}', 'GsettingController@update');
	Route::put('/gsettings/sms/{gsetting}', 'GsettingController@smsupdate');
	Route::put('/gsettings/email/{gsetting}', 'GsettingController@emailupdate');

	//Charges
	Route::get('/charges', 'ChargeController@index');
	Route::put('/charges/{charge}', 'ChargeController@update');

	//Gateway
    Route::get('/gateway', 'GatewayController@show');
	Route::post('/gateway/update', 'GatewayController@update');

	//Policy
    Route::get('/policy', 'PolicyController@show');
    Route::put('/policy/{policy}', 'PolicyController@update');

    //Menu
    Route::get('/menu', 'MenuController@index')->name('menu.index');
    Route::get('/menu/create', 'MenuController@create')->name('menu.create');
    Route::post('/menu', 'MenuController@store')->name('menu.store');
    Route::get('/menu/{menu}/edit', 'MenuController@edit')->name('menu.edit');
    Route::put('/menu/{menu}', 'MenuController@update')->name('menu.update');
    Route::get('/menu/{menu}/delete', 'MenuController@destroy')->name('menu.destroy');

    //Logo
    Route::get('/logo', 'LogoController@show')->name('logo');
    Route::put('/logo/{logo}', 'LogoController@update')->name('logo.update');

    //Slider
    Route::get('/slider', 'SliderController@index')->name('slider');
    Route::post('/slider/update', 'SliderController@update')->name('slider.update');

    //Logo
    Route::get('/footer', 'FooterController@show')->name('footer');
    Route::put('/footer/{footer}', 'FooterController@update')->name('footer.update');

    //Social
    Route::get('/social', 'SocialController@index')->name('social');
    Route::post('/social', 'SocialController@store')->name('social.store');
    Route::put('/social/{social}', 'SocialController@update')->name('social.update');
    Route::get('/social/{social}/delete', 'SocialController@destroy')->name('social.destroy');

     //Timeline
    Route::get('/timeline', 'TimelineController@index')->name('timeline');
    Route::get('/timeline/add', 'TimelineController@addnew')->name('timeline.add');
    Route::post('/timeline', 'TimelineController@store')->name('timeline.store');
    Route::get('/timeline/{timeline}/edit', 'TimelineController@edit')->name('timeline.edit');
    Route::put('/timeline/{timeline}', 'TimelineController@update')->name('timeline.update');
    Route::get('/timeline/{timeline}/delete', 'TimelineController@destroy')->name('timeline.destroy');

     //prices
    Route::get('/price', 'PriceController@index')->name('price');
    Route::post('/price', 'PriceController@store')->name('price.store');
    // Route::get('/price/{price}/delete', 'PriceController@destroy')->name('price.destroy');

    //Contact
    Route::get('/contac', 'ContacController@show')->name('contac');
    Route::put('/contac/{contac}', 'ContacController@update')->name('contac.update');

    //Statistics
    Route::get('/statistics', 'StatisticController@show')->name('statistics');
    Route::put('/statistics/{statistics}', 'StatisticController@update')->name('statistics.update');

    //About
    Route::get('/about', 'AboutController@show')->name('about');
    Route::put('/about/{about}', 'AboutController@update')->name('about.update');

    //Service
    Route::get('/service', 'ServiceController@show')->name('service');
    Route::post('/service/update', 'ServiceController@update')->name('service.update');

    //Payment Method
    Route::put('/payin/{payin}', 'PayintroController@update')->name('payin.update');
    Route::get('/paymethod', 'PaymethodController@index')->name('paymethod');
    Route::post('/paymethod', 'PaymethodController@store')->name('paymethod.store');
    Route::get('/paymethod/{paymethod}/delete', 'PaymethodController@destroy')->name('paymethod.destroy');

     //Testimonial
    Route::get('/testim', 'TestimonialController@index')->name('testim');
    Route::post('/testim', 'TestimonialController@store')->name('testim.store');
    Route::put('/testim/{testim}', 'TestimonialController@update')->name('testim.update');
    Route::get('/testim/{testim}/delete', 'TestimonialController@destroy')->name('testim.destroy');


    //Admin Wityhdraw Request
    Route::put('/withdraw/approve/{id}', 'WithdrawController@approve')->name('withdraw.approve');
    Route::put('/withdraw/refund/{id}', 'WithdrawController@refund')->name('withdraw.refund');
    Route::get('/withdraw/requests', 'WithdrawController@index')->name('withdraw.requests');
    Route::get('/withdraw/lists', 'WithdrawController@lists')->name('withdraw.lists');
    Route::get('/withdraw/refunded', 'WithdrawController@refundlog')->name('withdraw.refundlog');

    //User Management
    Route::get('/manage/users', 'UwdlogController@users')->name('withdraw.users');
    Route::get('/banned/users', 'UwdlogController@newusers')->name('new.users');
    Route::get('/manage/userlog', 'UwdlogController@userlog')->name('withdraw.userlog');
    Route::get('/manage/user/{user}', 'UwdlogController@single')->name('user.single');
    Route::put('/withdraw/approve/{id}', 'WithdrawController@approve')->name('withdraw.approve');
    Route::put('/user/balance/{user}', 'UwdlogController@blupdate')->name('user.balance');
    Route::put('/user/status/{user}', 'UwdlogController@statupdate')->name('user.status');
    Route::put('/user/package/{user}', 'UwdlogController@packageupdate')->name('user.package');
    Route::get('/mail/{user}', 'UwdlogController@email')->name('email');
    Route::post('/sendmail', 'UwdlogController@sendemail')->name('send.email');
    Route::get('/broadcast', 'UwdlogController@broadcast')->name('broadcast');
    Route::post('/broadcast/email', 'UwdlogController@broadcastemail')->name('broadcast.email');

    //Deposit
    Route::get('/deposits', 'DepositController@index')->name('deposits');
    Route::get('/deposits/requests', 'DepositController@requests')->name('deposits.requests');
    Route::put('/deposit/approve/{id}', 'DepositController@approve')->name('deposit.approve');
    Route::get('/deposit/{deposit}/delete', 'DepositController@destroy')->name('deposit.destroy');

    //Packages
    Route::get('/packages', 'PackageController@index')->name('package');
    Route::put('/packages/update', 'PackageController@update')->name('package.update');

    //Game
    Route::get('/game', 'GameController@index')->name('game');
    Route::get('/allgames', 'GameController@allgames')->name('allgames');
    Route::get('/allinvestors', 'GameController@allinvestors')->name('allinvestors');
    Route::get('/winners', 'GameController@winners')->name('winners');
    Route::post('/game', 'GameController@store')->name('game.store');
    Route::post('/game/update', 'GameController@update')->name('game.update');
    Route::post('/game/winner', 'GameController@winnerball')->name('game.winner');
    Route::get('/game/{game}/delete', 'GameController@destroy')->name('game.destroy');

    //dOCUMENT Verify
    Route::get('/document', 'DocverController@requests')->name('document.requests');
    Route::put('/document/approve/{user}', 'DocverController@approve')->name('document.approve');
    Route::put('/documnet/limit', 'TranlimitController@update')->name('tran.limit');
    
    });
});



Route::group(['prefix' => 'admin'], function () {
  Route::get('/', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

});
