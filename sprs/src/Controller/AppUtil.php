<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of AppUtil
 *
 * @author Jaldeep
 */
class AppUtil {

    public static function FileExt($contentType) {
        $map = array(
            'application/pdf' => '.pdf',
            'application/zip' => '.zip',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'text/css' => '.css',
            'text/html' => '.html',
            'text/javascript' => '.js',
            'text/plain' => '.txt',
            'text/xml' => '.xml',
        );
        if (isset($map[$contentType])) {
            return $map[$contentType];
        }

        // HACKISH CATCH ALL (WHICH IN MY CASE IS
        // PREFERRED OVER THROWING AN EXCEPTION)
        $pieces = explode('/', $contentType);
        return '.' . array_pop($pieces);
    }

}
