<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@welcome')->name('home');

Route::get('config', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:forget spatie.permission.cache');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check_block']], function () {
    Route::get('/home', 'HomeController@index')->name('admin.dashboard');
    Route::match(['get', 'post'], '/profile', 'HomeController@profile')->name('profile.manage');
    Route::group(['prefix' => 'advanced'], function () {
        Route::resource('settings', 'SettingController');
        Route::resource('custom-fields', 'CustomFieldController', ['names' => 'customFields']);
        Route::resource('file-types', 'FileTypeController', ['names' => 'fileTypes']);
    });
    Route::resource('users', 'UserController');
    Route::get('/users-block/{user}', 'UserController@blockUnblock')->name('users.blockUnblock');
    Route::resource('tags', 'TagController');

    Route::resource('documents', 'DocumentController');
    Route::post('document-verify/{id}', 'DocumentController@verify')->name('documents.verify');
    Route::post('document-store-permission/{id}', 'DocumentController@storePermission')->name('documents.store-permission');
    Route::post('document-delete-permission/{document_id}/{user_id}',
        'DocumentController@deletePermission')->name('documents.delete-permission');
    Route::group(['prefix' => '/files-upload', 'as' => 'documents.files.'], function () {
        Route::get('/{id}', 'DocumentController@showUploadFilesUi')->name('create');
        Route::post('/{id}', 'DocumentController@storeFiles')->name('store');
        Route::delete('/{id}', 'DocumentController@deleteFile')->name('destroy');
    });

    Route::get('/_files/{dir?}/{file?}', 'HomeController@showFile')->name('files.showfile');
    Route::get('/_zip/{id}/{dir?}', 'HomeController@downloadZip')->name('files.downloadZip');
    Route::post('/_pdf', 'HomeController@downloadPdf')->name('files.downloadPdf');

    // Route::resource('companies', 'CompanyController');
    Route::resource('tasks', 'TaskController');

    \Illuminate\Support\Facades\Route::group(['prefix' => '/organizations'], function () {
        \Illuminate\Support\Facades\Route::get('/index', 'OrganizationController@index')->name('organizations.index');
        \Illuminate\Support\Facades\Route::get('/assign/{id}', 'OrganizationController@assign')->name('organizations.assign');
        \Illuminate\Support\Facades\Route::post('/process/{id}', 'OrganizationController@process')->name('organizations.process');

        \Illuminate\Support\Facades\Route::group(['prefix' => '/corporations'], function () {
            \Illuminate\Support\Facades\Route::get('/add', 'CorporationController@add')->name('corporations.add');
            \Illuminate\Support\Facades\Route::post('/store', 'CorporationController@store')->name('corporations.store');
            \Illuminate\Support\Facades\Route::get('/view/{id}', 'CorporationController@view')->name('corporations.view');
            \Illuminate\Support\Facades\Route::get('/edit/{id}', 'CorporationController@edit')->name('corporations.edit');
            \Illuminate\Support\Facades\Route::post('/save/{id}', 'CorporationController@save')->name('corporations.save');
            \Illuminate\Support\Facades\Route::get('/delete/{id}', 'CorporationController@delete')->name('corporations.delete');
        });

        \Illuminate\Support\Facades\Route::group(['prefix' => '/companies'], function () {
            \Illuminate\Support\Facades\Route::get('/add', 'CompanyController@add')->name('companies.add');
            \Illuminate\Support\Facades\Route::post('/store', 'CompanyController@store')->name('companies.store');
            \Illuminate\Support\Facades\Route::get('/view/{id}', 'CompanyController@view')->name('companies.view');
            \Illuminate\Support\Facades\Route::get('/edit/{id}', 'CompanyController@edit')->name('companies.edit');
            \Illuminate\Support\Facades\Route::post('/save/{id}', 'CompanyController@save')->name('companies.save');
            \Illuminate\Support\Facades\Route::get('/delete/{id}', 'CompanyController@delete')->name('companies.delete');

            // FIXME:
            \Illuminate\Support\Facades\Route::get('/select/{id}', function (int $id) {
                session(['company_id' => $id]);

                return redirect()->route('organizations.index');
            })->name('companies.select');
        });

        \Illuminate\Support\Facades\Route::group(['prefix' => '/departments'], function () {
            \Illuminate\Support\Facades\Route::get('/add', 'DepartmentController@add')->name('departments.add');
            \Illuminate\Support\Facades\Route::post('/store', 'DepartmentController@store')->name('departments.store');
            \Illuminate\Support\Facades\Route::get('/view/{id}', 'DepartmentController@view')->name('departments.view');
            \Illuminate\Support\Facades\Route::get('/edit/{id}', 'DepartmentController@edit')->name('departments.edit');
            \Illuminate\Support\Facades\Route::post('/save/{id}', 'DepartmentController@save')->name('departments.save');
            \Illuminate\Support\Facades\Route::get('/delete/{id}', 'DepartmentController@delete')->name('departments.delete');
        });
    });
});
