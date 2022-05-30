<?php
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BlocksExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('includeBlock', [$this, 'includeBlock'], ['needs_environment' => true]),
            new TwigFunction('includeScripts', [$this, 'includeScripts'], ['needs_environment' => true]),
            new TwigFunction('includeMeta', [$this, 'includeMeta'], ['needs_environment' => true]),
            new TwigFunction('includeStyles', [$this, 'includeStyles'], ['needs_environment' => true]),
        ];
    }

    public function includeBlock($env, $path, $params = [])
    {
        global $App;
        $script = "/data/blocks$path/script.js";
        if (file_exists(ADMIN_PATH . $script)) {
            $App->properties->addScript(ADMIN_ROOT . $script);
        }

        $style = "/data/blocks$path/style.css";
        if (file_exists(ADMIN_PATH . $style)) {
            $App->properties->addStyle(ADMIN_ROOT . $style);
        }

        $result = [];
        $resultPath = "/data/blocks$path/result.php";
        if (file_exists(ADMIN_PATH . $resultPath)) {
            include ADMIN_PATH . $resultPath;
        }
        if (!$params) $params = [];
        $params = array_merge($params, $result);

        $template = '/blocks' . $path . '/template.twig';
        return $env->render($template, $params);
    }

    public function includeScripts($env)
    {
        global $App;
        $scripts = $App->properties->scripts;
        $template = '/blocks/admin/script/template.twig';

        $html = '';
        foreach ($scripts as $script) {
            $html .= $env->render($template, ['src' => $script]);
        }
        return $html;
    }

    public function includeStyles($env, $isDelayed = true)
    {
        if ($isDelayed) return "{{ includeStyles(false) }}";

        global $App;
        $styles = $App->properties->styles;
        $template = '/blocks/admin/style/template.twig';

        $html = '';
        foreach ($styles as $style) {
            $html .= $env->render($template, ['href' => $style]);
        }
        return $html;
    }

    public function includeMeta($env)
    {
        global $App;
        $metas = $App->properties->meta;
        $template = '/blocks/admin/meta/template.twig';

        $html = '';
        foreach ($metas as $name=>$content) {
            $html .= $env->render($template, ['name' => $name, 'content' => $content]);
        }
        return $html;
    }
}

