<?php


namespace AlanVaill\Profiler\Profiler;


use AlanVaill\Profiler\ProfilerInterface;

class NoOpProfiler implements ProfilerInterface
{

    public function begin()
    {
        // noop
    }

    /**
     * The name the profile will be logged under. This is NOT a unique value. A
     * good name might be the controller & action name serving a request.
     * @param string $label
     */
    public function end($label)
    {
        // noop
    }

    /**
     * @param string $sql
     * @param array $bindings
     * @param float $time execution time
     */
    public function logQuery($sql, array $bindings, $time)
    {
        // noop
    }

    /**
     * @param string $message
     */
    public function logError($message)
    {
        // noop
    }
}