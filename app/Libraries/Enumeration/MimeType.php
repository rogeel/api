<?php
namespace App\Library\Enumeration;

/**
 * This class contains mime types that we will use throughout the project
 */
class MimeType extends Enum
{
    // Common Image Mime Types
    const JPG = 'image/jpeg';
    const GIF = 'image/gif';
    const PNG = 'image/png';
    const TIF = 'image/tiff';

    // Common Video Mime Types
    const MP4 = 'video/mp4';
    const MOV = 'video/quicktime';
    const FLV = 'video/x-flv';
    const OGV = 'video/ogg';
    const WEBM = 'video/webm';

    // Common Application Mime Types
    const PDF = 'application/pdf';
    const XLS = 'application/excel';
    const DOC = 'application/msword';
}