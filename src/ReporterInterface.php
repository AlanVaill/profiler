<?php


namespace AlanVaill\Profiler;


interface ReporterInterface
{
    public function report($id, $label, $time, $traceFile);

    public function reportQueryExecution($sql, $bindings, $time, $profileId = null);

    public function reportError($message, $profileId = null);
}