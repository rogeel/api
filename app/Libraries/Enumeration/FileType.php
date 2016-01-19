<?php
namespace App\Library\Enumeration;

class FileType extends Enum
{
    const XML = 'xml';
    const EXCEL = 'excel';
    const CSV = 'csv';
    const X12 = 'X12';
    const UNKNOWN = 'unknown';
}