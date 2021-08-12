<?php
namespace Yapf\HyperfTwig;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Hyperf\View\Engine\EngineInterface;

class TwigEngine implements EngineInterface {
    public function render($template, $data, $config):string{
        $template = str_ireplace('.','/',$template) . env('subffix','.twig');
        $loader = new FilesystemLoader($config['view_path']);
        $twig = new Environment($loader, [
            'cache' => $config['cache_path'],
            'debug' => env('debug',false),
            'charset' => env('charset','UTF-8'),
            'strict_variables' => env('strict_variables',false),
            'autoescape' => env('autoescape','html'),
            'auto_reload' => env('auto_reload',null),
            'optimizations' => env('optimizations',-1),

        ]);
        return $twig->render($template, $data);
    }
}