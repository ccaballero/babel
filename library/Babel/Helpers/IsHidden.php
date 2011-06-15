<?php

class Babel_Helpers_IsHidden
{
    public function isHidden($route, $menu) {
        return (substr($route, 0, strlen($menu)) == $menu);
    }
}
