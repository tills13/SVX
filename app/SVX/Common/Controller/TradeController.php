<?php
	namespace SVX\Common\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\JsonResponse;

	class TradeController extends Controller {
		public function listAction(Request $request) {
			$page = $request->get('page', 0);
			$limit = $request->get('limit', 10);
			$offset = $page * $limit;

			$em = $this->getEntityManager();
			$repo = $em->getRepository('Trade');

			$trades = $repo->find(['status' => 'open'], [
				'orderBy' => ['id' => 'desc'],
				'limit' => $limit,
				'offset' => $offset
			]);

			return $this->render('trades/list', [
				'trades' => $trades,
				'page' => $page
			]);
		}

		public function overviewAction(Request $request, $trade) {
			$em = $this->getEntityManager();
			$tradeRepo = $em->getRepository('Trade');
			$trade = $tradeRepo->get($trade);
			
			return $this->render('trades/overview', [
				'trade' => $trade
			]);
		}
	}