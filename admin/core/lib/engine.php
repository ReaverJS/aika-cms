<?php

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Engine
{
    private string $html;
    public Environment $twig;
    public FilesystemLoader $twigLoader;
    public Properties $properties;
    public Site $site;
    public array $blocks;
    public stdClass $urlParams;

    function __construct()
    {
        $this->urlParams = $this->getUrlParams();

        $this->twigLoader = new FilesystemLoader(ADMIN_PATH . '/data');
        $this->twig = new Environment($this->twigLoader, [
            'autoescape' => false,
            'cache' => false
        ]);
        $this->twig->addExtension(new BlocksExtension());

        $this->properties = new Properties();
        $this->site = new Site();
        $this->blocks = $this->getBlocks();
    }

    static function debug($data)
    {
        echo '<pre style="background-color: #232b2b; color: white; border-radius: 6px; z-index: 20; position: relative;
                        margin: 12px; padding: 12px 16px 12px 12px; border: 2px solid #f39c12;">';
        print_r($data);
        echo '</pre>';
    }

    function getBlocks() : array
    {
        $publicPath = ADMIN_PATH . '/data/blocks/public';
        $blocksPathes = scandir($publicPath);
        $blocksPathes = array_diff($blocksPathes, ['.', '..']);
        sort($blocksPathes);

        $blocks = [];
        foreach ($blocksPathes as $blockCode) {
            $blockPath = '/' . $blockCode;
            if (file_exists($publicPath . $blockPath . '/template.twig')
                && file_exists($publicPath . $blockPath . '/params.json')) {

                $jsonString = file_get_contents($publicPath . $blockPath . '/params.json');
                $params = json_decode($jsonString);
                $params->code = $blockCode;
                $blocks[] = new Block($params);
            }
        }

        return $blocks;
    }

    function getUrlParams() : stdClass
    {
        $urlParams = new stdClass();
        foreach ($_GET as $key => $value) {
            $urlParams->$key = $value;
        }
        return $urlParams;
    }

    function render($path, $params = [], $return = false)
    {
        if (is_object($params)) $params = (array) $params;

        $style = "/data/blocks$path/style.css";
        if (file_exists(ADMIN_PATH . $style)) {
            $this->properties->addStyle(ADMIN_ROOT . $style);
        }

        $this->html = $this->twig->render($path, $params);
        $template = $this->twig->createTemplate($this->html);

        if ($return) return $template->render();
        else echo $template->render();
    }
}