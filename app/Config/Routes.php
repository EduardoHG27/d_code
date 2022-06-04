<?php


namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/',['namespace' => 'App\Controllers\Auth'], function ($routes){
    $routes->get('', 'Home::index');
    $routes->post('check', 'Login::signin', ['as' => 'signin']);
   // $routes->post('check_in', 'Login::signin_in', ['as' => 'signin_in']);
    //$routes->post("check_in", "Login::signin_in");
    $routes->post("logueo_test", "Login::signin_in");
    

});

$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('login', 'Register::index');
   
});


$routes->group('principal', ['namespace' => 'App\Controllers\Principal'], function ($routes) {
    $routes->get('inicio', 'First_page::index');
    $routes->get('member', 'First_page::member');
    $routes->get('student', 'First_page::student');
    $routes->get('plans', 'First_page::plans');
    $routes->get('data', 'First_page::data');
    $routes->get('staff', 'First_page::staff');
    $routes->get('boot', 'First_page::boot');
    $routes->get('dashboard', 'First_page::dash');
    $routes->get('session_out', 'First_page::get_out');
    $routes->post('ajax_load_data', 'First_page::ajax_load_data');
});



$routes->group('student', ['namespace' => 'App\Controllers\Student'], function ($routes) {
    $routes->post("ajax-load", "Student::ajaxLoadData");
    $routes->post("ajax-load_test", "Student::ajaxLoadData_test");
    $routes->post("student_store", "Student::store");
    $routes->post("student_get", "Student::get_student");
    $routes->post("student_update", "Student::update");
    $routes->post("student_delete", "Student::delete");
    $routes->post("student_get_plan", "Student::get_plan");
    $routes->post("student_data", "Student::get_plan_data");
    $routes->post("student_log", "Student::log");
    $routes->post("planmember_store", "Student::store_planmember");
    $routes->post("student_chek_delete", "Student::chek_delete");
    $routes->post("dash_panel", "Student::dash");
    $routes->post("qr", "Student::qr");
    $routes->post("get_qr", "Student::get_qr");
    
    
    

});
$routes->group('pays', ['namespace' => 'App\Controllers\Pays'], function ($routes) {
    $routes->post("pay_delete", "Pays::delete");
});
$routes->group('plans', ['namespace' => 'App\Controllers\Plans'], function ($routes) {
    $routes->post("plan-ajax-load", "Plans::ajaxLoadData");
    $routes->post("plan_store", "Plans::store");
    $routes->post("plan_get", "Plans::get_plan");
    $routes->post("plan_update", "Plans::update");
    $routes->post("plan_delete", "Plans::delete");
    $routes->post("plan_status_up", "Plans::status_up");
    

});

$routes->group('staff', ['namespace' => 'App\Controllers\Staff'], function ($routes) {
    $routes->post("staff-ajax-load", "Staff::ajaxLoadDataStaff");
    $routes->post("staff_store", "Staff::store");
    $routes->post("staff_delete", "Staff::delete");
    $routes->post("plan_store", "Staff::store");
    $routes->post("staff_update", "Staff::get_staff");
    $routes->post("plan_update", "Staff::update");
    $routes->post("plan_delete", "Staff::delete");
    $routes->post("plan_status_up", "Staff::status_up");
    $routes->post("schedule", "Staff::schedule");
    $routes->post("chek_delete", "Staff::chek_delete");
});

$routes->group('informativo', ['namespace' => 'App\Controllers\Informativo'], function ($routes) {
    $routes->post("plan-ajax-load", "Informativo::ajaxLoadData");
   
});

$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('login', 'Register::index');
    $routes->get('tasks', 'Task::index');
   
});

//$routes->cli('task', 'Task::index');

//$routes->get("list-student", "Student::listStudent");





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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
