<?php
namespace MyLib\TwitterBootstrap;
 
class ServiceProvider extends \Illuminate\Support\ServiceProvider {
 
    public function register(){
        $this->app->bindShared('twb', function($app){
            return new TWB();
        });
    }
 
}