<?php
namespace cmu\html\table\rows;

class HeaderDefault extends AbstractHeader

{

    function headerDisplay()

    {

        $headers = array_column($this->row, 'header');                                  //get array of [header] key

        foreach ($headers as $header) {

            $header_data = [ 'thdata' => $header ];                                     //build attribute array with data

            (new \cmu\html\table\builders\VariableSingleBuilder("Th", $header_data))->build($this->display);     //TH

        }

    }

}