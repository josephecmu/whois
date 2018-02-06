<?php
namespace cmu\html\table\rows;

class DataSkipRow extends AbstractData

{

    private $idcol; 
    private $numrowsskip;
    private $existing;
    private static $last = null;
	
    function __construct(array $row_in, \cmu\html\table\products\CompositeTable $display_in, $idcol_in = null, $numrowsskip_in = null)

    {

        parent::__construct($row_in, $display_in);

        $this->arrayValueToString('tddata');                                    //convert TDDATA to strings from ARRAYS with <br>; for multi-valued attributes

        $this->idcol = $idcol_in;

        $this->numrowsskip = $numrowsskip_in;

        $current = $this->row[$this->idcol]['tddata'];                          //get current

        $this->existing = ($current == self::$last) ? 1 : null ;          	    //compare LAST with current
               
        self::$last = $current;                                                 //change $last AFTER above check!
                                                                       
    }

    function blankRowDisplay()

    {
    
    	$i = 0;
           
        foreach ($this->row as $cell) { 

            $cell['externalarray'] = $this->row;                                                //set the row as a property for URL lookups, maybe use REGISTRY later...
    
        	if (in_array('noprint', $cell)) {  continue ; }                 					//we don't print out 'noprint' (usually for 'dn')

            if (!isset($existing) || $i >= $this->numrowsskip) {								//we DONT HAVE existing ID trigger, return full cell...
           
                (new \cmu\html\table\builders\VariableSingleBuilder("Td", $cell))->build($this->display); 																	

            } elseif ($i == 0) {                                             					//we have existing ID trigger, skip the first x (colspan
                
                (new \cmu\html\table\builders\VariableSingleBuilder("Td", array('colspan' => $this->numrowsskip, 'class' => 'blank')))->build($this->display);    
            }
            
            $i++;

        }
                
    }

}