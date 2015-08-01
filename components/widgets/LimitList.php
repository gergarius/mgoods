<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 01.08.15
 * Time: 17:13
 */

namespace app\components\widgets;


use kartik\base\Widget;

class LimitList extends Widget {

    public function run(){
        return $this->render("limitlist");
    }

}