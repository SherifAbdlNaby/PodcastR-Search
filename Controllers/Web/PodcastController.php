<?php
namespace App\Controllers\Web;

use App\Core\WebController;
use App\Utilities\ApiUtil;

/*
 * Class Name should match this pattern {Controller Name}Controller
 */

class PodcastController extends WebController {
    public function Index(){
        return $this->render();
    }

    public function Search(){
        if(isset($_GET['q'])){
            $url = 'https://api.podcast.de/search.json?q='.urlencode($_GET['q']).'&limit=20';
            $api = ApiUtil::curlCall($url);
            if($api['head'][0]['count'] > 0){
                $this->data['results'] = $api['channels'];
            }

        }
        return $this->render();
    }

    public function Channel($id)
    {
        $url = 'https://api.podcast.de/channel/'.urlencode($id).'.json?limit=30';
        $api = ApiUtil::curlCall($url);
        if($api['head'][0]['count'] > 0){
            $this->data['result'] = $api['channel'];
            return $this->render();
        }
        else
            return $this->renderFullError('No Channel with this Id', 404);
    }
}