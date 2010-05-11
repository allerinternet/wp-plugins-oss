<?php
class Stats {
	public function __construct() {
		$this->memPreRun = memory_get_usage();
		$this->timePreRun = microtime(true);
	}

	public function storeDifference() {
		$this->memPostRun = memory_get_usage();
		$this->timePostRun = microtime(true);

		$this->memUsed = $this->memPostRun - $this->memPreRun;
		$this->memUsedFmted = number_format($this->memUsed, 0, ",", " ");
		$this->timeSpent = $this->timePostRun - $this->timePreRun;
	}
}
?>