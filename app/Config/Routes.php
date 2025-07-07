<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========================
// LANDING PAGE ROUTE
// ========================
$routes->get('/', function () {
    return view('landing'); // View di app/Views/landing.php
});

// ========================
// AUTH ROUTES
// ========================
$routes->get('/login', 'Auth::index');               // Halaman login
$routes->post('/login', 'Auth::login');              // Proses login
$routes->get('/register', 'Auth::register');         // Halaman register
$routes->post('/registerPost', 'Auth::registerPost');// Proses register
$routes->get('/logout', 'Auth::logout');             // Logout

// ========================
// DASHBOARD ROUTES
// ========================
$routes->get('/dashboard', 'Dashboard::index');             // Dashboard utama
$routes->get('/dashboard/profile', 'Dashboard::profile');
$routes->post('/dashboard/updateProfile', 'Dashboard::updateProfile');
$routes->post('/dashboard/tambah', 'Dashboard::tambah');    // Tambah makanan
$routes->get('/history', 'Dashboard::history');             // Riwayat makanan
$routes->get('/dashboard/daftar-makanan', 'Dashboard::daftarMakanan'); // Daftar makanan
$routes->post('/dashboard/updateTargetKalori', 'Dashboard::updateTargetKalori');


// ========================
// HITUNG KALORI
// ========================
$routes->get('/kalkulator-kalori', 'Dashboard::kalkulatorKalori'); // halaman kalkulator

// ========================
// OLAHRAGA / FITUR TAMBAHAN (jika ada)
// ========================
