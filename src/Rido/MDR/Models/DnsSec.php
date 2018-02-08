<?php 
/**
 * 
 *
 * @package 	MijnDomeinReseller
 * @copyright	Mijn Domein Reseller
 *
 * @author  Rick Doorakkers
 * @author  Erik Kraijenoord <erikkraijenoord@gmail.com>
 */

namespace Rido\MDR\Models;

class DnsSec extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = [
		'domein',
		'tld',

		'dnssec_records',
	];

	/**
	 * @param $domain
	 * @param $tld
	 *
	 * @return mixed
	 */
	public function find($domain, $tld)
	{
		$result = $this->connection->get('dnssec_get_details', [
			'domein' => $domain,
			'tld'	 => $tld,
		]);

		$result = $this->processDnsSecRecords($result);
		return $this->createObjectFromResponse($result);
	}

	/**
	 * @param $result
	 *
	 * @return mixed
	 */
	protected function processDnsSecRecords($result)
	{
		if (isset($result['items']) && count($result['items'])) {
			$result['dnssec_records'] = [];

			foreach($result['items'] as $item) {
				$result['dnssec_records'][] = new DnsSecRecord($this->connection, $item);
			}
		}

		return $result;
	}
}