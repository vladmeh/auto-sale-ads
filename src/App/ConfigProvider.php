<?php

namespace App;
use App\Factory\AuthenticationServiceFactory;
use \Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Zend\Authentication\AuthenticationService;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'doctrine'     => $this->getDoctrine(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                AuthenticationService::class => AuthenticationServiceFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }

    public function getDoctrine()
    {
        return [
            'driver' => [
                'orm_default' => [
                    'drivers' => [
                        'App\Entity' => 'app_entity',
                    ],
                ],
                'app_entity' => [
                    'class' => SimplifiedYamlDriver::class,
                    'cache' => 'array',
                    'paths' => [
                        dirname(__DIR__) . '/App/config/doctrine' => 'App\Entity',
                    ],
                ],
            ],
        ];
    }
}
