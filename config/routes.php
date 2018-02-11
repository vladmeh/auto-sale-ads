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

$app->get('/', App\Action\IndexAction::class, 'index');
$app->get('/view/:id',App\Action\AdsViewAction::class, 'ads.view');
$app->route('/update/:id', [App\Action\AdsUpdateForm::class, App\Action\AdsUpdatePost::class], ['GET', 'POST'], 'ads.update');
$app->route('/add', [App\Action\AdsAddForm::class, App\Action\AdsAddPost::class], ['GET', 'POST'], 'ads.add');
$app->route('/car/model', App\Action\ModelJsonAction::class, ['GET', 'POST'], 'car.model');
$app->get('/delete/:id', App\Action\AdsDelete::class, 'ads.delete');

$app->route('/login', App\Action\LoginAction::class, ['GET', 'POST'], 'login');
$app->get('/admin', [App\Action\AuthAction::class, App\Action\AdminAction::class], 'admin');
$app->route('/admin/user/add', [App\Action\UserAddPost::class], ['GET', 'POST'], 'admin.user.add');
