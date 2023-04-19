<?php
declare(strict_types=1);

namespace CCVShop\Api;

class Credentials
{
	private string $ApiHostName;
	private string $ApiPublic;
	private string $ApiSecret;

	/**
	 * @param string $ApiHostName
	 * @param string $ApiPublic
	 * @param string $ApiSecret
	 */
	public function __construct(string $ApiHostName, string $ApiPublic, string $ApiSecret)
	{
		$this->ApiHostName = $ApiHostName;
		$this->ApiPublic   = $ApiPublic;
		$this->ApiSecret   = $ApiSecret;
	}

	/**
	 * @return string
	 */
	public function GetApiHostName(): string
	{
		return $this->ApiHostName;
	}

	/**
	 * @return string
	 */
	public function GetApiPublic(): string
	{
		return $this->ApiPublic;
	}

	/**
	 * @return string
	 */
	public function GetApiSecret(): string
	{
		return $this->ApiSecret;
	}


}
