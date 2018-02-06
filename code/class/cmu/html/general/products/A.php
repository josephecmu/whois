<?php 
namespace cmu\html\general\products;

class A extends AbstractGeneralComponent

{

    private $href;  //the html page link
    private $target;  //target
    private $linkname = "Link";  //human readable link name
    
    public function setHref(string $href_in)

    {

        $this->href = $href_in;

    }

    public function getHref()

    {

        return $this->href;
    
    }

    protected function getHtmlHref()

    {

        if(isset($this->href)) {

            return "href='" . $this->href . "'";  

        }

    }

    public function setLinkname($linkname_in)

    {

        $this->linkname = $linkname_in;

    }

    public function getLinkname()

    {

        return $this->linkname;

    }

    public function setTarget($target_in)

    {

        $this->target = $target_in;

    }

    public function getTarget()

    {

        return $this->target;
    
    }

    protected function getHtmlTarget()

    {

        if(isset($this->target)) {

            return "target='" . $this->target. "'";  

        }

    }

}