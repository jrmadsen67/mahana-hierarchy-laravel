<?php namespace Jrmadsen67\MahanaHierarchyLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class HierarchyFacade extends Facade
{

    /**
     * Get the registered name of the component
     *
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'mahana_hierarchy';
    }
}