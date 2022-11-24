<?php
namespace App\Contracts;

interface RequestContract
{
    public function getSuggession($request);
    public function getSentRequest($request);
    public function getReceiveRequest($request);
    public function getConnectedRequest($request);
    public function connectionRequest($request);
    public function withdrawRequest($request);
    public function acceptRequest($request);
    public function cancelRequest($request);
    public function common_connection($auth_connection = null, $con);
    public function common($user_id);
}
