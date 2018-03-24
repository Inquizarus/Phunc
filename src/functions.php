<?php
use \Inquizarus\Phunc\{Functor, FunctorInterface};

if (true !== function_exists("map")) {
    function map($input, $f): FunctorInterface
    {
        return (new Functor($input))->map($f);
    }
}

if (true !== function_exists("reduce")) {
    function reduce($input, $f, $init = null) {
        return (new Functor($input))->reduce($f, $init);
    }
}

if (true !== function_exists("filter")) {
    function filter($input, $f, $init = null) {
        return (new Functor($input))->filter($f);
    }
}

if (true !== function_exists("feach")) {
    function feach($input, $f) {
        return (new Functor($input))->each($f);
    }
}

if (true !== function_exists("append")) {
    function append($a, $b)
    {
        if (true === is_array($a)) {
            return array_merge($a, $b);
        }
        return $a . $b;
    }
}

if (true !== function_exists("prepend")) {
    function prepend($a, $b)
    {
        if (true === is_array($b)) {
            return array_merge($b, $a);
        }
        return $b . $a;
    }
}