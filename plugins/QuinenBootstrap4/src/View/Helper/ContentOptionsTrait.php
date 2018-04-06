<?php
/**
 * This file is part of the Pilotage package.
 *
 * @author Laurent DESMONCEAUX <laurent.desmonceaux@engie.com>
 * @created 06/04/2018 15:06
 * @version 1.0
 */

namespace QuinenBootstrap4\View\Helper;

use Cake\Utility\Hash;

trait ContentOptionsTrait
{
    /*
        transforme les données de type :
            "toto"              => "toto"   ,[]
            ["titi"]            => "titi"   ,[]
            ["tata",['a'=>"b"]] => "tata"   ,['a'=>"b"]
            [,['b'=>"c"]]       => null     ,['b'=> "c"]
    */
    protected function getContentOptions($content, $contentDefault = null)
    {
        $contentOptions = [];

        if (is_array($content) && isset($content[0])) {
            $contentOptions = Hash::get($content, '1', []);
            $content        = Hash::get($content, '0', $contentDefault);
        }
        return [$content,$contentOptions];
    }
}