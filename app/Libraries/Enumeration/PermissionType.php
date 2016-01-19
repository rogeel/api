<?php
namespace App\Library\Enumeration;

class PermissionType extends Enum
{
    const READ_TYPE = 'read';
    const WRITE_TYPE = 'write';
    const USE_TYPE = 'use';
}