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
     *
     */
    public function card($body, array $options = []){
        $options += [
            'header' => false,
            'footer' => false
        ];

        // header
        $divHeader = "";
        if($options['header']){
            $divHeader = $this->div('card-header',$options['header']);
        }

        $divBody = $this->div('card-body',$body);

        // footer
        $divFooter = "";
        if($options['header']){
            $divFooter = $this->div('card-footer',$options['footer']);
        }

        return $this->div('card',$divHeader.$divBody.$divFooter);
    }

    /**
     * generate navTabs
     *
     * @param $navTabs
     * @param array $options
     *
     */
    public function navTabs($navTabs, array $options = []){
        $options += [
            'id' => "nt".uniqid()
        ];

        $tabContents = $this->navTabContents($navTabs,$options);

        $options = $this->addClass($options,"nav nav-tabs");

        $tabs = $this->tag(
            'ul',
            implode($tabContents['tabs']),
            $options
        );

        $contents = $this->div(
          "tab-content",
          implode($tabContents['contents'])
        );

        return $tabs.$contents;
    }

    /**
     * generate tabs and content for navTabs
     *
     * @param $navTabs
     * @param $options
     * @return array [tabs,contents]
     */
    private function navTabContents($navTabs, $options)
    {
        // is any tab is active ? if not then the first one is selected
        $hasActive = collection($navTabs)->some(function($navTab){
            return isset($navTab['active']) && $navTab['active']===true;
        });

        return collection($navTabs)->reduce(function($reducer,$navTab,$index)use($options,$hasActive){
            $navTab += [
                'tab' => false,
                'content' => false,
                'active' => false
            ];

            $linkOptions = [
                'class' => "nav-link",
                'data-toggle' => "tab",
                'role' => "tab"
            ];

            $id = $options['id'].$index;

            $contentOptions = [
                'class' => "tab-pane fade",
                'id' => $id,
                'role' => "tabpanel"
            ];

            // si onglet actif
            if((!$hasActive && $index==0) || $navTab['active']){
                $linkOptions = $this->addClass($linkOptions,'active');
                $contentOptions = $this->addClass($contentOptions,'show active');
            }

            $reducer['tabs'][] = $this->tag(
                'li',
                $this->link(
                    $navTab['tab'],
                    "#".$id,
                    $linkOptions
                ),
                [
                    'class' => "nav-item"
                ]
            );

            $reducer['contents'][] = $this->tag(
                'div',
                $navTab['content'],
                $contentOptions
            );

            return $reducer;

        },['tabs'=>[],'contents'=>[]]);
    }

    /*
     * */
    public function row($cols, array $options = [])
    {
        $nbCols =  count($cols);
        $options += [
            'width' => floor(12/$nbCols)
        ];
        // generation de taille de colonnes
        if (is_array($options['width'])) {
            $widths = $options['width'];
        } else {
            $widths = array_fill(0, $nbCols, $options['width']);
        }
        //debug($widths);
        $html = collection($cols)->reduce(function ($reducer, $col, $index) use ($widths) {
            return $reducer.$this->div('col col-md-'.$widths[$index], $col);
        }, "");
        return $this->div('row', $html);
    }

    /**
     * List method
     * <ul><...li></ul>
     * 
     * @return string html
     */
    public function ul(Collection $list)
    {
        return $this->nestedList($list->toArray());

        /*
         * ancienne methode
        $lis = $list->reduce(
            function ($reducer, $li) {
                $reducer .= $this->tag('li', $li);
                return $reducer;
            },
            ""
        );

        return $this->tag('ul', $lis);
        */
    }
}