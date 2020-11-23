<?php

Route::get('/test', function(){
    return view('front.email.emailNewOrder');
});

Route::get('/clear-cache', function()
{
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('queue:restart');
    echo "cache cleard!";

});

Route::group([
    'prefix' => '{lang?}'
], function () {
    Route::group(['prefix' => 'back',], function () {
        Route::any('/upload', 'FileController@upload');
	    Route::any('/uploadPdf', 'FileController@uploadPdf');
	    Route::any('/deletePdf', 'FileController@deletePdf');
        Route::post('/destroyFile', 'FileController@destroyOneSingleImg');
        Route::post('/destroyFiles', 'FileController@destroyOneMultipleImg');
        Route::post('/activateFile', 'FileController@activateOneImg');
        Route::any('/upload-1c-file', 'OneCFileController@upload');
        Route::any('/uploadGalleryPhoto', 'FileController@uploadGalleryPhoto');

        Route::post('/hide-menu', 'Admin\DefaultController@hideMenuAjax');
        Route::post('/new-feedback', 'Admin\DefaultController@ajaxCountFeedback');

        Route::get('/', [ 'as' => 'login', 'uses' => 'Admin\DefaultController@index']);

        Route::get('/auth/login', [ 'as' => 'login', 'uses' => 'Auth\CustomAuthController@login']);
        Route::post('/auth/login', [ 'as' => 'login', 'uses' => 'Auth\CustomAuthController@checkLogin']);


        Route::get('/auth/register', 'Auth\CustomAuthController@register');
        Route::post('/auth/register', 'Auth\CustomAuthController@checkRegister');

        Route::get('/auth/logout', 'Auth\CustomAuthController@logout');

        Route::any('/{module}/{submenu?}/{action?}/{id?}/{lang_id?}',['uses' => 'RoleManager@routeResponder'] );
    });

    Route::group([], function() {
        Route::get('/', 'Front\DefaultController@index');

	    Route::post('/updateQuantity/goods', 'Front\CartController@updateQuantity');
	    Route::post('/cartElements/goods', 'Front\CartController@ajaxCart');
        Route::post('/diffSumItems/goods', 'Front\DefaultController@diffSumItemCart');
        Route::post('/destroyCartElements/goods', 'Front\DefaultController@destroyItemCart');

	    Route::any('/newOrder', 'Front\OrderController@NewOrder');

	    Route::post('/simpleFeedback/feedback', 'Front\DefaultController@simpleFeedbackAjax');
	    //Route::get('/simpleFeedback/feedback', 'Front\DefaultController@simpleFeedbackAjax');

        Route::get('/{parent}/{children?}/{item?}/{item2?}/{item3?}', 'Front\DefaultController@menuElements');
    });
});
