<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    // Метод для получения информации о сервере
    public function serverInfo()
    {
        ob_start();
        phpinfo();
        $phpinfo = ob_get_clean();

        return response()->json([
            'phpinfo' => $phpinfo,
        ]);
    }

    // Метод для получения информации о клиенте
    public function clientInfo(Request $request)
    {
        $clientIp = $request->ip();
        $userAgent = $request->header('User-Agent');

        return response()->json([
            'ip' => $clientIp,
            'user_agent' => $userAgent,
        ]);
    }

    // Метод для получения информации о базе данных
    public function databaseInfo()
    {
        $databaseConnection = config('database.default');
        $databaseName = config("database.connections.{$databaseConnection}.database");

        return response()->json([
            'database_connection' => $databaseConnection,
            'database_name' => $databaseName,
        ]);
    }
}
