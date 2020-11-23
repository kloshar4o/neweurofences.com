/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
var roxyFileman = '/admin-assets/js/ckeditor/fileman/index.html';

CKEDITOR.editorConfig = function( config ) {
    config.filebrowserBrowseUrl = roxyFileman;
    config.filebrowserImageBrowseUrl = roxyFileman+'?';
    config.removeDialogTabs = 'link:upload;image:upload';
    config.height = 350;
    config.allowedContent = true;
    //config.disallowedContent = 'span; *{font*}; *{style*}; *{class*}; table[border*,class*]{*}; td[style]{*}';
    //config.allowedContent = true;
    //config.extraAllowedContent = 'span(*)';
    //config.pasteFilter = 'semantic-text';
    //editor.pasteFilter.disallow( 'span; *{font*}; *{style*}; *{class*}; table[border*,class*]{*}; td[style]{*}' );
    config.pasteFilter = 'semantic-content';

    config.removePlugins = 'iframe';
    config.extraPlugins = "youtube";
};
