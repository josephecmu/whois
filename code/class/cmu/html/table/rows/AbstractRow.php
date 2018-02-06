<?php
namespace cmu\html\table\rows;

abstract class AbstractRow

{

    protected $row = array();
    protected $display;

    function __construct(array $row_in, \cmu\html\table\products\CompositeTable $display_in)
    
    {

        $this->row = $row_in;

        $this->display = $display_in;

    }

}