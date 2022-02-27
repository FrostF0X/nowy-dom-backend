<?php

namespace App\Notification;

use App\Common\Controller\ControllerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpFoundation\JsonResponse;

class NotificationController implements ControllerInterface
{

    public function __construct(public NotificationRepository $notifications)
    {
    }

    #[Get('/api/v1/notification')]
    #[QueryParam(name: "region", requirements: "\w+")]
    public function notifications(?string $region = null): JsonResponse
    {
        if ($region === NotificationRegionAll::VALUE) {
            $region = null;
        }
        if ($region && !NotificationRegion::accepts($region)) {
            return new JsonResponse('Cannot accept value ' . $region, 400);
        }
        $offers = $region ? $this->notifications->findBy(['region' => NotificationRegion::get($region)]) : $this->notifications->findAll();
        return new JsonResponse(NotificationOutput::createMany(...$offers));
    }

    #[Get('/api/v1/notification/regions')]
    public function regions(): JsonResponse
    {
        return new JsonResponse(
            collect(NotificationRegion::instances())
                ->keyBy(fn(NotificationRegion $region) => $region->getValue())
                ->map(fn(NotificationRegion $region) => $region->getReadable())
                ->all()
        );
    }


}
