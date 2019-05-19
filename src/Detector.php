<?php

namespace Zhouzishu\LaravelHtmlDetector;

use Zhouzishu\LaravelHtmlDetector\Exceptions\NotInitException;

class Detector
{
    protected $htmlStr = null;
    public $tags = [];

    public function setHtml($htmlStr)
    {
        $this->htmlStr = $htmlStr;
        $this->tags = $this->getTags($this->htmlStr);
    }

    public function getTags($html)
    {
        // strip fraction of open or close tag from end (e.g. if we take first x characters, we might cut off a tag at the end!)
        $html = preg_replace('/<[^>]*$/', '', $html); // ending with fraction of open tag

        // put open tags into an array
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $opentags = $result[1];

        // put all closed tags into an array
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closetags = $result[1];

        $len_opened = count($opentags);

        return compact('opentags', 'closetags', 'len_opened');
    }

    public function check()
    {
        if (0 == count($this->tags)) {
            throw new NotInitException('Html not init.');
        }

        extract($this->tags);

        // close tags in reverse order that they were opened
        $opentags = array_reverse($opentags);

        // self closing tags
        $sc = ['br', 'input', 'img', 'hr', 'meta', 'link'];
        // ,'frame','iframe','param','area','base','basefont','col'
        // should not skip tags that can have content inside!

        $len_opened_checked = $len_opened;

        for ($i = 0; $i < $len_opened; $i++) {
            $ot = strtolower($opentags[$i]);

            if (in_array($ot, $sc)) {
                $len_opened_checked--;
            }
        }

        // if all tags are closed, we can return
        if (count($closetags) == $len_opened_checked) {
            return true;
        }

        return false;
    }
}
