<?php

declare(strict_types=1);

namespace Brick\DateTime;

/**
 * Measures the time elapsed.
 */
final class Stopwatch
{
    /**
     * @var Clock
     */
    private $clock;

    /**
     * The total time the stopwatch has been running, excluding the time elapsed since it was started.
     *
     * Every time the stopwatch is stopped, the elapsed time is added to this value.
     *
     * @var Duration
     */
    private $duration;

    /**
     * The time the stopwatch has been started at, or null if it is not running.
     *
     * @var Instant|null
     */
    private $startTime;

    /**
     * Class constructor.
     *
     * @param Clock|null $clock An optional clock to use.
     */
    public function __construct(Clock $clock = null)
    {
        if ($clock === null) {
            $clock = DefaultClock::get();
        }

        $this->clock    = $clock;
        $this->duration = Duration::zero();
    }

    /**
     * Starts the timer.
     *
     * If the timer is already started, this method does nothing.
     *
     * @return void
     */
    public function start() : void
    {
        if ($this->startTime === null) {
            $this->startTime = $this->clock->getTime();
        }
    }

    /**
     * Stops the timer.
     *
     * If the timer is already stopped, this method does nothing.
     *
     * @return void
     */
    public function stop() : void
    {
        if ($this->startTime === null) {
            return;
        }

        $endTime = $this->clock->getTime();
        $duration = Duration::between($this->startTime, $endTime);

        $this->duration = $this->duration->plus($duration);
        $this->startTime = null;
    }

    /**
     * Returns the time this stopwatch has been started at, or null if it is not running.
     *
     * @return Instant|null
     */
    public function getStartTime() : ?Instant
    {
        return $this->startTime;
    }

    /**
     * @return bool
     */
    public function isRunning() : bool
    {
        return $this->startTime !== null;
    }

    /**
     * Returns the total elapsed time.
     *
     * This includes the times between previous start() and stop() calls if any,
     * as well as the time since the stopwatch was last started if it is running.
     *
     * @return Duration
     */
    public function getElapsedTime() : Duration
    {
        if ($this->startTime === null) {
            return $this->duration;
        }

        return $this->duration->plus(Duration::between($this->startTime, $this->clock->getTime()));
    }
}
