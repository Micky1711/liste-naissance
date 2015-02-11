<?php
namespace MyLib\TwitterBootstrap\Facades;
 
class TWB extends \Illuminate\Support\Facades\Facade {
 
    protected static function getFacadeAccessor() {
        return 'twb';
    }
 
}