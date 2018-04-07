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
    use ContentOptionsTrait;

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
     * Convert content and options link in a content 
     */
    protected function coatLink($content,array $options = [])
    {
        $options += [
            'link' => false
        ];

        if ($options['link']) {
            // take the link 
            list($linkContent,$linkOptions) 
                = $this->getContentOptions($options['link']);
                $content = $this->link($content, $linkContent, $linkOptions);
        };
        unset($options['link']);

        return [$content,$options];
    }

    protected function extractIconText(array $options = []) 
    {
        $optionsDefaults = [
            'icon' => false,
            'showIcon' => true,
            'text' => false,
            'showText' => true,
        ];

        $options += $optionsDefaults;

        $icon = $text = "";

        if ($options['showIcon'] && $options['icon']) {
            list($iconContent,$iconOptions) 
                = $this->getContentOptions($options['icon']);
            $icon = $this->icon($iconContent, $iconOptions);
        }

        if ($options['showText'] && $options['text']) {
            $text = $options['text'];
        }

        // remove the keys
        $options = array_diff_key($options, $optionsDefaults);

        return [$icon . (empty($icon)?"":"&nbsp;") . $text, $options];
    }

    public function navbar($navs, array $options = []){
        $options += [
            'color' => "light",
            'bg' => "light"
        ];

        // nav
        $options = $this->addClass($options,"navbar");
        $options = $this->addClass($options,"navbar-".$options['color']);
        $options = $this->addClass($options,"bg-".$options['bg']);
        unset($options['color']);
        unset($options['bg']);


        // brand

        // brand button menu

        $navHtml = json_encode($navs);

        return $this->tag('nav', $navHtml, $options);
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
    protected function navTabContents($navTabs, $options)
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


    /**
     * generate a row of cols
     *
     * @param $cols
     * @param array $options
     * @return string
     */
    public function row($cols, array $options = [])
    {
        $nbCols =  count($cols);
        $options += [
            'width' => floor(12/$nbCols),
            'gutters' => true
        ];
        // generation de taille de colonnes
        if (is_array($options['width'])) {
            $widths = $options['width'];
        } else {
            $widths = array_fill(0, $nbCols, $options['width']);
        }
        //debug($widths);
        $colsArray = collection($cols)->map(function ($col, $index) use ($widths) {
            return $this->div('col col-md-'.$widths[$index], $col);
        }, [])->toArray();

        $class = "row";
        if(!$options['gutters']){
            $class .= " no-gutters";
        }

        return $this->div($class, implode($colsArray));
    }

    /**
     * List method
     * <ul><...li></ul>
     * receive a collection of element, each with potentials options, then send it to nested list
     * 
     * @return string html
     */
    public function ul(Collection $list,array $options = [])
    {
        // list of contentOptions + options for ul/ol
        

        $lis = $list->reduce(
            function ($reducer,$li) {
                list($iconText,$li) = $this->extractIconText($li);
                list($link,$li) = $this->coatLink($iconText, $li);
                $reducer['list'][] = $link;
                $reducer['listOptions'][] = $li;
                return $reducer;
            },
            ['list'=>[],'listOptions'=>[]]
        );

        return $this->nestedList($lis['list'], $options, $lis['listOptions']);



        $lis = $list->map(
            function ($li) {
                // si ! array
                if(!is_array($li)){
                    $li = ['text'=>$li];
                }

                $li += [
                    'text' => false,
                    'link' => false
                ];

                debug($li);

                $liHtml = $li['text'];
                unset($li['text']);

                if($li['link']){
                    $liLink = $li['link'];
                    unset($li['link']);

                    list($liContent,$liOptions) = $this->getContentOptions($liLink);

                    debug($liContent);
                    debug($liOptions);

                    $liHtml = $this->link($liHtml, $liContent, $liOptions);
                }

                return $this->tag('li', $liHtml, $li);
            }
        );

        return $this->tag('ul', implode($lis->toArray()));
    }
}