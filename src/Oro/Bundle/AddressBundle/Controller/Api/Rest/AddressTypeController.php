<?php

namespace Oro\Bundle\AddressBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Oro\Bundle\AddressBundle\Entity\AddressType;
use Symfony\Component\HttpFoundation\Response;

/**
 * @RouteResource("addresstype")
 * @NamePrefix("oro_api_")
 */
class AddressTypeController extends FOSRestController implements ClassResourceInterface
{
    /**
     * REST GET list
     *
     * @ApiDoc(
     *      description="Get all address types items",
     *      resource=true
     * )
     * @return Response
     */
    public function cgetAction()
    {
        $items = $this->getDoctrine()->getRepository('OroAddressBundle:AddressType')->findAll();

        return $this->handleView(
            $this->view($items, is_array($items) ? Codes::HTTP_OK : Codes::HTTP_NOT_FOUND)
        );
    }

    /**
     * REST GET item
     *
     * @param string $name
     *
     * @ApiDoc(
     *      description="Get address type item",
     *      resource=true
     * )
     * @return Response
     */
    public function getAction($name)
    {
        if (!$name) {
            return $this->handleView($this->view(null, Codes::HTTP_NOT_FOUND));
        }

        /** @var $item AddressType */
        $item = $this->getDoctrine()->getRepository('OroAddressBundle:AddressType')->find($name);

        return $this->handleView(
            $this->view($item, is_object($item) ? Codes::HTTP_OK : Codes::HTTP_NOT_FOUND)
        );
    }
}
