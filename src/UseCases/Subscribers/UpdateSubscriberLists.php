<?php

declare(strict_types=1);

namespace Junisan\ListmonkApi\UseCases\Subscribers;

use Junisan\ListmonkApi\API\ListmonkApi;
use Junisan\ListmonkApi\Models\ListModel;
use Junisan\ListmonkApi\Models\SubscriberModel;

class UpdateSubscriberLists
{
    private ListmonkApi $api;

    public function __construct(ListmonkApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param array<int|SubscriberModel> $subscribers
     * @param array<int|ListModel> $lists
     */
    public function __invoke(array $subscribers, string $action, array $lists, ?string $status = null): bool
    {
        $availableActions = ['add', 'remove', 'unsubscribe'];
        if (!in_array($action, $availableActions, true)) {
            throw new \LogicException('Invalid action');
        }

        $availableStatus = [null, 'confirmed', 'unconfirmed', 'unsubscribed'];
        if (!in_array($status, $availableStatus, true)) {
            throw new \LogicException('Invalid status');
        }

        $data = [
            'ids' => array_map(static fn (int|SubscriberModel $subscriber): int => is_int($subscriber) ? $subscriber : $subscriber->getId(), $subscribers),
            'action' => $action,
            'target_list_ids' => array_map(static fn (int|ListModel $list): int => is_int($list) ? $list : $list->getId(), $lists),
        ];

        if ('add' === $action) {
            if (null === $status) {
                throw new \LogicException('Status required for add action');
            }

            $data['status'] = $status;
        }

        $dataResponse = $this->api->put('/subscribers/lists', $data);

        return $dataResponse === true;
    }
}
