<?php

/**
 * Need to comment to team about this header.
 * This is used for show the twitter messages correctly.
 * Should put this on main file?
 */
//header('Content-type: text/html; charset=utf-8');

/**
 * Class for get twitter messages about a word or hashtag
 */
class tweet {

    private $avatar = Array();
    private $author = Array();    
    private $user = Array();        
    private $text = Array();
    private $creation_data = Array();
    private $followers = Array();    
    private $tweet_length = 0;
    //To configure this parameters you should see in twitter official API.
    //https://dev.twitter.com/docs/api/1.1/get/search/tweets
    public $number_of_tweets = 10;
    public $type = recent;

    /**
     * @var type 
     * WORD
     * You can add new words separated with comma. Don't insert spaces.
     * Example: 'samsung,i9000' returns tweets with the words samsung and i9000 in the same tweet.* 
     */
    public $word = 'Samsung,Galaxy,5';

    /**
     *
     * @var type 
     * GEOLOCATION
     * 1st parameter is the latitude, 2nd parameter longitude, and 3st parameter is the radius to search.
     * Don't insert any space or this break and give an error.
     * Example: '38.7638871,-0.6154291,100km'
     * If you will activate this function replace the value null with you values.
     * You can view coordinates of a location on this web: http://www.gpsvisualizer.com/geocode.
     */
    public $geolocation = null;

    function __construct() {
        $this->call();
    }

    function twitter() {
        // GITHUB: https://github.com/J7mbo/twitter-api-php
        //EXPLANATION: http://www.italoestrada.com/2013/06/como-utilizar-la-api-version-11-de.html
        ini_set('display_errors', 1);
        require_once('modules/twitter/TwitterAPIExchange.php');

        /** Set access tokens here - see: https://dev.twitter.com/apps/ * */
        $settings = array(
            'oauth_access_token' => "327996947-kVr1U2K3KlgCp7BxxlGKJ6RkZWlSGoACxtRmOiyp",
            'oauth_access_token_secret' => "3leKlwpAlU0wsH8ofM8LqsjSuabei2BadB413YDaF7kLk",
            'consumer_key' => "qg7KTiXTo7q1eUnTOlRjA",
            'consumer_secret' => "1GMsN4NeUsgYPC2qtF5iLweYULA5P7OrDljqkVWMZE"
        );

        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $requestMethod = 'GET';
        $getfield = '?q=' . $this->word . '&count=' . $this->number_of_tweets . '&lang=' .$GLOBALS['language'] . '&result_type=' . $this->type . '&geocode=' . $this->geolocation . '';
        $twitter = new TwitterAPIExchange($settings);
        //echo $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
        $result = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());
        return $result;
    }

    function call() {
            foreach ($this->twitter()->statuses as $key => $data) {
                $this->setAvatar($data->user->profile_image_url);
                $this->setAuthor($data->user->name);                
                $this->setUser($data->user->screen_name);                                
                $this->setText($data->text);
                $this->setCreation_data($data->created_at);
                $this->setFollowers($data->user->followers_count);                
                if ($data->text) {
                    $this->setTweet_length($this->getTweet_length() + 1);
                }
            }
        //print_r($this->author);
    }
    /**
     * 
     * GETTERS & SETTERS
     * 
    **/

    //Number of tweets
    function setTweet_length($n) {
        $this->tweet_length = $n;
    }

    function getTweet_length() {
        return $this->tweet_length;
    }

    //Avatar
    function setAvatar($avatar) {
        array_push($this->avatar, $avatar);
    }

    function getAvatar() {
        return $this->avatar;
    }
    
    //Followers
    function setFollowers($followers) {
        array_push($this->followers, $followers);
    }

    function getFollowers() {
        return $this->followers;
    }    
    //Author
    function setAuthor($author) {
        array_push($this->author, $author);
    }

    function getAuthor() {
        return $this->author;
    }
    
    //User name
    function setUser($user) {
        array_push($this->user, $user);
    }

    function getUser() {
        return $this->user;
    }
    
    //Tweet
    function setText($text) {
        array_push($this->text, $text);
    }

    function getText() {
        return $this->text;
    }

    //Data creation of tweet
    function setCreation_data($data) {
        array_push($this->creation_data, $data);
    }

    /**
     *
     * Return an array of tweets data creation. 
     */
    function getCreation_data() {
        return $this->creation_data;
    }

}
?>

