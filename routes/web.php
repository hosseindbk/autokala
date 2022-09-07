<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin' , 'middleware' => ['auth:web' , 'checkAdmin'], 'prefix' => 'admin'],function (){
    Route::get('technicalunits/map/{id}'                    , 'TechnicalunitController@map')->name('technicalunits.address');
    Route::get('suppliers/map/{id}'                         , 'SupplierController@map')->name('suppliers.address');
    Route::patch('technicalunits/map'                       , 'TechnicalunitController@mapset')->name('mapset');
    Route::patch('suppliers/mapset'                         , 'SupplierController@mapset')->name('suppliermapset');
    Route::resource('panel'                               , 'PanelController');
    Route::resource('users'                               , 'UserController');
    Route::resource('slides'                              , 'SlideController');
    Route::resource('permissions'                         , 'PermissionController');
    Route::resource('roles'                               , 'RoleController');
    Route::resource('levelAdmins'                         , 'LevelManageController');
    Route::resource('profile'                             , 'ProfileController');
    Route::resource('menudashboards'                      , 'MenudashboardController');
    Route::resource('submenudashboards'                   , 'SubmenudashboardController');
    Route::resource('productbrandvarieties'               , 'ProductbrandvarietyController');
    Route::patch('productbrandvarieties/update/{id}'   , 'ProductbrandvarietyController@pupdate')->name('pupdate');
    Route::resource('siteusers'                           , 'SiteuserController');
    Route::resource('comments'                            , 'CommentController');
    Route::resource('commentrates'                        , 'CommentrateController');
    Route::resource('offers'                              , 'OfferController');
    Route::resource('sitemenus'                           , 'MenusiteController');
    Route::post('offers'                                    , 'OfferController@createcar')->name('caroffers-create');
    Route::post('offers/offerhomeshow'                      , 'OfferController@offerhomeshow')->name('offerhomeshow');
    Route::delete('offers/edit/{id}'                        , 'OfferController@deletecar')->name('caroffers-delete');
    Route::delete('siteusers/delete/{id}'                          , 'SiteuserController@deleteuser')->name('deleteuser');
    Route::post('offers/imgoffer1update/{id}'               , 'OfferController@imgoffer1update')->name('imgoffer1update');
    Route::post('offers/imgoffer2update/{id}'               , 'OfferController@imgoffer2update')->name('imgoffer2update');
    Route::post('offers/imgoffer3update/{id}'               , 'OfferController@imgoffer3update')->name('imgoffer3update');

    Route::resource('medias'                              , 'MediaController');
    Route::post('products/{id}/img'                         , 'MediaController@imgupload');
    Route::post('suppliers/{id}/img'                        , 'MediaController@imgupload');
    Route::post('technicalunits/{id}/img'                   , 'MediaController@imgupload');
    Route::post('productbrandvarieties/{id}/img'            , 'MediaController@imgupload');
    Route::post('productbrandvarieties/img1update/{id}'     , 'ProductbrandvarietyController@img1update')->name('img1update');
    Route::post('productbrandvarieties/img2update/{id}'     , 'ProductbrandvarietyController@img2update')->name('img2update');
    Route::post('productbrandvarieties/img3update/{id}'     , 'ProductbrandvarietyController@img3update')->name('img3update');

    Route::resource('technicalunits'                      , 'TechnicalunitController');
    Route::post('technicalunits/option'                     , 'TechnicalunitController@option')->name('option');
    Route::post('technicalunits/technicalhomeshow'          , 'TechnicalunitController@technicalhomeshow')->name('technicalhomeshow');
    Route::patch('technicalunits/updatetechimg/{id}'        , 'TechnicalunitController@updatetechimg')->name('updatetechimg');
    Route::patch('technicalunits/techkeyword/{id}'          , 'TechnicalunitController@techkeyword')->name('techkeyword');

    Route::resource('products'                            , 'ProductController');
    Route::get('product-brand-variety/{id}'                 , 'ProductbrandvarietyController@create')->name('product-brand-variety');
    Route::post('products/typeoption'                       , 'ProductController@typeoption')->name('typeoption');
    Route::post('products/modeloption'                      , 'ProductController@modeloption')->name('modeloption');
    Route::patch('products/updateproimg/{id}'               , 'ProductController@updateproimg')->name('updateproimg');


    Route::resource('suppliers'                           , 'SupplierController');
    Route::post('suppliers/option'                          , 'SupplierController@option')->name('option');
    Route::post('suppliers/supplierhomeshow'                , 'SupplierController@supplierhomeshow')->name('supplierhomeshow');
    Route::patch('suppliers/updatesupimg/{id}'              , 'SupplierController@updatesupimg')->name('updatesupimg');
    Route::patch('suppliers/supplierkeyword/{id}'           , 'SupplierController@supplierkeyword')->name('supplierkeyword');

    Route::resource('brands'                              , 'BrandController');
    Route::post('brands/brandhomeshow'                      , 'BrandController@brandhomeshow')->name('brandhomeshow');
    Route::patch('brands/updatebrandimg/{id}'               , 'BrandController@updatebrandimg')->name('updatebrandimg');

    Route::resource('representetivesuppliers'             , 'RepresentativesupplierController');
    Route::resource('cartypes'                            , 'CartypeController');
    Route::resource('carbrands'                           , 'CarbrandController');
    //Route::resource('carmodels'                     , 'CarController');
    Route::resource('representatives'                     , 'RepresentController');
    Route::resource('productgroups'                       , 'ProductgroupController');
    Route::patch('productgroups/{id}'                       ,   'ProductgroupController@productgroupedit')->name('productgroupedit');
    Route::resource('carproducts'                         , 'CarproductController');
    Route::resource('profiles'                            , 'ProfileController');
    Route::resource('cartechnichalgroups'                 , 'CartechnicalgroupController');
    Route::resource('supplierproductgroups'               , 'SupplierproductgroupController');

    Route::get('cars'                                       , 'CarController@index');
    Route::get('cars/carcreate'                             , 'CarController@carcreate')->name('carcreate');
    Route::get('cars/carbrand/{id}'                         , 'CarController@carbrandedit')->name('carbrandedit');
    Route::patch('cars/carbrand/{id}'                       , 'CarController@carbrandupdate')->name('carbrandupdate');
    Route::patch('cars/carmodel/{id}'                       , 'CarController@carmodelupdate')->name('carmodelupdate');

    Route::post('cars/create/storecarbrand'                 , 'CarController@storecarbrand')->name('storecarbrand');
    Route::delete('cars/create/destroycarbrand/{id}'        , 'CarController@destroycarbrand')->name('destroycarbrand');
    Route::post('cars/create/storecarmodel'                 , 'CarController@storecarmodel')->name('storecarmodel');
    Route::delete('cars/create/destroycarmodel/{id}'        , 'CarController@destroycarmodel')->name('destroycarmodel');
    Route::post('cars/create/storecartype'                  , 'CarController@storecartype')->name('storecartype');
    Route::delete('cars/create/destroycartype/{id}'         , 'CarController@destroycartype')->name('destroycartype');

    Route::post('slidetype'                                 , 'SlideController@slidetype')->name('slidetype');


});

