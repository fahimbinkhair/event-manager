<?php
/**
 * this a wrapper around standard DateTime class to add additional functionality used in the application
 *
 * @copyright Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App\Http\CustomFunctions;


class CFDate
{
    /**
     * convert a date string from one format to another
     *
     * @param string $inputFormat all php supported date format e.g. Y-m-d H:i:s
     * @param string $outputFormat all php supported date format e.g. Y-m-d H:i:s
     * @param string $date the date string e.g. 2018-12-01 13:01:59
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function dateConvertFormat(string $inputFormat, string $outputFormat, ?string $date): ?string
    {
        if (empty($date)) {
            CFLog::log(LOG_WARNING, 'Passed empty date to ' . __METHOD__);

            return null;
        }

        switch ($inputFormat) {
            case 'm/d/Y':
                if (!preg_match('~^[0-9]{2}/[0-9]{2}/[0-9]{4}$~', $date)) {
                    CFLog::log(
                        LOG_ERR,
                        "The input date '{$date}' does not match the declared input format '{$inputFormat}'",
                        ['exception' => ['handler' => CFLog::EXCEPTION_EXCEPTION]]
                    );
                }
                break;
            case 'Y-m-d':
                if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date)) {
                    CFLog::log(
                        LOG_ERR,
                        "The input date '{$date}' does not match the declared input format '{$inputFormat}'",
                        ['exception' => ['handler' => CFLog::EXCEPTION_EXCEPTION]]
                    );
                }
                break;
            default:
                CFLog::log(
                    LOG_ERR,
                    "Unsupported input format '{$inputFormat}' received for the date '{$date}'",
                    ['exception' => ['handler' => CFLog::EXCEPTION_EXCEPTION]]
                );
        }

        $myDateTime = \DateTime::createFromFormat($inputFormat, $date);
        $newDate = $myDateTime->format($outputFormat);

        return $newDate;
    }
}