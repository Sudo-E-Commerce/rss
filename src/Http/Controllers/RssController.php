<?php

namespace Sudo\Rss\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facade as Debugbar;
use Sudo\Rss\Helpers\Rss;

class RssController extends Controller
{
    public function index() {
        Debugbar::disable();
        $domain = config('SudoRss.domain');
        $title = config('SudoRss.title');
        $generator = config('SudoRss.generator');
        $rss = new Rss($title,$domain,$generator);

        foreach (config('SudoRss.rss') as $value) {
            $data = new $value['model'];
            $data = $data->where('status',1)->orderBy('created_at','DESC')->limit($value['limit'])->get();
            $name_field = $value['name_field'];
            $summary_field = $value['summary_field'];
            foreach($data as $v) {
                $name = $v->$name_field;
                $url = $v->getUrl();
                $image = $v->getImage();
                $summary = cutString(removeHTML($v->$summary_field),175);
                $description = '<div align="center">
                                 <a href="'.$url.'">
                                    <img width="200" src="'.$image.'" />
                                 </a>
                              </div>
                              <br />'.$summary;
                $rss->additem($name,$description,$url,$url,date(DATE_RSS, strtotime($v->created_at)));
            }
        }
        header ("Content-Type:text/xml");
        echo $rss->getRSSContent();
    }
}
