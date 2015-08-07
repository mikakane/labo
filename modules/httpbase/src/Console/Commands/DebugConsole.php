<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2015/06/15
 * Time: 16:37
 */

namespace Chatbox\HttpBase\Console\Commands;


use Illuminate\Console\Command;

class DebugConsole extends Command{

    protected $name = "debug";
    protected $description = "hogehoge";

    public function handle(){
        $this->line("hogehoge");


    }


}