<?php
	namespace SVX;

	use \Exception;
	use \APP_ROOT;

	use Sebastian\Kernel;
	use Sebastian\Application;

	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Utility\Configuration\Configuration;
	use Sebastian\Utility\Exception\Handler\ExceptionHandlerInterface;

	class SVX extends Application implements ExceptionHandlerInterface {
		protected $startTime;

        public function __construct(Kernel $kernel, Configuration $config = null) {
			$this->startTime = microtime(true);
			parent::__construct($kernel, $config);

			$this->registerExceptionHandler($this);
		}

		public function getWebDirectory() {
			return implode(DIRECTORY_SEPARATOR, [APP_ROOT, '..', 'web']);
		} 

		public function onException(Exception $e) {
			print ("<pre>SVX::onException => {$e->getMessage()}</pre>");
			return true;
		}

		public function shutdown(Request $request, Response $response) {
			parent::shutdown($request, $response);
			$diff = microtime(true) - $this->startTime;
		}
	}