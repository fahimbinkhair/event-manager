<?php
/**
 * default logger for the application
 *
 * @author Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App\Http\CustomFunctions;


use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;

class CFLog
{
    /**
     * to throw new Exception
     */
    const EXCEPTION_EXCEPTION = 'Exception';

    /**
     * to throw new UnexpectedValueException
     */
    const EXCEPTION_UnexpectedValueException = 'UnexpectedValueException';

    /**
     * @param int $priority
     * @see syslog() from $priority
     * @param string $message
     * @param array $exception
     * e.g. ['exception' => ['handler' => CFLog::EXCEPTION_UnexpectedValueException, 'code' => 200]]
     *
     * @throws \Exception
     */
    public static function log(int $priority, string $message, array $exception = array()): void
    {
        $message = $message ?? '';
        syslog($priority, $message);

        $exceptionHandler = CFArray::getArrayValue($exception, 'exception->handler');

        switch ($exceptionHandler) {
            case self::EXCEPTION_UnexpectedValueException:
                $expectedType = CFArray::getArrayValue($exception, 'exception->expectedType', 0);
                throw new UnexpectedTypeException($message, $expectedType);
                break;
            case self::EXCEPTION_EXCEPTION:
                $exceptionCode = CFArray::getArrayValue($exception, 'exception->code', 0);
                throw new \Exception($message, $exceptionCode);
                break;
        }
    }
}