<?php

namespace app\model;

class TestModel extends \core\Model
{
    protected $table = 'protect';

    public function challenge()
    {
        $products = $this->findAll();
        var_dump($products);
        echo 'solution...';
    }
}