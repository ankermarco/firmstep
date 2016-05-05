<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$timeStart = new DateTime();
		Eloquent::unguard();

		$this->call('ServiceTableSeeder');

		$this->command->info('DB seeded!');

		$timeEnd = new DateTime();
    $interval = date_diff($timeStart,$timeEnd);

    $this->command->info('Execution Time: '.$interval->format('%h:%i:%s'));
	}

}

class ServiceTableSeeder extends Seeder {

    public function run()
    {
			$services = array(
				"housing",
				"benefits",
				"council tax",
				"fly tipping",
				"missed bin"
			);

			foreach ($services as $service) {
				Service::create(array(
					'service_name' => $service
				));
			}
    }

}
