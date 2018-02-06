<?php
namespace cmu\html\form\validate;

class ValidatorContext extends \cmu\html\products\AbstractStrategyContext

{
    private $errors = 0;
    private $seperator = '<br />';

    public function setSeperator($seperator_in)

    {

        $this->seperator = $seperator_in;

    }

    public function validateText($valuetovalidate_in, $valuetovalidateagainst_in = null)

    {
        //read in the ARRAY of validate filters
        foreach($this->strategies as $strategy) {
            ////convert to uppercase first letter and after each '_' to get ClassName
            $ucase_strategy = str_replace(' ', '',  ucwords(str_replace('_', ' ', $strategy)));

            $class_name = 'cmu\html\form\validate\Validator' . $ucase_strategy; 

            $this->strategy = new $class_name($valuetovalidate_in, $valuetovalidateagainst_in);

            if (!$this->strategy->validateInput()) {

                $this->errors++;                                                                       //add to error count

            }

        }

        if ($this->errors == 0) {

            return true;

        }

    }

    public function getErrorMessagesString()

    {

        $message_string = implode($this->seperator, $this->strategy->getErrorMessages());

        $this->strategy->resetErrorMessages();  //zero out error messages for next object

        return $message_string;

    }

}