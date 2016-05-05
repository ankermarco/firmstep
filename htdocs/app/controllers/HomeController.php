<?php

/**
 * Class HomeController
 */
class HomeController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    /**
     * @return mixed
     */
    public function showWelcome()
    {
        $customerQueueModel = new CustomerQueue();
        $customerQueues     = $customerQueueModel->getAllQueues();

        $services = Service::all();

        return View::make(
            'hello',
            array (
                'services'       => $services,
                'customerQueues' => $customerQueues['queues']
            )
        );
    }
}
