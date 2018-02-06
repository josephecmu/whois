<?php 
namespace cmu\html\products;

trait TraitCloseTag

{

    private $tag;

    public function setTag($tag_in)

    {

        $this->tag = $tag_in;

    }

    public function getTag()

    {

        return "</" . $this->tag . ">";

    }

}