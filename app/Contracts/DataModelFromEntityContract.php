<?php

namespace App\Contracts;

interface DataModelFromEntityContract
{
	/**
	 * Convert entity to model.
	 *
	 * @param $entity
	 *
	 * @return mixed
	 */
	public function FromEntity($entity);
}