Route::group(['namespace' => 'Site'] , function (){
    /*index*/
    Route::get('/'                          , 'IndexController@index')->name('/');
    Route::get('/'                          , 'IndexController@index')->name('indexfilter');
    Route::get('/company/{slug}'            , 'IndexController@company')->name('company');
    Route::get('/filterstate'               , 'IndexController@indexstate')->name('filterstate');
    /*market*/
    Route::get('market/sell'                , 'MarketController@sell')->name('sell');
    Route::get('market/buy'                 , 'MarketController@buy')->name('buy');
    Route::get('market/sell/filter'         , 'MarketController@sellfilter')->name('market-sell-filter');
    Route::get('market/buy/filter'          , 'MarketController@buyfilter')->name('market-buy-filter');
    Route::post('market/option'             , 'MarketController@option')->name('marketoption');
    Route::get('market/{slug}'              , 'MarketController@submarket');
    Route::get('market/sell/state'          , 'MarketController@sellstate')->name('sellfilterstate');
    Route::get('market/buy/state'           , 'MarketController@buystate')->name('buyfilterstate');
    Route::get('market'                     , 'MarketController@index' );
    /*product*/
    Route::get('product'                    , 'ProductController@index' );
    Route::get('product'                    , 'ProductController@index')->name('productsearchandfilter');
    Route::post('product/modeloption'       , 'ProductController@modeloption')->name('modeloption');
    Route::get('product/{slug}'             , 'ProductController@subproduct' );
    Route::get('productbrand/{slug}/{id}'   , 'ProductController@productbrand' );
    /*brand*/
    Route::get('brand'                      , 'BrandController@index' );
    Route::get('brand'                      , 'BrandController@index')->name('brandsearchandfilter');
    Route::get('brand/{slug}'               , 'BrandController@subbrand' );

    /*technical*/
    Route::get('technical'                  , 'TechnicalunitController@index' );
    Route::get('technical'                  , 'TechnicalunitController@index')->name('technicalsearchandfilter');
    Route::get('technical/sub/{slug}'       , 'TechnicalunitController@subtechnical' )->name('subtechnical');
    Route::get('technical/filterstate'      , 'TechnicalunitController@filterstate')->name('technicalfilterstate');
    Route::patch('technical/updatetechimg/{id}', 'TechnicalunitController@updatetechimg')->name('updatetechimg');

    /*supplier*/
    Route::get('supplier'                   , 'SupplierController@index' );
    Route::get('supplier'                   , 'SupplierController@index')->name('suppliersearchandfilter');
    Route::get('supplier/sub/{slug}'        , 'SupplierController@subsupplier' );
    Route::get('supplier/state'             , 'SupplierController@indexstate')->name('supplierfilterstate');
    Route::patch('suppliers/updatesupimg/{id}', 'SupplierController@updatesupimg')->name('updatesupimg');

    /*search-filter*/
    Route::post('state'                     , 'StateController@state')->name('state');
    Route::get('offersearch'                , 'SearchController@offersearch')->name('offersearch');
    Route::get('unicode'                    , 'UnicodeController@unicode')->name('unicode');
    /*commant*/
    Route::post('comment'                   , 'ProductController@comment')->name('send-comment');
    Route::post('comment-rate'              , 'ProductController@commentrate')->name('comment-rate');
    /*contact*/
    Route::get('contact'                    , 'ContactusController@index' );
    Route::get('help'                       , 'HelpController@index' );
});

