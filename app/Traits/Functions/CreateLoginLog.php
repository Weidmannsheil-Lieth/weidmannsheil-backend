<?php

namespace App\Traits\Functions;

use App\Models\LoginLog;

trait CreateLoginLog
{
    use GetIpAddress;

    /**
     * @param int $actionId
     * @param string $username
     */
    protected function createLoginLog(int $actionId, string $username)
    {
        $ip = $this->getIpAddress();

        LoginLog::create([
            'action_id'          => $actionId,
            'username'           => $username,
            'ip_address'         => $ip,
            'ip_address_details' => $this->getIpAddressDetails($ip)
        ]);
    }
}
