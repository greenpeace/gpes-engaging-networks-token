<?php

    class EngagingNetworksToken {
        
        function __construct(){
            $this->apiKey = ENGAGING_NETWORKS_API_KEY;
            $this->cacheFolder = CACHE_FOLDER;
            $this->cacheFile = $this->cacheFolder . 'token.txt';
            $this->token = 'Invalid token';
            $this->tokenSource = 'It has the initial value please use getToken()';
        }
        
        /**
         * Checks if the cache is valid.
         * If the cache is valid, gets the token from the cache.
         * If the cache is not valid, gets the token from engaging and updates the token in the cache
         */
        public function getToken() {
            
            if ( $this->isCachedTokenValid() ) {
                $this->getTokenFromCache();
            } else {
                $this->getTokenFromEngaging();
                $this->updateTokenInCache();
            }
                
        }
        
        /**
         * Sends a request to Engaging Networks for a new token value
         */
        private function getTokenFromEngaging() {
            
            	$ch = curl_init();

                // authenticate
                curl_setopt($ch, CURLOPT_URL, 'https://e-activist.com/ens/service/authenticate');
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=UTF-8'
                ));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->apiKey);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            
                $res = curl_exec($ch);
                $err = curl_error($ch);
            
                if($err){
                    throw new Exception('cUrl error: ' . $err);
                }
            
                $json = json_decode($res, true);
            
                if(!array_key_exists('ens-auth-token', $json)){
                    throw new Exception('ENS error: check server IP address and authorization token');
                }
            
                $this->token = $json['ens-auth-token'];            
                $this->tokenSource = 'engaging';
        }
        
        /**
         * Checks if the cache file exists and has less than 5 minutes
         */
        private function isCachedTokenValid () {
            if (file_exists( $this->cacheFile ) && (filemtime( $this->cacheFile ) > (time() - 60 * 5 ))) {
                return true;
            } else {
                return false;
            }
        }
        
        /**
         * Reads the cache file for a new token value
         */
        private function getTokenFromCache() {
            $tokenFile = file_get_contents( $this->cacheFolder . "token.txt");
            $this->token = $tokenFile;
            $this->tokenSource = 'cache';
        }
        
        /**
         * Writes the cache file with the current token value
         */
        private function updateTokenInCache() {
            $file = $this->token;
            file_put_contents( $this->cacheFile , $file, LOCK_EX);
        }
    }

?>