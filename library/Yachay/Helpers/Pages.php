<?php

class Yachay_Helpers_Pages
{
    public function pages($file) {
        $stream = @fopen($file, "r");
        $PDFContent = @fread($stream, filesize($file));

        if (!$stream || !$PDFContent) {
            return '--';
        }

        $firstValue = 0;
        $secondValue = 0;
        $matches = null;

        if (preg_match("/\/N\s+([0-9]+)/", $PDFContent, $matches)) {
            $firstValue = $matches[1];
        }

        if (preg_match_all("/\/Count\s+([0-9]+)/s", $PDFContent, $matches)) {
            $secondValue = max($matches[1]);
        }
        
        return (($secondValue != 0) ? $secondValue : max($firstValue, $secondValue));
    }
}
