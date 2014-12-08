<?php

namespace Stdlib\Struct;

/**
 * Interface TreeInterface
 * @package Stdlib\Struct
 */
interface TreeInterface
{
    /**
     * @return bool
     */
    public function isRoot();

    /**
     * @return bool
     */
    public function getAncestor();

    /**
     * @return bool
     */
    public function getDescendants();
}