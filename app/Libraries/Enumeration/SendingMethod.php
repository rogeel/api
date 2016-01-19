<?php
namespace App\Library\Enumeration;

class SendingMethod extends Enum
{
    const EMAIL = 'email';
    const FTP = 'ftp';
    const SFTP = 'sftp';
    const UNKNOWN = 'unknown';
}