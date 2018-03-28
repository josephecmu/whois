<?php

namespace cmu\html\form\process\dto;

use cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;
use \cmu\html\base\ReturnPost;

abstract class AbstractProcess

{

    protected $returnpostobj;  
    protected $dn;
	protected $dto;

    function __construct(ReturnPost $returnpostobj_in, string $dn_in = null)
	{

        $this->returnpostobj = $returnpostobj_in;

        $this->dn = $dn_in;

		$this->dto = DTOAssembler::returnDTO($returnpostobj_in->getValues());

	}

	abstract protected function modify() : bool;

}
