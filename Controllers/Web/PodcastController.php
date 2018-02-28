<?php

namespace App\Controllers\Web;

use App\Core\WebController;
use App\Utilities\ApiUtil;

/*
 * Class Name should match this pattern {Controller Name}Controller
 */

class PodcastController extends WebController
{
    public function Index()
    {
        return $this->redirect('podcast/search/');
    }

    public function Search()
    {
        //set title page
        $this->meta['title'] = 'Search';

        if (isset($_GET['q'])) {
            $url = 'https://api.podcast.de/search.json?q=' . urlencode($_GET['q']) . '&limit=20';
            $api = ApiUtil::curlCall($url);
            if ($api) {
                $this->data['results'] = $api['channels'];
                //Set title
                $this->meta['title'] = $_GET['q'].' · search';
            }
            else {
                return $this->renderFullError('Sorry, podcasts\' API is not available at the moment.', 500);
            }
        }

        return $this->render();
    }

    public function Channel($id)
    {
        $url = 'https://api.podcast.de/channel/' . urlencode($id) . '.json?limit=30';
        $api = ApiUtil::curlCall($url);
        if ($api) {
            if ($api['head'][0]['count'] > 0) {
                $this->data['result'] = $api['channel'];
                //Set title
                $this->meta['title'] =  $api['channel']['title'].' · PodcastR';
                return $this->render();
            } else
                return $this->renderFullError('No Channel with this Id', 404);
        } else {
            return $this->renderFullError('Sorry, podcasts\' API is not available at the moment.', 500);
        }

    }

    public function Episode($id)
    {
        $url = 'https://api.podcast.de/show/' . urlencode($id) . '.json?limit=30';
        $api = ApiUtil::curlCall($url);
        if ($api) {
            if (!empty($api['show'])) {
                $this->data['result'] = $api['show'];
                //Set title
                $this->meta['title'] =  $api['show']['title'].' · PodcastR';
                return $this->render();
            } else
                return $this->renderFullError('No Channel with this Id', 404);
        } else {
            return $this->renderFullError('Sorry, podcasts\' API is not available at the moment.', 500);
        }
    }
}