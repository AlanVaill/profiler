<?php


namespace AlanVaill\Profiler\Profiler;


use AlanVaill\Profiler\ProfilerInterface;
use AlanVaill\Profiler\ReporterInterface;

class XdebugProfiler implements ProfilerInterface
{
    /** @var  ReporterInterface */
    private $reporter;
    private $startTime;
    private $id;

    private $nestCount = 0;

    /**
     * XdebugProfiler constructor.
     * @param ReporterInterface $reporter
     */
    public function __construct(ReporterInterface $reporter)
    {
        $this->reporter = $reporter;
    }


    public function begin()
    {
        if($this->nestCount == 0) {
            $this->id = uniqid('trace-', true);
            $this->startTime = microtime(true);

            xdebug_start_trace(null, XDEBUG_TRACE_COMPUTERIZED);
        }
        $this->nestCount++;
    }

    /**
     * The label the profile will be logged under. This is NOT a unique value. A
     * good label might be the controller & action name serving a request.
     * @param string $label
     */
    public function end($label)
    {
        $this->nestCount--;
        $endTime = microtime(true);
        $diff = $endTime - $this->startTime;
        $fileName = xdebug_get_tracefile_name();
        if($this->nestCount == 0) {
            xdebug_stop_trace();
        }

        $id = sprintf('%s-%s', $this->id, $this->nestCount);
        $this->reporter->report($id, $label, $diff, $fileName);
    }

    /**
     * @param string $sql
     * @param array $bindings
     * @param float $time execution time
     */
    public function logQuery($sql, array $bindings, $time)
    {
        $this->reporter->reportQueryExecution($sql, $bindings, $time, $this->id);
    }

    public function logError($message)
    {
        $this->reporter->reportError($message, $this->id);
    }
}