<?php

namespace Junisan\ListmonkApi\Models;

class TransactionalMessageModel
{
    // Template data
    private int $templateId;
    /** @var array<string, mixed> */
    private array $data = [];
    private ?string $fromEmail = null;
    /** @var list<string> */
    private array $headers = [];
    /** @var 'html'|'markdown'|'plain'|null */
    private ?string $contentType = null;

    // Subscriber data
    private ?string $subscriberEmail = null;
    private ?int $subscriberId = null;
    /** @var list<string>|null */
    private ?array $subscriberEmails = null;
    /** @var list<int>|null */
    private ?array $subscriberIds = null;

    public function __construct(int $templateId)
    {
        $this->templateId = $templateId;
    }

    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    public function setTemplateId(int $templateId): self
    {
        $this->templateId = $templateId;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(?string $fromEmail): self
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(?string $contentType): self
    {
        $availableContentTypes = ['html', 'markdown', 'plain'];
        if (!in_array($contentType, $availableContentTypes, true)) {
            throw new \LogicException('Invalid campaign content type');
        }


        $this->contentType = $contentType;

        return $this;
    }

    public function getSubscriberEmail(): ?string
    {
        return $this->subscriberEmail;
    }

    public function setSubscriberEmail(?string $subscriberEmail): self
    {
        $this->subscriberEmail = $subscriberEmail;

        return $this;
    }

    public function getSubscriberId(): ?int
    {
        return $this->subscriberId;
    }

    public function setSubscriberId(?int $subscriberId): self
    {
        $this->subscriberId = $subscriberId;

        return $this;
    }

    public function getSubscriberEmails(): ?array
    {
        return $this->subscriberEmails;
    }

    public function setSubscriberEmails(?array $subscriberEmails): self
    {
        $this->subscriberEmails = $subscriberEmails;

        return $this;
    }

    public function getSubscriberIds(): ?array
    {
        return $this->subscriberIds;
    }

    public function setSubscriberIds(?array $subscriberIds): self
    {
        $this->subscriberIds = $subscriberIds;

        return $this;
    }
}
