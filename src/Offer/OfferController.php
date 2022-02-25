<?php

namespace App\Offer;


use App\Common\Controller\ControllerInterface;
use FOS\RestBundle\Controller\Annotations\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

class OfferController implements ControllerInterface
{
    public function __construct(private OfferRepository $offers)
    {
    }

    #[ParamConverter("input", class: OfferInput::class, converter: "fos_rest.request_body")]
    #[Post('/api/v1/offer')]
    public function add(OfferInput $input): JsonResponse
    {
        $offer = new Offer(
            Region::get($input->region),
            $input->address,
            $input->description,
            $input->phoneNumber,
            $input->persons
        );
        $this->offers->save($offer);
        return new JsonResponse();
    }

}
