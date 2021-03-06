<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware.Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\Tests\OAuth\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\EventbriteResourceOwner;

class EventbriteResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected $userResponse = <<<json
{
    "user": {
        "user_id": "1",
        "first_name": "bar",
        "last_name": "foo"
    }
}
json;

    protected $paths = array(
        'identifier' => 'user.user_id',
        'nickname'   => 'user.first_name',
        'realname'   => array('user.first_name', 'user.last_name'),
        'email'      => 'email',
    );

    protected function setUpResourceOwner($name, $httpUtils, array $options)
    {
        $options = array_merge(
            array(
                'authorization_url' => 'https://www.eventbrite.com/oauth/authorize',
                'access_token_url'  => 'https://www.eventbrite.com/oauth/token',
                'infos_url'         => 'https://www.eventbrite.com/json/user_get',
            ),
            $options
        );

        return new EventbriteResourceOwner($this->buzzClient, $httpUtils, $options, $name, $this->storage);
    }
}
