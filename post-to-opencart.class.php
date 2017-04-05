<?php

class PostToOpenCart {

	protected $options = null;

	const LOGIN_URL = '/index.php?route=api/login';
	const PUBLISH_URL = '/index.php?route=api/wp_post';

	public function __construct() {
		$this->init();
	}

	/**
	 * Initialize the default options during plugin activation
	 *
	 * @return none
	 * @since 2.0.3
	 */
	protected function init () {
		if ( !($this->options = get_option ( 'post-to-opencart' )) ) {
			$this->options = $this->defaults();
			add_option ( 'post-to-opencart' , $this->options );
		}
		add_action( 'transition_post_status', array( $this, 'on_all_status_transitions'), 10, 3);
	}

	/**
	 * Return the default options
	 *
	 * @return array
	 * @since 2.0.3
	 */
	protected function defaults () {
		return array (
			'post-to-opencart-url' => '',
			'post-to-opencart-key' => '',
		);
	}

	/**
	 * Get specific option from the options table
	 *
	 * @param string $option Name of option to be used as array key for retrieving the specific value
	 * @return mixed
	 * @since 2.0.3
	 */
	public function get_option ( $option , $options = null ) {
		if ( is_null ( $options ) ) {
			$options = &$this->options;
		}
		if ( isset ( $options[$option] ) ) {
			return $options[$option];
		} else {
			return false;
		}
	}

	public function on_all_status_transitions($new_status, $old_status, $post) {
        $openCartUrl = $this->options['post-to-opencart-url'];
        $openCartKey = $this->options['post-to-opencart-key'];
        if (!$openCartUrl || !$openCartKey) {
            return;
        }
        if ($new_status=='publish') {
            $meta = get_post_meta($post->ID, 'push_to_likbet', true);
            if ($meta == 'yes') {
                $res = $this->curl_post($openCartUrl . self::LOGIN_URL, array(
                    'key' => $openCartKey,
                ));
                $response = json_decode($res);
                if ($response->success && $response->token) {
                    $thumb = get_post_meta($post->ID, '_thumbnail_id', true);
                    if ($thumb) {
                        $attachments = wp_get_attachment_metadata($thumb);
                        $post->attachments = $attachments;
                        $post->image_url = wp_get_attachment_url($thumb);
                        $dirs = wp_get_upload_dir();
                        $post->image_base_path =  $dirs['baseurl'] . '/' . _wp_get_attachment_relative_path($attachments['file']) . '/';
                    }
                    $post->permalink = get_the_permalink($post->ID);
                    // send post as array
                    $res = $this->curl_post($openCartUrl . self::PUBLISH_URL . '&token=' . $response->token, array(
                        'post' => base64_encode(serialize((array)$post)),
                    ));
                    //$response = json_decode($res);
                }
            }
        }
	}

    protected function curl_post($url, $params) {
        ob_start();
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL    => $url,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_HEADER => false,
                CURLOPT_COOKIEFILE => __DIR__. '/cookies',
                CURLOPT_COOKIEJAR => __DIR__. '/cookies',
            ]
        );
        curl_exec($ch);
        curl_close($ch);
        $content = ob_get_clean();

        return $content;
    }

}

function _var_dump($var)
{
    ob_start();
    print_r($var);
    $v = ob_get_contents();
    ob_end_clean();
    return $v.PHP_EOL;
}

function flog($var)
{
    file_put_contents(__DIR__ . '/log.txt', '+---+ '.date( 'H:i:s d-m-Y' ).' +-----+'.PHP_EOL._var_dump($var).PHP_EOL, FILE_APPEND);
}
