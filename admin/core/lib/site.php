<?php

class Site
{
    public string $path = '/data/site.json';
    public \stdClass $site;
    public string $name;
    public string $url;
    public string $version;
    public string $googleAnalytics;
    public array $pages = [];

    function __construct()
    {
        if (file_exists(ADMIN_PATH . $this->path)) {
            $jsonString = file_get_contents(ADMIN_PATH . $this->path);
            $site = json_decode($jsonString);

            $this->name = $site->name;
            $this->url = $site->url;
            $this->version = $site->version;
            $this->googleAnalytics = $site->googleAnalytics;

            foreach ($site->pages as $page) {
                $this->pages[] = new Page($page);
            }
        }
    }

    function save()
    {
        if (file_exists(ADMIN_PATH . $this->path)) {
            file_put_contents(ADMIN_PATH . $this->path, json_encode($this, JSON_UNESCAPED_UNICODE));
        }
    }

    function generate()
    {
        $domain = 'https://' . $this->url;
        foreach ($this->pages as $page) {
            $path = ROOT_PATH . $page->url;
            if ($path[strlen($path) - 1] === '/') {
                $path = rtrim($path, "/");
            }
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file = fopen($path . '/index.html', "w");
            $html = file_get_contents($domain . ADMIN_ROOT . '/page-preview/?url=' . $page->url);
            fwrite($file, $html);
            fclose($file);
        }
    }
}