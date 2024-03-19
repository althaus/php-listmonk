<?php

namespace Junisan\ListmonkApi\UseCases\Transactional;

use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\TransactionalMessageModel;

class SendTransactionalMessage
{
    private ListmonkApi $api;
    public function __construct(ListmonkApi $api)
    {
        $this->api = $api;
    }

    public function __invoke(TransactionalMessageModel $messageModel): bool
    {
        $data = [
            'subscriber_email' => $messageModel->getSubscriberEmail(),
            'subscriber_id' => $messageModel->getSubscriberId(),
            'subscriber_emails' => $messageModel->getSubscriberEmails(),
            'subscriber_ids' => $messageModel->getSubscriberIds(),
            'template_id' => $messageModel->getTemplateId(),
            'from_email' => $messageModel->getFromEmail(),
            'data' => $messageModel->getData(),
            'headers' => $messageModel->getHeaders(),
            'messenger' => 'email', // not implemented yet
            'content_type' => $messageModel->getContentType(),
        ];

        $dataResponse = $this->api->post('/api/tx', $data);

        return true === $dataResponse;
    }
}
