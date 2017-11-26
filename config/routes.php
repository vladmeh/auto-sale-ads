<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 *
 * @var Application $app
 */

use Zend\Expressive\Application;


$app->get('/', App\Action\HomePageAction::class, 'home');
$app->get('/car', App\Action\IndexAction::class, 'index');
$app->get('/ads/add', App\Action\AdsAddForm::class, 'ads.add');
$app->route('/car/model', App\Action\ModelJsonAction::class, ['GET', 'POST'], 'car.model');
$app->get('/api/ping', App\Action\PingAction::class, 'api.ping');
$app->post('/car/add', App\Action\CarAdd::class, 'car.add');