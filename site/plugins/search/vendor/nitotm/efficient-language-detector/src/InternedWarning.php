<?php
/**
 * @copyright 2024 Nito T.M.
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Nito T.M. (https://github.com/nitotm)
 * @package nitotm/efficient-language-detector
 */

namespace Nitotm\Eld;

final class InternedWarning
{
    /**
     * Send warning if OPcache is active and interned_strings_buffer is too low for the database:
     * Some server APIs might not print "Warning Interned string buffer overflow", so we inform if memory is low
     * It's a problem since the server will hang out with no apparent reason unless you look at the server error log
     * Not a perfect solution, just warns in some cases of possible low memory. TODO research a better approach
     */
    public static function checkAndSend($databaseFile): void
    {
        $internedSizes = [
            EldDataFile::SMALL => 8,
            EldDataFile::MEDIUM => 16,
            EldDataFile::LARGE => 60,
            EldDataFile::EXTRALARGE => 116
        ]; // minimum; 170 to use all

        if (isset($internedSizes[$databaseFile])) {
            $opcacheStatus = (function_exists('opcache_get_status') ? opcache_get_status(false) : false);
            if ($opcacheStatus && $opcacheStatus['opcache_enabled']) {
                $internedStringsBuffer = ini_get('opcache.interned_strings_buffer');
                if ($internedStringsBuffer && $internedStringsBuffer < $internedSizes[$databaseFile]) {
                    trigger_error(
                        sprintf(
                            'interned_strings_buffer %smb is too low for this ELD database, recommended >= %smb',
                            $internedStringsBuffer,
                            $internedSizes[$databaseFile]
                        ),
                        E_USER_WARNING
                    );
                    // ob_flush(); flush(); Instant print, maybe too intrusive
                }
            }
        }
    }
}
