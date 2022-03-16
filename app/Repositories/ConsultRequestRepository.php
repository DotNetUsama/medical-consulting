<?php


namespace App\Repositories;

use App\Models\ConsultRequest;

class ConsultRequestRepository
{
    public function all() {
        return ConsultRequest::all();
    }

    public function create(array $requestData) {
        $request = new ConsultRequest($requestData);
        $request->user()->associate(auth()->id())->save();
    }
}
