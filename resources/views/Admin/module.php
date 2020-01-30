<?php

include_once dirname(__FILE__)."/../lib/table.php";
include_once dirname(__FILE__)."/../lib/form.php";
include_once dirname(__FILE__)."/../lib/lang.php";
include_once dirname(__FILE__)."/../lib/resolve.php";

class Module {
    private $title;
    private $group;
    private $visible;
    private $login;
    private $menu;
    private $errorMessage;
    private $printMode = false;
    private $invoiceMode = false;
    protected $urfa;

    function init($title='Unknown',$group='Default',$visible = false,$login = false) {
        $this->title = str_replace(' ', '&nbsp;', $title);
        $this->group = $group;
        $this->visible = $visible;
        $this->login = $login;
    }

    function writeBody() {
    }

    function setPrintMode($mode){
        $this->printMode=$mode;
    }

    function setInvoiceMode($mode){
        $this->invoiceMode=$mode;
    }

    function loadMenu() {
        global $MOD_TITLE,$MOD_GROUP,$MOD_VISIBLE;
        $this->menu = array();
        $dir = dir(dirname(__FILE__)."/../modules");

        $fileArray = array();

        while(false !== ($file = $dir->read())) {
            $fileArray[] = $file;
        }
        sort($fileArray);
        foreach ($fileArray as $file) {
            if(preg_match("/^([a-z0-9_]+)\.php$/",$file,$out)) {
                include dirname(__FILE__)."/../modules/".$file;
                if(!$MOD_VISIBLE)
                    continue;

                if($MOD_LOGIN != $this->login)
                    continue;

                if($MOD_LOGIN != true && isset($_COOKIE['system']) && $_COOKIE['system'] > 0)
                    if($MOD_SYSTEM != $_COOKIE['system'])
                        continue;


                $this->menu[$MOD_GROUP][$out[1]] = $MOD_TITLE;
            }
        }
    }

    function writeHtml() {
        global $CONF_PATH;
        global $CONF_LANG;
        $this->loadMenu();
        if($this->invoiceMode == false){
?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                <!-- main UTM5 web stylesheet -->
                <link rel="stylesheet" type="text/css" href="<?=$CONF_PATH?>utm.css">

                <!-- calendar-specific scripts -->
                <link rel="stylesheet" type="text/css" href="<?=$CONF_PATH?>lib/jscalendar/calendar-blue.css">
                <script type="text/javascript" src="<?=$CONF_PATH?>lib/jscalendar/calendar.js"></script>
                <script type="text/javascript" src="<?=$CONF_PATH?>lib/jscalendar/lang/calendar-<?=$CONF_LANG?>-UTF.js"></script>
                <script type="text/javascript" src="<?=$CONF_PATH?>lib/jscalendar/calendar-setup.js"></script>
                <script type="text/javascript" src="<?=$CONF_PATH?>lib/filter/filterlist.js"></script>
                <script type="text/javascript" src="<?=$CONF_PATH?>lib/js/jquery-1.9.1.min.js"></script>


                <title>UTM: <?=langGet($this->title)?></title>
            </head>
            <body class="body">
<?          if($this->printMode == false){?>
                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="menu-area">
<?
                        foreach($this->menu as $group => $items) {
                            if($group == $this->group)
                                echo "<div class='mainmenu-act'>".langGet($group)."</div>\n";
                            else {
                                $module = key($items);
                                echo "<div class='mainmenu-inact'><a href='".$CONF_PATH."?module=".$module."'>".langGet($group)."</a></div>\n";
                            }
                        }
?>
                        </td>
                        <td class="work-area">
                            <table width="100%"><tr><td class="submenu-area">
<?
                        foreach($this->menu[$this->group] as $module => $title){
                            $title_lang = str_replace(' ', '&nbsp;', langGet($title));
                            if($title == $this->title)
                                echo "<span class='submenu-act'>".$title_lang."</span>\n";
                            else
                                echo "<span class='submenu-inact'><a href='".$CONF_PATH."?module=".$module."'>".$title_lang."</a></span>\n";
                        }
?>
                            </td></tr></table>
<?
                        global $MOD_SUBMENU;
                        if($MOD_SUBMENU != true){
                            echo('<br>');
                        }

                            if($this->errorMessage) {
                                echo "<p style='color:red'>".$this->errorMessage."</p>\n";
                            }
                            $this->writeBody();
?>
                        </td>
                    </tr>
                </table>
<?          } else {
                $this->writeBody();
          } ?>
            </body>
        </html>
<?    } else {
          header("Content-Type: text/html; charset=utf-8");
          $this->writeBody();
      }
    }

    function setUrfa($urfa) {
        $this->urfa = $urfa;
    }

    function addErrorMessage($msg) {
        $this->errorMessage = $msg;
    }

}
?>

