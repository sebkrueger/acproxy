<?php
/*------------------------------------------------------------------------------

   Project  : CachingProxy
   Filename : src/CssCachingProxy.class.php
   Autor    : (c) Sebastian Krüger <krueger@secra.de>
   Date     : 15.09.2013

   For the full copyright and license information, please view the LICENSE
   file that was distributed with this source code.

   Description: extends the CachingProxy with css

  ----------------------------------------------------------------------------*/

namespace secra\CachingProxy;

class CssCachingProxy extends CachingProxy {

    public function __construct() {
        // set default path to cache .css files, base is webserver document root path
        $this->setCachepath("/demo/css/cache/");
        // define ending for css files
        $this->cachefileextension=".css";
    }

    public function getIncludeHtml() {
        // return include html code
        $filelist = $this->getIncludeFileset();

        $htmlreturn = "";

        foreach($filelist AS $file) {
            $htmlreturn .= "<link rel=\"stylesheet\" type=\"text/css\" ";
            $htmlreturn .= "href=\"".$file."\" />\n";
        }

        return $htmlreturn;
    }
}