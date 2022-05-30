<?php

class Site {
    public \stdClass $site;
    public string $name;
    public string $url;
    public string $version;
    public string $googleAnalytics;
    public array $pages = [];

    function __construct() {
        $path = "/data/site.json";
        if (file_exists(ADMIN_PATH . $path)) {
            $jsonString = file_get_contents(ADMIN_PATH . $path);
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
}