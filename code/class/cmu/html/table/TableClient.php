<?php
namespace cmu\html\table;

class TableClient extends \cmu\html\products\AbstractHtmlDisplayClient

{

    function __construct(\cmu\html\base\Meta $totalobj_in)  

    {

        parent::__construct($totalobj_in);

        $this->display = new \cmu\html\table\products\CompositeTable;

        $this->display->setClass("table");
      
    }

    public function tableDisplay(array $trarray = ['class' => 'row'], array $trheader = ['class' => 'head'])   //used if we want to display ID with multiple blank rows (toner table)

    {
																				
        foreach ($this->totalobj->getTotalArray() as $row) {                
            
            if (!isset($needheader)) {                                                                     //HEADER   

                $this->buildTr($trheader);                                                                 //conveniece method below
            
                (new \cmu\html\table\rows\HeaderDefault($row, $this->display))->headerDisplay();
 
                $this->buildCloseTr();                                                                      //conveniece method below
                
                $needheader = 'no';                                                                         //don't need you anymore

            }                                                                                               //END HEADER
            
            $this->buildTr($trarray);                                                                       //conveniece method below
            
            (new \cmu\html\table\rows\DataSkipRow($row, $this->display, 'uid', 1))->blankRowDisplay();      //ROW DATA

            $this->buildCloseTr();                                                                          //conveniece method below
        }

    }

    private function buildTr($att_array)

    {

        (new \cmu\html\table\builders\VariableSingleBuilder("Tr", $att_array))->build($this->display);

    }

    private function buildCloseTr()

    {

        (new \cmu\html\table\builders\VariableSingleBuilder("CloseTag", array('tag' => 'tr')))->build($this->display);

    }

}

