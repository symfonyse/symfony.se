<?php

require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppCache extends HttpCache
{
    protected function getOptions()
    {
        return array(
            'debug'                  => true,
            'default_ttl'            => 0,
            'private_headers'        => array('Authorization', 'Cookie'),
            'allow_reload'           => false,
            'allow_revalidate'       => false,
            'stale_while_revalidate' => 2,
            'stale_if_error'         => 60,
        );
    }

    /**
     * Invalidate cache
     *
     * @param Request $request
     * @param Boolean $catch   Whether to process exceptions
     *
     * @return Response
     */
    protected function invalidate(Request $request, $catch = false)
    {
        if ($_SERVER['SERVER_ADDR'] !== $request->getClientIp() || 'PURGE' !== $request->getMethod()) {
            return parent::invalidate($request, $catch);
        }

        /**
         * Assert: This is a HTTP PURGE method from this web server
         */
        $response = new Response();
        if (!$this->getStore()->purge($request->getUri())) {
            $response->setStatusCode(404, 'Not purged');
        } else {
            $response->setStatusCode(200, 'Purged');
        }

        return $response;
    }
}
