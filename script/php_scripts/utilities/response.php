<?php

class JsonResponse
{
    public static function send($status, $message = "", $data = [], $httpCode = null)
    {
        // Clean any previous output
        if (ob_get_length()) {
            ob_clean();
        }

        header('Content-Type: application/json');
        http_response_code($httpCode ?? self::getHttpCode($status));

        try {
            echo json_encode([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'JSON encoding error: ' . $e->getMessage()
            ]);
        }

        exit;
    }

    private static function getHttpCode($status)
    {
        return match ($status) {
            'success' => 200,
            'fail'    => 200,
            'error'   => 500,
            default   => 200,
        };
    }
}
