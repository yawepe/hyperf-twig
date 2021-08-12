<?php
namespace Yapf\HyperfTwig;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Hyperf\View\Engine\EngineInterface;

class TwigEngine implements EngineInterface {
    public function render($template, $data, $config):string{
        $template = str_ireplace('.','/',$template) . env('TWIG_SUBFFIX','.twig');
        $loader = new FilesystemLoader($config['view_path']);
        $twig = new Environment($loader, [
            'cache' => $config['cache_path'],
            'debug' => env('TWIG_DEBUG',false),
            'charset' => env('TWIG_CHARSET','UTF-8'),
            'strict_variables' => env('TWIG_STRICT_VARIABLES',false),
            'autoescape' => env('TWIG_AUTOESCAPE','html'),
            'auto_reload' => env('TWIG_AUTO_RELOAD',null),
            'optimizations' => env('TWIG_OPTIMIZATIONS',-1),

        ]);
        return $twig->render($template, $data);
    }
}