<?php
namespace Inquizarus\Phunc;

interface FunctorInterface 
{
    /**
     * @param \Closure|string $f       The function to run when reducing
     * @param mixed           $initial The initial value to reduce upon
     *
     * @return mixed
     */
    public function reduce($f, $initial = null);

    /**
     * @param \Closure|string $f The function to run when filtering
     *
     * @return FunctorInterface New set of data wrapped in a Functor
     */
    public function filter($f): FunctorInterface;

    /**
     * @param \Closure|string $f The function to run when mapping
     *
     * @return FunctorInterface New set of data wrapped in a Functor
     */
    public function map($f): FunctorInterface;
}
