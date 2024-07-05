<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/petugas', 'PetugasController::index');
$routes->post('/petugas/login', 'PetugasController::login');
$routes->get('/petugas/logout', 'PetugasController::logout');
$routes->get('/petugas/dashboard', 'Dashboardpetugas::index', ['filter' => 'otentifikasi']);
$routes->get('/petugas/tampil', 'PetugasController::tampilPetugas');
$routes->get('/petugas/tambah', 'PetugasController::tambahPetugas');
$routes->post('/petugas/simpan', 'PetugasController::simpanPetugas');
$routes->get('/petugas/edit/(:num)', 'PetugasController::editPetugas/$1');
$routes->post('/petugas/simpan', 'PetugasController::updatePetugas');
$routes->get('/petugas/hapus/(:num)', 'PetugasController::hapusPetugas/$1');
