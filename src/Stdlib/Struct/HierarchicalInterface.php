<?php

namespace Stdlib\Struct;

/**
 * Interface HierarchicalInterface
 * @package Stdlib\Struct
 */
interface HierarchicalInterface
{
    /**
     * @return mixed
     */
    public function getParent();

    /**
     * @return mixed
     */
    public function getChildren();
}