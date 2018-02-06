<?php 
namespace cmu\html\form\products;

class Legend extends AbstractFormComponent

{
    private $legendname;

    public function setLegendname( string $legendname_in)

    {

        $this->legendname = $legendname_in;

    }

    public function getHtmlLegendname()

    {

        if (isset($this->legendname)) { 
        
            return  $this->legendname;

        }

    }

}