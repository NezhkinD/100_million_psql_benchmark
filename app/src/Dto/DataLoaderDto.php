<?php

namespace App\Dto;

class DataLoaderDto
{
    /**
     * @var LogDto[]
     */
    private array $logDtos;

    /**
     * @param LogDto[] $logDtos
     * @return $this
     */
    public function fromFields(array $logDtos): self
    {
        $self = new self();
        $self->logDtos = $logDtos;

        return $self;
    }

    /**
     * @return LogDto[]
     */
    public function getLogDtos(): array
    {
        return $this->logDtos;
    }

    /**
     * @param array $logDtos
     * @return self
     */
    public function setLogDtos(array $logDtos): self
    {
        $this->logDtos = $logDtos;
        return $this;
    }

    public function addLogDtos(LogDto $logDto): self
    {
        $lastLogDto = $this->getLast();
        if ($lastLogDto === null) {
            $this->logDtos[] = $logDto;
            return $this;
        }




        return $this;
    }

    private function getLast(): ?LogDto
    {
        if (empty($this->logDtos)) {
            return null;
        }

        $count = count($this->logDtos);
        if ($count === 1) {
            return $this->logDtos[0];
        }

        return $this->logDtos[$count - 1];
    }
}