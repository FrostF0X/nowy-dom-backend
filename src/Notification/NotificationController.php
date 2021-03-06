<?php

namespace App\Notification;

use App\Common\Controller\ControllerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JetBrains\PhpStorm\ArrayShape;
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
            return $this->response('Cannot accept value ' . $region, 400);
        }
        $offers = $region ? $this->notifications->getByRegion(NotificationRegion::get($region)) : $this->notifications->getAll();
        return $this->response(NotificationOutput::createMany(...$offers));
    }

    private function response(array|string $res, ?int $status = 200): JsonResponse
    {
        return new JsonResponse(
            $res,
            $status,
            $this->cache()
        );
    }

    #[ArrayShape(['Cloudflare-CDN-Cache-Control' => "string", 'cache-control' => "string"])]
    private function cache(): array
    {
        return ['Cloudflare-CDN-Cache-Control' => 'max-age=60', 'cache-control' => 'public'];
    }

    #[Get('/api/v1/notification/region')]
    public function regions(): JsonResponse
    {
        $res = collect(NotificationRegion::instances())
            ->keyBy(fn(NotificationRegion $region) => $region->getValue())
            ->map(fn(NotificationRegion $region) => $region->getReadable())
            ->all();
        $res = [NotificationRegionAll::VALUE => NotificationRegionAll::READABLE] + $res;
        return $this->response($res);
    }


}
