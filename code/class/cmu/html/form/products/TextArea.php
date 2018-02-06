<?php 
namespace cmu\html\form\products;

class TextArea extends AbstractControls

{

    use TraitTextValidate, TraitDisabled, TraitPlaceholder, TraitAutofocus;

    private $rows = null;
    private $cols = null;
    private $text = null;  //value in textarea
    private $wrap = null;

    function setRows( int $rows_in)

    {

        $this->rows =  $rows_in ;

    }

    function setCols( int $cols_in)

    {

        $this->cols =  $cols_in;

    }

    function setText( string $text_in)

    {

        $this->text = $text_in;

    }

     function setWrap($wrap_in)

    {

        $this->wrap = $wrap_in;

    }
        
    public function getText()

    {

        return $this->text;

    }

    protected function getHtmlRows()
    
    {

        if (isset($this->rows)) { 
        
            return "rows = '" . $this->rows . "'";

        }

    }

    protected function getHtmlCols()
    
    {

        if (isset($this->cols)) { 
        
            return "cols = '" . $this->cols . "'";

        }

    }

    protected function getHtmlWrap()
    
    {

        if (isset($this->wrap)) { 
        
            return "wrap = '" . $this->wrap . "'";

        }

    }

    public function getTextareaText()
    
    {

        if (isset($this->text)) { 
        
            return $this->text;

        }

    }

}