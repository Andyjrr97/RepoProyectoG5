<?php
spl_autoload_register(function($c){
  if (strpos($c, 'Ext\\') === 0) {
    $p = __DIR__ . '/../' . str_replace('Ext\\', '', $c) . '.php';
    $p = str_replace('\\','/',$p);
    if (is_file($p)) require $p;
  }
});
