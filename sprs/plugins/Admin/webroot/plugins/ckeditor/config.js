/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
var siteUrl = "/triocab";
CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.filebrowserBrowseUrl = siteUrl + '/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files';

    config.filebrowserImageBrowseUrl = siteUrl + '/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images';

    config.filebrowserFlashBrowseUrl = siteUrl + '/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash';

    config.filebrowserUploadUrl = siteUrl + '/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files';

    config.filebrowserImageUploadUrl = siteUrl + '/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images';

    config.filebrowserFlashUploadUrl = siteUrl + '/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash';
    config.allowedContent = true;
    config.extraAllowedContent = '*(*)';
    config.protectedSource.push(/<i[^>]*><\/i>/g);
    config.extraPlugins = 'youtube';
    config.skin = 'moonocolor';

};
