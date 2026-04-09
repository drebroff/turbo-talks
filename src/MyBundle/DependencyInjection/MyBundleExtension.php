<?php

namespace App\MyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MyBundleExtension extends Extension
{
    public function addAnnotatedClassesToCompile(array $annotatedClasses): void
    {
        trigger_deprecation('symfony/http-kernel', '7.1', 'The "%s()" method is deprecated since Symfony 7.1 and will be removed in 8.0.', __METHOD__);

        $this->annotatedClasses = array_merge($this->annotatedClasses, $annotatedClasses);
    }
    public function load(array $configs, ContainerBuilder $container): void
    {
       $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');
    }

    public function getAlias(): string
    {
        return 'my_bundle';
    }
}