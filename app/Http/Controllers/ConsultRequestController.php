<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Requests\UserConsultRequest;
use App\Models\ConsultRequest;
use App\Repositories\ConsultRequestRepository;

class ConsultRequestController extends Controller
{
    /**
     * @var ConsultRequestRepository
     */
    private $consultRequestRepository;

    public function __construct(ConsultRequestRepository $consultRequestRepository)
    {
        $this->consultRequestRepository = $consultRequestRepository;
    }

    public function index() {
        return view('pages.requests.index', [
            'requests' => $this->consultRequestRepository->all()
        ]);
    }

    public function consultForm() {
        return view('pages.requests.create');
    }

    public function replyForm(ConsultRequest $consultRequest) {
        return view('pages.requests.reply', ['request' => $consultRequest]);
    }

    public function reply(ConsultRequest $consultRequest, ReplyRequest $request) {
        try {
            $consultRequest->update(['doctor_reply' => $request->validated()['doctor_reply']]);
            session()->flash('success', 'request replied successfully.');
            return redirect(route('requests.index'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('requests.index'));
        }
    }

    public function show(ConsultRequest $request) {
        $currentUser = auth()->user();
        if ($request->user_id !== $currentUser->id && !$currentUser->hasRole('admin')) {
            abort('403');
        }
        return view('pages.requests.show', ['request' => $request]);
    }

    public function consult(UserConsultRequest $request) {$topicData = $request->validated();
        try {
            $this->consultRequestRepository->create($topicData);
            session()->flash('success', 'request created successfully, we will reply ASAP!.');
            return redirect(route('requests.my-requests'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('requests.my-requests'));
        }
    }

    public function myRequests() {
        return view('pages.requests.my_requests', [
            'requests' => auth()->user()->requests()->latest()->get()
        ]);
    }
}
