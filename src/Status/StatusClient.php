<?php namespace DCarbone\PHPConsulAPI\Status;

/*
   Copyright 2016 Daniel Carbone (daniel.p.carbone@gmail.com)

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

use DCarbone\PHPConsulAPI\AbstractConsulClient;
use DCarbone\PHPConsulAPI\QueryOptions;
use DCarbone\PHPConsulAPI\Request;

/**
 * Class StatusClient
 * @package DCarbone\PHPConsulAPI\Status
 */
class StatusClient extends AbstractConsulClient
{
    /**
     * @return array(
     *  @type string
     *  @type \DCarbone\PHPConsulAPI\Error|null error, if any
     * )
     */
    public function leader()
    {
        $r = new Request('get', 'v1/status/leader', $this->_Config);
        list($_, $response, $err) = $this->requireOK($this->doRequest($r));

        if (null !== $err)
            return ['', $err];

        return $this->decodeBody($response);
    }

    /**
     * @param QueryOptions|null $queryOptions
     * @return array|null
     */
    public function peers(QueryOptions $queryOptions = null)
    {
        $r = new Request('get', 'v1/status/peers', $this->_Config);
        list($_, $response, $err) = $this->requireOK($this->doRequest($r));

        if (null !== $err)
            return [null, $err];

        return $this->decodeBody($response);
    }
}