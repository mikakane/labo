<?php

trait SampleTrait{

    public function method1(){
        return __TRAIT__."->".__METHOD__;
    }
    public function method2(){
        return __TRAIT__."->".__METHOD__;
    }
    public function method3(){
        return __TRAIT__."->".__METHOD__;
    }
    public function method4(){
        return __TRAIT__."->".__METHOD__;
    }

    public function method5(){
        return __TRAIT__."->".__METHOD__;
    }
}

/**
 * トレイトがトレイトを継承するパターン
 */
trait SampleExtendedTrait{

    use SampleTrait;

    protected function method3(){
        return __TRAIT__."->".__METHOD__;
    }
}



class SampleClass{

    use SampleTrait {
        method2 as protected;
        method3 as protected method3_5;
    }

    // PHPStormではエラーが出るが実行は可能
    // use as でprotectedにしてもエラーは出る。
    protected function method4(){
        return __CLASS__."->".__METHOD__;
    }

    public function method5(){
        return __CLASS__."->".__METHOD__;
    }

    public function callMethodFromInner(){
        $this->line($this->method1());
        $this->line($this->method2());
        $this->line($this->method3());
        $this->line($this->method3_5());
        $this->line($this->method4());
        $this->line($this->method5());

    }

    public function callMethodFromOuter(){
        $this->line(callFromOuter($this,"method1"));
//        $this->line(callFromOuter($this,"method2")); // protectedに書き換えたので呼べない
        $this->line(callFromOuter($this,"method3")); //これは呼べる
//        $this->line(callFromOuter($this,"method3_5")); // protected エイリアスなので呼べない
//        $this->line(callFromOuter($this,"method4")); // クラス内のメンバが優先
        $this->line(callFromOuter($this,"method5")); // クラスの方が呼ばれる
    }

    protected function line($line="hoge"){
        echo $line.PHP_EOL;

    }
}

class Sample2Class{

    use SampleExtendedTrait;


    public function callMethodFromInner(){
        $this->line($this->method1());
        $this->line($this->method2());
        $this->line($this->method3());
        $this->line($this->method4());
        $this->line($this->method5());

    }

    public function callMethodFromOuter(){
        $this->line(callFromOuter($this,"method1"));
        $this->line(callFromOuter($this,"method2")); // protectedに書き換えたので呼べない
//        $this->line(callFromOuter($this,"method3")); //これは呼べる
        $this->line(callFromOuter($this,"method4")); // クラス内のメンバが優先
        $this->line(callFromOuter($this,"method5")); // クラスの方が呼ばれる
    }

    protected function line($line="hoge"){
        echo $line.PHP_EOL;
    }
}

function callFromOuter($obj,$methodName){
    return $obj->$methodName();
}


$hoge = new SampleClass();

echo "CALL FROM OUTER".PHP_EOL;
$hoge->callMethodFromOuter();
echo "CALL FROM INNER".PHP_EOL;
$hoge->callMethodFromInner();

$hoge = new Sample2Class();

echo "CALL 2 FROM OUTER".PHP_EOL;
$hoge->callMethodFromOuter();
echo "CALL 2 FROM INNER".PHP_EOL;
$hoge->callMethodFromInner();

