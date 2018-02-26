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
            $api = ApiUtil::curlCall($_GET['q']);
            if($api['head'][0]['count'] > 0){
                $this->data['results'] = $api['channels'];
            }

        }
        return $this->render();
    }

}