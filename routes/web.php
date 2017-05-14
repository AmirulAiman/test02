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

Route::group(['middleware' => ['web']],function(){
    
    Route::get('/',[
        'uses' => 'MainController@Home',
        'as' => 'main.home'
    ]);
    
    Route::get('/company-list',[
        'uses' => 'MainController@CompanyList',
        'as' => 'main.lists'
    ]);

    Route::group(['prefix' => 'register'],function(){

        Route::get('/users',[
            'uses' => 'MainController@UserRegister',
            'as' => 'main.signup.user'
        ]);

        Route::post('/users/save',[
            'uses' => 'MainController@UserSignUp',
            'as' => 'main.save.user'
        ]);

        Route::get('/company',[
            'uses' => 'MainController@CompanyRegister',
            'as' => 'main.signup.company'
        ]);

        Route::post('/company/save',[
            'uses' => 'MainController@CompanySignUp',
            'as' => 'main.save.company'
        ]);

    });

    Route::group(['prefix' => 'admin'],function(){

        Route::get('/profile',[
            'uses' => 'AdminController@profile',
            'as' => 'admin.profile'
        ]);

        Route::get('/dashboard',[
            'uses' => 'AdminController@dashboard',
            'as' => 'admin.dashboard'
        ]);

        Route::get('/users',[
            'uses' => 'AdminController@users',
            'as' => 'admin.list.users'
        ]);

        Route::get('/company',[
            'uses' => 'AdminController@company',
            'as' => 'admin.list.company'
        ]);

        Route::get('/delete/{id}',[
            'uses' => 'AdminController@Delete',
            'as' => 'admin.delete'
        ]);

        Route::get('/edit/{id}',[
            'uses' => 'AdminController@edit',
            'as' => 'admin.edit'
        ]);
           
        
        Route::post('/edit/{id}',[
            'uses' => 'AdminController@save',
            'as' => 'admin.save'
        ]);
           

    });
    
    Route::group(['prefix' => 'users'],function(){

        Route::get('/dashboard',[
            'uses' => 'UserController@dashboard',
            'as' => 'user.dashboard'
        ]);

        Route::get('/dashboard/delete/{id}',[
            'uses' => 'UserController@delete_request',
            'as' => 'user.order.delete'
        ]);
        
        Route::get('/list',[
            'uses' => 'UserController@lists',
            'as' => 'user.list'
        ]);

        Route::get('/request/{id}',[
            'uses' => 'UserController@make',
            'as' => 'user.order'
        ]);

        Route::post('/request',[
            'uses' => 'UserController@record',
            'as' => 'user.order.record'
        ]);

        Route::get('/profile',[
            'uses' => 'UserController@profile',
            'as' => 'user.profile'
        ]);
                
        Route::get('/edit/{id}',[
            'uses' => 'UserController@edit',
            'as' => 'user.edit'
        ]);
                
        Route::post('/edit/save',[
            'uses' => 'UserController@save',
            'as' => 'user.edit.save'
        ]);

        Route::get('/record',[
            'uses' => 'UserController@history',
            'as' => 'user.history'
        ]);
        
    });
    
    Route::group(['prefix' => 'company'],function(){
        
        Route::get('/dashboard',[
            'uses' => 'CompanyController@dashboard',
            'as' => 'company.dashboard'
        ]);
        
        Route::get('/request',[
            'uses' => 'CompanyController@request',
            'as' => 'company.request.list'
        ]);
        Route::get('/accept/{i}/{r}',[
            'uses' => 'CompanyController@accept',
            'as' => 'company.accept'
        ]);

        Route::get('/payed/{id}',[
            'uses' =>'CompanyController@hasPayed',
            'as' => 'company.payed'
        ]);

        Route::get('/profil',[
            'uses' => 'CompanyController@profile',
            'as' => 'company.profile'
        ]);
        
        Route::get('/edit/{$id}',[
            'uses' => 'CompanyController@edit',
            'as' => 'company.edit'
        ]);
        
        Route::post('/edit/save',[
            'uses' => 'CompanyController@save',
            'as' => 'company.save'
        ]);
        
    });
    

    Route::get('/login',[
        'uses' => 'MainController@LoginPage',
        'as' => 'main.signin'
    ]);

    Route::post('/login',[
        'uses' => 'MainController@Login',
        'as' => 'main.login'
    ]);
    
    Route::get('/logout',[
        'uses' => 'MainController@Logout',
        'as' => 'main.logout'
    ]);
});
