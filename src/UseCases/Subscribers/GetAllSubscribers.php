<?php

namespace Junisan\ListmonkApi\UseCases\Subscribers;

use Junisan\ListmonkApi\Builders\SubscriberBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\PaginatorModel;

class GetAllSubscribers
{
    private ListmonkApi $api;
    private SubscriberBuilder $subscriberBuilder;

    public function __construct(ListmonkApi $api, SubscriberBuilder $subscriberBuilder)
    {
        $this->api = $api;
        $this->subscriberBuilder = $subscriberBuilder;
    }

    public function __invoke(?int $page = 1, ?int $perPage = 100, ?string $query = null): PaginatorModel
    {
        $params = [];
        if (null !== $page) {
            $params['page'] = $page;
        }
        if (null !== $perPage) {
            $params['per_page'] = $perPage;
        }
        if (null !== $query) {
            $params['query'] = $query;
        }

        $data = $this->api->get('/subscribers?' . http_build_query($params));
        $subscribers = array_map(fn(array $data) => $this->subscriberBuilder->__invoke($data), $data['results']);

        return new PaginatorModel(
            $subscribers,
            $data['total'],
            $data['per_page'],
            $data['page']
        );
    }
}
