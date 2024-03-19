<?php

namespace Junisan\ListmonkApi\API;

use Junisan\ListmonkApi\Models\TransactionalMessageModel;
use Junisan\ListmonkApi\UseCases\Transactional\SendTransactionalMessage;

class ListmonkTransactionalMessageApi
{
    private ListmonkApi $api;

    public function __construct(ListmonkApi $api)
    {
        $this->api = $api;
    }

    public function sendTransactionalMessage(TransactionalMessageModel $transactionalMessage): bool
    {
        $useCase = new SendTransactionalMessage($this->api);

        return $useCase->__invoke($transactionalMessage);
    }
}
