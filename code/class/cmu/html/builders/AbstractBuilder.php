<?php
namespace cmu\html\builders;

abstract class AbstractBuilder

{
    //passed array from files
    protected static $metaarray = array();
    //copy of Metaarray used for changing values, must be in parent, so all children can access
    protected static $elementarray = array();
    //array of values from database
    protected static $valuesarray = array();

    function __construct(array $metaarray_in) {            //we could pass objects, not arrays here...static
        //must set these first, other things rely on them in this __constructor
        self::$metaarray = $metaarray_in;

        ////populate the elementarray
        self::$elementarray = self::$metaarray;
        //Values array (shorthand) VALUES are passed in the meta array and split out
        self::$valuesarray = !empty(self::$metaarray['values']) ? self::$metaarray['values'] : null ;

    }

}