Route::group(['middleware' => ['web' ,'checkUser'] , 'namespace' => 'Site'] , function(){
    Route::get('brand-create'                   , 'BrandController@brandindex')->name('brand-create');
    Route::post('brand-create'                  , 'BrandController@brandcreate')->name('brand-create');
    Route::get('brand-create/edit/{id}'         , 'BrandController@brandedit')->name('brand-edit');
    Route::patch('brand-create/edit/{id}'       , 'BrandController@brandupdate')->name('brand-update');
    Route::delete('brand-create/{id}'           , 'BrandController@branddelete')->name('brand-delete');
    //Route::get('profile-technical-unit'         , 'ProfiletechnicalunitController@index' )->name('profiletechnicaledit');
    Route::get('profiletechnicalunitedit/{id}'    , 'ProfiletechnicalunitController@profiletechnicaledit' )->name('protechnicaledit');
    Route::post('profiletechnicalstore'         , 'ProfilebusinessController@storetechnical' )->name('profiletechnicalstore');
    Route::patch('profiletechnicaledit/{id}'    , 'ProfilebusinessController@updatetechnical' )->name('profiletechnicaledit');
    Route::post('profilesupplierstore'          , 'ProfilebusinessController@storesupplier' )->name('profilesupplierstore');
    Route::post('profilecartechnical'           , 'ProfilebusinessController@cartechnicalstore' )->name('cartechnicalstore');
    Route::post('profilecarsupplier'            , 'ProfilebusinessController@carsupplierstore' )->name('carsupplierstore');
    Route::delete('profilecarsupplier/{id}'     , 'ProfilebusinessController@carsuppliergroupdelete' )->name('carsuppliergroupdelete');
    Route::delete('profilecartechnical/{id}'    , 'ProfilebusinessController@cartechnicaldelete' )->name('cartechnicaldelete');
    Route::patch('profilesupplieredit/{id}'     , 'ProfilebusinessController@updatesupplier' )->name('profilesupplieredit');
    Route::get('profile-info'                   , 'ProfilebusinessController@profileinfo' )->name('profile-info');
    Route::get('profile-supplier-create'        , 'ProfilesupplierController@suppliercreate' )->name('supplier-business');
    Route::get('profile-technicalunit-create'   , 'ProfiletechnicalunitController@technicalcreate' )->name('technicalunit-business');
    Route::get('brand-variety/{id}'             , 'ProfilebrandvarityController@index' )->name('brand-variety');
    Route::post('brand-variety'                 , 'ProfilebrandvarityController@store' )->name('brand-variety-create');
    Route::get('profile-supplier'               , 'ProfilesupplierController@index' )->name('profilesupplieredit');
    Route::get('profile-supplier/{id}'          , 'ProfilesupplierController@prosupplieredit' )->name('prosupplieredit');
    Route::get('profile-technical-unit'         , 'ProfiletechnicalunitController@index' );
    Route::get('profile-user'                   , 'ProfileuserController@index' );
    Route::patch('profile-user/usermap'         , 'ProfileuserController@usermapset')->name('usermap');
    Route::patch('profile-business/suppliermap' , 'ProfilebusinessController@suppliermap')->name('suppliermap');
    Route::patch('profile-business/technicalmap', 'ProfilebusinessController@technicalunitmap')->name('technicalunitmap');
    Route::get('profile-business'               , 'ProfilebusinessController@index' )->name('profile-business');
    Route::get('profile-business/setmapsupplier/{id}'   , 'ProfilebusinessController@setmapsupplier' )->name('setmapsupplier');
    Route::get('profile-business/setmaptechnical/{id}'   , 'ProfilebusinessController@setmaptechnical' )->name('setmaptechnical');
    Route::post('profile-user/option'           , 'ProfileuserController@option')->name('option');
    Route::post('profile-business/option'       , 'ProfilebusinessController@option')->name('option');
    Route::patch('profile-user/{id}'            , 'ProfileuserController@update' )->name('profile_user_update');
    Route::get('profile-user/setmapuser/{id}'   , 'ProfileuserController@setmapuser' )->name('setmapuser');
    Route::get('profile-supplier'               , 'ProfilesupplierController@index' );
    Route::post('img'                           , 'ProfilebusinessController@imgupload')->name('img');
    Route::get('offer-product/{id}/{slug}'      , 'OfferController@offerproductvarity');
    Route::get('offer-product/{id}'             , 'OfferController@offerproduct')->name('offer-product');
    Route::post('offer-create'                  , 'OfferController@offercreate')->name('offer-create');
    Route::post('caroffercreate'                , 'OfferController@caroffercreate')->name('carofferstore');
    Route::get('offer/edit/{id}'                , 'OfferController@offeredit')->name('offer-edit');
    Route::patch('offer/edit/{id}'              , 'OfferController@update')->name('offer-update');
    Route::delete('offer/{id}'                  , 'OfferController@offerdelete')->name('offer-delete');
    Route::delete('caroffer/{id}'               , 'OfferController@carofferdelete')->name('carofferdelete');
    Route::get('offer'                          , 'OfferController@index')->name('offer');
    Route::patch('offer'                        , 'OfferController@offermap')->name('offermap');
    Route::post('offer/titleproduct'            , 'OfferController@titleproduct')->name('titleproduct');
    Route::get('setpass'                        , 'SetpassController@index')->name('setpass');
    Route::post('setpass'                       , 'SetpassController@update')->name('setpass');
    Route::get('setphone'                       , 'SetpassController@setphoneshow')->name('setphone');
    Route::post('setphone'                      , 'SetpassController@setphone')->name('setphone');
});

Route::group(['namespace' => 'Auth' , 'prefix' => 'admin'] , function (){
    // Authentication Routes...
    Route::get('login'      , 'LoginController@showLoginForm')->name('login');
    Route::post('login'     , 'LoginController@login');
    Route::get('logout'     , 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    Route::get('login'      , 'LoginController@showLoginuserForm')->name('loginuser');
    Route::get('remember'   , 'LoginController@showLoginrememberForm')->name('remember');
    Route::post('remember'  , 'LoginController@remember')->name('remember');
    Route::post('login-user', 'LoginController@loginuser')->name('login-user');
    Route::get('logout'     , 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register'   , 'RegisterController@showRegistrationuserForm');
    Route::post('register'  , 'RegisterController@registeruser')->name('register');
    Route::get('token'      , 'TokenController@showToken')->name('phone.token');
    Route::post('token'     , 'TokenController@token')->name('verify.phone.token');
    Route::get('welcome'    , 'WelcomeController@index' )->name('welcome');

});
