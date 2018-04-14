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

    protected $buttonModels = [
        // colors
        'primary' => ['color'=>"primary"],
        'secondary' => ['color'=>"secondary"],
        'success' => ['color'=>"success"],
        'danger' => ['color'=>"danger"],
        'warning' => ['color'=>"warning"],
        'info' => ['color'=>"info"],
        'light' => ['color'=>"light"],
        'dark' => ['color'=>"dark"],
        'link' => ['color'=>"link"],
        // crud
        'create' =>['icon'=>"plus",'text'=>"Ajouter",'button'=>"success"],
        'read' => ['icon'=> "eye",'text' => "Detail","color"=>"info"],
        'update' => ['icon' => "pencil","text"=>"Modifier",'button'=>"warning"],
        'delete' => ['icon'=>"times","text"=>"Supprimer","button"=>"danger"],
        // alias
        'add' => "create",
        'edit' => "update",
        'view' => "read"
    ];

    public function button($button = false, array $options = [])
    {
        // if personnalized button
        if(is_array($button)){
            $options = $button;
            $options += ['button' => false];
        } else {
            $options += ['button' => $button];
        }

        // on boucle sur les options tant que l'on rencontre une cle bouton dans options
        while($options['button']){
            $button = $options['button'];
            unset($options['button']);

            if(is_string($this->buttonModels[$button])){
                $options['button'] = $this->buttonModels[$button];
            } else {
                $options += $this->buttonModels[$button];
                // remplace button false if not set else the defined button is used
                $options += ['button' => false];
            }
        }
        unset($options['button']);

        $options += [
            'icon' => false,
            'text' => "button",
            'color' => false,
            'isOutline' => false,
            // possible input
            //'title' => false
            //'class' => false
        ];

        // title
        $options += ['title' => $options['text']];

        // convert icon and text
        list($iconText,$options) = $this->extractIconText($options);

        // class concat
        $class = "btn";
        if($options['color']){
            $class .= " btn-";
            // outline
            if($options['isOutline']){
                $class .= "outline-";
            }
            unset($options['isOutline']);
            // color
            $class .= $options['color'];
            unset($options['color']);
            // end class concat
        }


        $options = $this->addClass($options, $class);

        list($buttonContent,$options) = $this->coatLink($iconText,$options,$options);

        // si pas de lien alors on genere un bouton simple .. a charge de l'appelant d'en generer un input
        if($buttonContent === $iconText)
        {
            $options += [
                'type' => "button"
            ];

            $buttonContent = $this->tag('button',$iconText,$options);
        }

        return $buttonContent;
    }

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
        //debug($content);debug($options);debug($injectLinkOptions);
        $options += [
            'isActive' => false,
            'isDisabled' => false,
            'link' => "#",
        ];

        if ($options['link']) {
            // take the link 
            list($linkContent,$linkOptions) = $this->getContentOptions($options['link']);

            // is active ?
            if($options['isActive']){
                $injectLinkOptions = $this->addClass($injectLinkOptions, 'active');
            }
            unset($options['isActive']);

            // disabled link
            if($options['isDisabled']){
                $injectLinkOptions = $this->addClass($injectLinkOptions,"disabled");
            }
            unset($options['isDisabled']);

            $content = $this->link(
                $content, 
                $linkContent, 
                $linkOptions + $injectLinkOptions + ['escape' => false]
            );
        };
        unset($options['link']);

        return [$content,$options];
    }


    /**
     *
     *
     * <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
     * data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown link
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div>
     *
     * @param $dropdown
     * @param array $options
     */
    public function dropdown($dropdown, array $options = []){
        $dropdown += [
            'button' => false,
            'menu' => false,
            'role' => "button",
            'data-toggle' => "dropdown",
        ];

        $options += [
            'isCoatDiv' => true
        ];

        // add class dropdown specific
        $dropdown = $this->addClass($dropdown,"dropdown-toggle");

        $menu = false;
        // generate menu
        if($dropdown['menu']){
            $menu = $this->dropdownMenu($dropdown['menu'],['class'=>"dropdown-menu"]);
        }
        unset($dropdown['menu']);

        // generate button
        $button = $this->button($dropdown);

        $content = $button.$menu;
        if($options['isCoatDiv']){
            unset($options['isCoatDiv']);
            $content = $this->div("dropdown show", $content, $options);
        }

        return $content;
    }

    public function dropdownMenu($menus, array $options = [])
    {
        $list = collection($menus)->map(function ($menu) {
            list($iconText, $menu) = $this->extractIconText($menu);

            if($iconText==="-"){
                $content = $this->div('dropdown-divider',"");
            } else {
                $link = $this->addClass([],'dropdown-item');
                list($content, $menu) = $this->coatLink($iconText, $menu, $link);
            }

            return $content;
        });

        return $this->tag('div', implode($list->toArray()), $options);
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

    public function icon($icon,array $options = []){
        $options += [
            'tag' => "i",
            'callback' => [$this,'iconFa']
        ];

        $callback = $options['callback'];
        unset($options['callback']);
        $tag = $options['tag'];
        unset($options['tag']);

        $options = call_user_func($callback,$icon,$options);

        return $this->tag($tag,"",$options);
    }

    public function iconFa($icon,array $options = []){
        $options += [
            'type' => "solid", // solid, regular, brand
            'prefix' => "fa",
        ];

        $class = $options['prefix'].substr($options['type'],0,1)." ".$options['prefix']."-".$icon;
        unset($options['prefix']);
        unset($options['type']);

        return compact('class');

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
        unset($options['expand']);

        // brand
        list($navBrand,$navs) = $this->navbarBrand($navs);

        // nav collapse button

        // nav list  > ul/li
        $navList = $this->navbarList($navs);
        $navHtml = $navBrand.$navList;

        unset($options['hasToggle']);
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
            //debug($brand);

            // if non empty change brand for text
            $brand['text'] = $brand['brand'];
            unset($brand['brand']);

            list($iconText,$brand) = $this->extractIconText($brand);
            //debug($brand);

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
                $nav += [
                    'menu' => false,
                ];

                if($nav['menu']){
                    $nav = $this->addClass($nav, 'nav-link');
                    $content = $this->dropdown($nav,['isCoatDiv'=>false]);
                    // add class of item after dropdown generation
                    $nav = ['class' => "nav-item dropdown"];
                } else {
                    $nav = $this->addClass($nav, 'nav-item');

                    // extract all the options for icon and text
                    list($iconText, $nav) = $this->extractIconText($nav);

                    $navLinkOptions = [
                        'class' => "nav-link"
                    ];

                    // coat icontext with a link if set
                    list($content, $nav) = $this->coatLink(
                        $iconText,
                        $nav,
                        $navLinkOptions
                    );
                    unset($nav['menu']);
                }

                return [$content, $nav];
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
     * nesttedList isnt cool enough
     *
     *
     * @return string html
     */
    public function ul(Collection $list,array $options = [])
    {
        $options += [
            'tag' => "ul" // could be ol
        ];

        $content = $list->map(function($li){
            list($li,$liOptions) = $this->getContentOptions($li);
            return $this->tag('li',$li,$liOptions);
        });

        return $this->tag($options['tag'], implode(PHP_EOL,$content->toArray()), $options);
    }
}