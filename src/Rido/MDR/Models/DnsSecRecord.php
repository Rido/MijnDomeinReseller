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

class DnsSecRecord extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = [
		'domein',
		'tld',

		'flag',
		'algorithm',
		'publickey',
		'record_id',
	];

	/**
	 * @param $domain
	 * @param $tld
	 *
	 * @return array
	 */
	public function find($domain, $tld)
	{
		$result = $this->connection->get('dnssec_get_details', [
			'domein' => $domain,
			'tld'    => $tld,
		]);

		return $result;
	}

	/**
	 * @param array $attributes
	 *
	 * @return array
	 */
	public function create(array $attributes = [])
	{
		$this->fill($attributes);

		$result = $this->connection->put('dnssec_record_add', $this->attributes);

		return $result;
	}

	/**
	 * @param array $attributes
	 *
	 * @return array
	 */
	public function update(array $attributes = [])
	{
		$this->fill($attributes);

		$result = $this->connection->put('dnssec_record_modify', $this->attributes);

		return $result;
	}

	/**
	 * @param array $attributes
	 *
	 * @return array
	 */
	public function remove(array $attributes = [])
	{
		$this->fill($attributes);

		$result = $this->connection->put('dnssec_record_del', $this->attributes);

		return $result;
	}
}