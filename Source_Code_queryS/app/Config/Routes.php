<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/hello', 'Hello::index');
$routes->get('/home', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/verify_login', 'Login::verify_login');
$routes->get('/signup', 'Signup::index');
$routes->post('/signup', 'Signup::index');
$routes->post('/signup/verify_email', 'Signup::verify_code');
$routes->get('/user_home', 'User_home::index');
$routes->get('/user_home/autocomplete', 'User_home::autocomplete');
$routes->post('/logout', 'Login::logout');
$routes->post('/user_profile', 'User_profile::view_profile');
$routes->post('/edit_profile', 'Edit_profile::index');
$routes->post('/edit_profile/update', 'Edit_profile::update');
$routes->get('/upload/upload_form', 'Upload_form::index');
$routes->post('/upload/drag_drop_upload','Upload_form::do_drag_drop');
$routes->post('/upload/upload_form', 'Upload_form::doUpload');
$routes->get('/forgot_password', 'Forgot_password::index');
$routes->post('/forgot_password/request_email', 'Forgot_password::request_email');
$routes->post('/forgot_password/verify_code','Forgot_password::verify_code');
$routes->post('/forgot_password/update_password','Forgot_password::update_password');
$routes->post('/new_topic','New_topic::new_topic');
$routes->post('/add_new_topic', 'New_topic::add_new_topic');
$routes->post('/view_posts', 'Posts::view_posts');
$routes->post('/add_new_post', 'Posts::add_new_post');
$routes->post('/view_comments', 'Comments::view_comments');
$routes->post('/add_new_comment', 'Comments::add_comment');
$routes->post('/search_post', 'Comments::view_comments_with_post_heading');
$routes->post('/like_comment', 'Comments::like_comment');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
