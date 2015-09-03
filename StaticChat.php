<?php

namespace poprigun\chat;

use Yii;

class StaticChat extends Chat{
    /**
     * @var string template path
     */
    public $template = '@vendor/poprigun/yii2-chat/view/static_template.php';

    public function init(){

        parent::init();
    }

}
