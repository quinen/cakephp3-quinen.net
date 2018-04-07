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
    public function card($body, array $options = [])
    {
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
     * 
     * @param string $content           content
     * @param array  $options           options
     * @param array  $injectLinkOptions injectLinkOptions
     * 
     * @return array [content,options]
     */
    protected function coatLink(
        $content, 
        array $options = [], 
        array $injectLinkOptions = []
    ) {
        $options += [
            'link' => false
        ];

        if ($options['link']) {
            // take the link 
            list($linkContent,$linkOptions) 
                = $this->getContentOptions($options['link']);
            $content = $this->link(
                $content, 
                $linkContent, 
                $linkOptions + $injectLinkOptions
            );
        };
        unset($options['link']);

        return [$content,$options];
    }

    /**
     * Extract icon and text and generate a string for both
     * 
     * @param array $options options to parse
     * 
     * @return array [content,options without iconText related elements]
     */
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

    public function navbar($navs, array $options = [])
    {
        $options += [
            'color' => "light",
            'bg' => "light",
            'id' => "nb" . uniqid(),
            'expand' => "sm"
        ];

        // nav options
        $options = $this->addClass(
            $options, 
            "navbar navbar-" . $options['color'] . 
            " bg-" . $options['bg'] . " navbar-expand-" . $options['expand']
        );
        unset($options['color']);
        unset($options['bg']);

        // brand
        list($navBrand,$navs) = $this->navbarBrand($navs);

        // nav collapse button

        // nav list  > ul/li
        $navList = $this->navbarList($navs);
        
        $navHtml = $navBrand.$navList
        ;

        return $this->tag('nav', $navHtml, $options);
    }

    /**
     * Generate the brand element from navs
     * 
     * @param array $navs navigation data
     * 
     * @return string brand HTML string
     */
    protected function navbarBrand($navs)
    {
        // filter data
        $brand = collection($navs)->filter(
            function ($nav) {
                return isset($nav['brand']);
            }
        )->first();
        // generate brand string
        if (!empty($brand)) {
            // if non empty change brand for text
            $brand['text'] = $brand['brand'];
            unset($brand['brand']);
            list($iconText,$brand) = $this->extractIconText($brand);
            // coatLink and return value
            list($brand) = $this->coatLink(
                $iconText, 
                $brand, 
                ['class'=>"navbar-brand"]
            );
        }
        // return navs without brand
        $navs = collection($navs)->reject(
            function ($nav) {
                return isset($nav['brand']);
            }
        )->toArray();
        return [$brand,$navs];
    }

    protected function navbarList($navs)
    {
        $navs = collection($navs)->map(
            function ($nav) {
                $nav = $this->addClass($nav, "nav-item");
                // extract all the options for icon and text
                list($iconText,$nav) = $this->extractIconText($nav);
                // coat icontext with a link if set
                list($link,$nav) = $this->coatLink(
                    $iconText, 
                    $nav, 
                    ['class'=>"nav-link"] 
                );
                return [$link, $nav];
            }
        );
        return $this->ul($navs, ['class'=>"navbar-nav mr-auto"]);
    }

    /**
     * generate navTabs
     *
     * @param $navTabs
     * @param array $options
     *
     */
    public function navTabs($navTabs, array $options = [])
    {
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
                list($li,$liOptions) = $this->getContentOptions($li);
                $reducer['list'][] = $li;
                $reducer['listOptions'][] = $liOptions;
                return $reducer;
            },
            ['list'=>[],'listOptions'=>[]]
        );

        return $this->nestedList($lis['list'], $options, $lis['listOptions']);
    }
}