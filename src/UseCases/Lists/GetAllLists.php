<?php

namespace Junisan\ListmonkApi\UseCases\Lists;

use Junisan\ListmonkApi\Builders\ListBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\PaginatorModel;

class GetAllLists
{
    private ListmonkApi $api;
    private ListBuilder $listBuilder;

    public function __construct(ListmonkApi $api, ListBuilder $listBuilder)
    {
        $this->api = $api;
        $this->listBuilder = $listBuilder;
    }

    public function __invoke(): PaginatorModel
    {
        $data = $this->api->get('/lists');
        $lists = array_map(fn(array $data) => $this->listBuilder->__invoke($data), $data['results']);

        return new PaginatorModel(
            $lists,
            $data['total'],
            $data['per_page'],
            $data['page']
        );
    }
}