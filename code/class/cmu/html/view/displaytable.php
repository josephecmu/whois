<?php

    include'../code/class/cmu/config/site/table.conf';

    $ldap_parms = ['att' => array_keys($tablearray), 
                'filter' => "(objectClass=*)",
                    'dn' => "ou=people, dc=mcs, dc=cmu, dc=edu"];   //'dn' => set internally 

    $meta = new \cmu\html\base\Meta();

    $meta->setProperties($tablearray);

    $dic = new \cmu\html\table\TableMetaQueryDic($meta, $ldap_parms);

    $table = $dic->returnDisplayObject();

    $table->tableDisplay();                              //$trheader last argument

    echo $table->returnDisplay();
