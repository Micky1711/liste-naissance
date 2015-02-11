<?php
View::composer('layouts.admin', function ($view)
{
    $data['headerlogs'] = Mylog::where('read',0)->get();
    $data['headerfinancementslogs'] = Mylog::where('action','LIKE','%FINANCEMENT%')->where('read',0)->get();
    /* Avancement */
    $products_1 = Product::where('type',1)->get();
    $p1_total = 0;
    foreach($products_1 AS $p)
    {
    	$p1_total += $p->statut;	
    }
    $data['p1_percent'] = round(($p1_total/( count($products_1)*100 ))*100);

 	$products_2 = Product::where('type',2)->get();
    $p2_total = 0;
    foreach($products_2 AS $p)
    {
    	$p2_total += $p->statut;	
    }
    $data['p2_percent'] = round(($p2_total/( count($products_2)*100 ))*100);

 	$products_3 = Product::where('type',3)->get();
    $p3_total = 0;
    foreach($products_3 AS $p)
    {
    	$p3_total += $p->statut;	
    }
    $data['p3_percent'] = round(($p3_total/( count($products_3)*100 ))*100);

 	$view->with($data);
});