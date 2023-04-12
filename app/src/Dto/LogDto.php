<?php

namespace App\Dto;

use DateTimeInterface;

class LogDto
{
    /**
     * Название задачи
     * @var string
     */
    private string $taskName;

    /**
     * Время начала
     * @var DateTimeInterface
     */
    private DateTimeInterface $startTime;

    /**
     * Затраченная память
     * @var float
     */
    private float $memoryInMb;

    /**
     * Затраченное время
     * @var int
     */
    private int $spendTimeInSec;

    public static function fromFields(
        string            $taskName,
        DateTimeInterface $startTime,
        float             $memory,
        int               $spendTime
    ): self
    {
        return self::fromPrivateFields(
            $taskName,
            $startTime,
            $memory,
            $spendTime
        );
    }

    public static function fromPrevious(
        string $taskName,
        LogDto $previousLogDto
    ): self
    {
        return self::fromPrivateFields(
            $taskName,
            new \DateTime(),
            $previousLogDto->getMemoryInMb() - memory_get_usage() / 1048576,

        );
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartTime(): DateTimeInterface
    {
        return $this->startTime;
    }

    /**
     * @param DateTimeInterface $startTime
     * @return self
     */
    public function setStartTime(DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return float
     */
    public function getMemoryInMb(): float
    {
        return $this->memoryInMb;
    }

    /**
     * @param float $memoryInMb
     * @return self
     */
    public function setMemoryInMb(float $memoryInMb): self
    {
        $this->memoryInMb = $memoryInMb;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpendTimeInSec(): int
    {
        return $this->spendTimeInSec;
    }

    /**
     * @param int $spendTimeInSec
     * @return self
     */
    public function setSpendTimeInSec(int $spendTimeInSec): self
    {
        $this->spendTimeInSec = $spendTimeInSec;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaskName(): string
    {
        return $this->taskName;
    }

    /**
     * @param string $taskName
     * @return self
     */
    public function setTaskName(string $taskName): self
    {
        $this->taskName = $taskName;
        return $this;
    }

    private static function fromPrivateFields(
        string            $taskName,
        DateTimeInterface $startTime,
        float             $memory,
        int               $spendTime
    ): self
    {
        $self = new self();
        $self->taskName = $taskName;
        $self->startTime = $startTime;
        $self->memoryInMb = $memory;
        $self->spendTimeInSec = $spendTime;

        return $self;
    }
}