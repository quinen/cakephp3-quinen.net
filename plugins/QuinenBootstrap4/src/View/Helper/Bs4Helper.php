<?php
/**
 * Fichier des helpers specifiques bootstrap 4
 * 
 */
namespace QuinenBootstrap4\View\Helper;

//use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;
use Cake\Collection\Collection;

/**
 * Bootstrap 4 helper
 */
class Bs4Helper extends HtmlHelper
{

    /**
     * List method
     * <ul><...li></ul>
     * 
     * @return string html
     */
    public function ul(Collection $list)
    {
        $lis = $list->reduce(
            function ($reducer, $li) {
                $reducer .= $this->tag('li', $li);
                return $reducer;
            }, 
            ""
        );
        return $this->tag('ul', $lis);
    }
}