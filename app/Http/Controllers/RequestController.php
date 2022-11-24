<?php

namespace App\Http\Controllers;

use App\Contracts\RequestContract;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestRepository;

    public function __construct(RequestContract $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    public function index(Request $request)
    {
        try {

            $data = [];
            return view('home', compact('data'));

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function getSuggesstions(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestRepository->getSuggession($request);
            $returnProductHTML = view('components.suggestion', ['suggesstions' => $data['data'], 'count' => $data['count']])->render();
            if ($returnProductHTML != '') {
                $status = true;
            }
            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function getSentRequest(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestRepository->getSentRequest($request);
            $returnProductHTML = view('components.request', ['requests' => $data['data'], 'mode' => 'sent'])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function getReceiveRequest(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestRepository->getReceiveRequest($request);
            $returnProductHTML = view('components.request', ['requests' => $data['data'], 'mode' => 'receive'])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function getConnected(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestRepository->getConnectedRequest($request);
            $returnProductHTML = view('components.connection', ['connections' => $data['data']])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function getCommon(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestRepository->common_connection(null, $request->id);
            $returnProductHTML = view('components.connection_in_common', ['commons' => $data])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }

    public function sendRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $connection = $this->requestRepository->connectionRequest($request);
            if ($connection) {
                $message = 'Connection Request Sent!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function withdrawRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $withdraw = $this->requestRepository->withdrawRequest($request);
            if ($withdraw) {
                $message = 'Request Withdraw!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function acceptRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $withdraw = $this->requestRepository->acceptRequest($request);
            if ($withdraw) {
                $message = 'Request Accepted!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }
    public function cancelRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $cancelled = $this->requestRepository->cancelRequest($request);
            if ($cancelled) {
                $message = 'Request Cancelled!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$e) {

            return $e->getMessage();
        }
    }

}
