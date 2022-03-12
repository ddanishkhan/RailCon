<?php
class LOGGER
{

    public static function log($severity, $message)
    {
        $calledFromFile = basename($_SERVER["REQUEST_URI"]);
        error_log("\n[". date("jS F Y h:i:s A") ."] [".$severity."]" . "[$calledFromFile]" . "[".$message."]", 3, "logs/logs.log");
    }
    
    public static function logWithPath($severity, $message, $logPath)
    {
        $calledFromFile = basename($_SERVER["REQUEST_URI"]);
        error_log("\n[". date("jS F Y h:i:s A") ."] [".$severity."]" . "[$calledFromFile]" . "[".$message."]", 3, $logPath);
    }
}
?>