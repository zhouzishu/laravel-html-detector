<?php

namespace Zhouzishu\LaravelHtmlDetector;

use Closure;

class DetectorMiddleware
{
    private $detector;

    public function __construct(Detector $detector)
    {
        $this->detector = $detector;
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $html = $response->getContent();

        $this->detector->setHtml($html);

        if (! $this->detector->check()) {
            $response->setContent($this->outputAlert($html));
        }

        return $response;
    }

    public function outputAlert($content)
    {
        $script = '<script>alert("Html Tag Closure Check Failed!");</script></body>';

        if (false !== strpos($content, '</body>')) {
            return str_replace('</body>', $script.'</body>', $content);
        }

        return $content.$script;
    }
}
