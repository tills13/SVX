<?php
	namespace SVX\Common\Entity;

	use Sebastian\Core\Model\UserInterface;
	use Sebastian\Core\Model\EntityInterface;
	use \JsonSerializable;
	use \DateTime;

	class Farmer implements UserInterface,JsonSerializable {
		protected $createdAt;
		protected $gold;
		protected $id;
		protected $isAdmin;
		protected $lastSync;
		protected $modifiedAt;		
		protected $name;
		protected $rawId;
		protected $token;
		protected $trades;
		protected $username;

		public function __construct() {}

		public function setCreatedAt(DateTime $createdAt) {
			$this->createdAt = $createdAt;
		}

		public function getCreatedAt() {
			return $this->createdAt;
		}

		public function setGold($gold) {
			$this->gold = $gold;
		}

		public function getGold($formatted = false) {
			return $formatted ? number_format($this->gold) : $this->gold;
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setIsAdmin($isAdmin) {
			$this->isAdmin = $isAdmin;
		}

		public function getIsAdmin() {
			return $this->isAdmin;
		}

		public function setLastSync(DateTime $lastSync) {
			$this->lastSync = $lastSync;
		}

		public function getLastSync() {
			return $this->lastSync;
		}

		public function setModifiedAt(DateTime $modifiedAt) {
			$this->modifiedAt = $modifiedAt;
		}

		public function getModifiedAt() {
			return $this->modifiedAt;
		}

		public function setName($name) {
			$this->name = $name;
		}

		public function getName() {
			return $this->name;
		}

		public function setRawId($rawId) {
			$this->rawId = $rawId;
		}

		public function getRawId() {
			return $this->rawId;
		}

		public function setToken(string $token) {
			$this->token = $token;
		}

		public function getToken() : string {
			return $this->token;
		}

		public function setTrades(array $trades = []) {
			$this->trades = $trades;
		}

		public function getTrades() {
			return $this->trades;
		}

		public function setUsername($username) {
			$this->username = $username;
		}

		public function getUsername() {
			return $this->username;
		}

		public function isAdmin() {
			return $this->isAdmin;
		}

		public function equals(Farmer $farmer = null) {
			return $farmer ? ($this->getId() == $farmer->getId()) : false;
		}

		public function jsonSerialize() {
			return [
				'id' => $this->getId(),
				'name' => $this->getName(),
				'gold' => $this->getGold(),
				'username' => $this->getUsername(),
				'raw_id' => $this->getRawId(),
				'trades' => array_map(function($trade) {
					return [
						'id' => $trade->getId(),
						'buyer' => $trade->getBuyer() ? $trade->getBuyer()->getUsername() : null,
						'items' => $trade->getItems(),
						'status' => $trade->getStatus()
					];
				}, $this->getTrades()),
				'created_at' => $this->getCreatedAt(),
				'modified_at' => $this->getModifiedAt()
			];
		}
		
		public function __toString() {
			return json_encode($this);
		}
	}