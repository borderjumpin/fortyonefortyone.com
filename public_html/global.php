<?php

class Site
{
    public static function getInfoPages()
    {
        return array(
            'hours',
            'contact',
            'events',
            'catering',
            'private',
            'biographies',
        );
    }

    public static function getAllPages()
    {
        $allPages[] = 'menu';
        $allPages = array_merge($allPages, self::getInfoPages());
        return $allPages;
    }
}

abstract class SubPage
{
    public $header;
    public $content;
    public $name;

    function __construct()
    {
        $this->header = $this->getHeader();
        $this->content = $this->content();
    }

    function display()
    {
        echo $this->header;
        echo $this->content;
    }

    public function getHeader()
    {
        return "<a id='$this->name'>&nbsp;</a><br />";
    }

    //abstract methods

    abstract function content();
}

class InfoPage extends SubPage
{
    public function __construct($name)
    {
        $this->name = $name;
        parent::__construct();
    }

    public function content()
    {
        return "<div class='sectionContent'>$this->name</div>";
    }
}

class Menu extends SubPage
{
    public function __construct()
    {
        $this->name = 'menu';
        parent::__construct();
    }

    public function content()
    {
        return "<div class='sectionContent'>menu
        </div>";
    }
}

class Home extends SubPage
{
    public function __construct()
    {
        $this->name = 'home';
        parent::__construct();
    }

    public function content()
    {
        return "<div class='sectionContent'>home</div>";
    }
}

class Nav
{
    public static function displayNavList($isLeftColumn = true)
    {
        foreach(Site::getAllPages() as $page) {
            echo "<li><h2><a id='" . $page . "Link' href='#" . $page . "Link'" .
                ($isLeftColumn ? 'class="leftNavLink"' :
                    'data-toggle="collapse" data-target=".navbar-collapse"') .
                ">" . ucfirst($page) .
                "</a></h2></li>";
        }
    }

    public static function getMainLogo($isLeftColumn = true)
    {
        echo "<a id='homeLink' class='pull-left" . ($isLeftColumn ? '' : ' navbar-brand') .
            "' " . ($isLeftColumn ? '' : 'data-toggle="collapse" data-target=".navbar-collapse"') . " href='#'><h1 class='logo'>
                    <span class='logoLeft'>Fortyone</span><span class='logoRight'>Fortyone</span>
                    </h1></a>";
    }
}