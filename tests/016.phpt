--TEST--
tests Fiber for extended stack frame
--SKIPIF--
<?php
if (!extension_loaded('fiber')) {
    echo 'skip';
}
?>
--FILE--
<?php
function foo()
{
    Fiber::yield(1);
}

$f = new Fiber(function () {
    foo(1, 2, 3, 4);
    Fiber::yield(2);
    return 3;
}, 128);
var_dump($f->resume());
var_dump($f->resume());
var_dump($f->resume());
?>
--EXPECTF--
int(1)
int(2)
int(3)
