<?php

namespace App\Offer;


use App\Common\Controller\ControllerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\QueryParam;
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
            $input->email,
            $input->googleMapsLink,
            Region::get($input->region),
            $input->address,
            $input->description,
            $input->phoneNumber,
            $input->persons,
        );
        $this->offers->save($offer);
        return new JsonResponse();
    }

    #[Get('/api/v1/offer')]
    #[QueryParam(name: "region", requirements: "\w+")]
    public function get(?string $region = null): JsonResponse
    {
        if (!Region::accepts($region)) {
            return new JsonResponse('Cannot accept value ' . $region, 404);
        }
        $region = Region::get($region);
        $offers = $region ? $this->offers->findBy(['region' => $region]) : $this->offers->findAll();
        return new JsonResponse(OfferOutput::createMany(...$offers));
    }

}
