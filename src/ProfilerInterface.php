<?php


namespace AlanVaill\Profiler;


interface ProfilerInterface
{
    /**
     * @return string trace id
     */
    public function begin();

    /**
     * The name the profile will be logged under. This is NOT a unique value. A
     * good name might be the controller & action name serving a request.
     * @param string $label
     */
    public function end($label);

    /**
     * @param string $sql
     * @param array $bindings
     * @param float $time execution time
     */
    public function logQuery($sql, array $bindings, $time);

    /**
     * @param string $message
     */
    public function logError($message);
}