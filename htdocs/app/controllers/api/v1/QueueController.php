<?php
namespace api\v1;

use Symfony\Component\Console\Input\Input;

class QueueController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $queueModel = new \CustomerQueue();
            $statusCode = 200;
            $response   = [];
            $response   = $queueModel->getAllQueues();
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return \Response::json($response, $statusCode);
        }
    }


    /**
     * @return mixed
     */
    public function create()
    {
        //var_dump(\Input::all());
        try {
            $queueModel = new \CustomerQueue();
            $statusCode = 200;
            $response = [];
            $response = $queueModel->insertQueue(\Input::all());
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return \Response::json($response, $statusCode);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
