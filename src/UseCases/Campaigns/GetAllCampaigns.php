<?php

namespace Junisan\ListmonkApi\UseCases\Campaigns;

use Junisan\ListmonkApi\Builders\CampaignBuilder;
use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\PaginatorModel;

class GetAllCampaigns
{
    private ListmonkApi $api;
    private CampaignBuilder $campaignBuilder;

    public function __construct(ListmonkApi $api, CampaignBuilder $campaignBuilder)
    {
        $this->api = $api;
        $this->campaignBuilder = $campaignBuilder;
    }

    public function __invoke(): PaginatorModel
    {
        $data = $this->api->get('/campaigns');
        $campaigns = array_map(fn(array $data) => $this->campaignBuilder->__invoke($data), $data['results']);

        return new PaginatorModel(
            $campaigns,
            $data['total'],
            $data['per_page'],
            $data['page']
        );
    }
}