<?php
/**
 * Class Queue
 */
class CustomerQueue extends \Eloquent
{
    /**
     * The database table used by the model.
     */
    protected $table = 'queue';

    // Laravel will automatically update the created_at and updated_at
    public $timestamps = true;

    /**
     * @return array
     */
    public function getAllQueues()
    {
        $response = [
            'queues'  => []
        ];
        $queues = DB::table('queue')
            ->join('service', 'service.id', '=', 'queue.service_id')
            ->select('queue.*', 'service.service_name')
            ->orderBy('queue.id', 'asc')
            ->get();

        foreach ($queues as $queue) {
            $response['queues'][] = [
                'id'            => $queue->id,
                'customer_type' => $queue->customer_type,
                'name'          => $queue->name,
                'service_name'  => $queue->service_name,
                'queued_at'     => $queue->created_at,
            ];
        }

        return $response;
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function insertQueue($request)
    {
        $insertedQueue = array();
        $queue = new CustomerQueue();
        $service = new \Service();
        $validator = \Validator::make(
            $request,
            array(
                'service'       =>  'numeric',
                'customerType'  =>  'alpha_dash',
                'firstName'     =>  'alpha_dash',
                'lastName'      =>  'alpha_dash',
                'organisation'  =>  'alpha_dash'
            ),
            array(
                'required'      =>  'FIELD_REQUIRED',
                'numeric'       =>  'FIELD_REQUIRED_NUMERIC',
                'alpha_dash'    =>  'FIELD_CHARS_INVALID',
            )
        );

        if ($validator->passes()) {
            $customerType = filter_var($request['customerType'], FILTER_SANITIZE_STRING);
            $name = filter_var(
                $request['title'] . ' ' . $request['firstName'] . ' ' . $request['lastName'],
                FILTER_SANITIZE_STRING
            );
            if ($customerType == 'anonymous') {
                $name = 'anonymous';
            }
            if ($customerType == 'organisation') {
                $name = $name . ' (' . filter_var($request['organisation'], FILTER_SANITIZE_STRING) . ')';
            }

            $service = filter_var($request['service'], FILTER_SANITIZE_STRING);

            DB::beginTransaction();

            // Add a queue
            try {
                $queue->customer_type = $customerType;
                $queue->name = $name;

                $queue->service_id = $service;

                $queue->save();
            } catch (Exception $e) {
                DB::rollback();
            }

            DB::commit();
            // Fetch service name

            $serviceName = ucwords(
                DB::table('service')
                ->where('id', $service)
                ->pluck('service_name')
            );
            $insertedQueue = array(
                "id"           => $queue->id,
                "service"      => $serviceName,
                "customerType" => ucwords($customerType),
                "name"         => $name,
                "queuedAt"     => date('h:i', time()),
            );
        } else {
            //var_dump($validator->errors());
        }

        return $insertedQueue;
    }
}
