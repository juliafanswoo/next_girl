/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.uiColor = '#DDDDDD';
    config.height = 350;
    config.language = 'zh';
    config.allowedContent = true;
    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_P;
    // 使用bbcode 開啟 BB Code 模式 ， extraPlugins: 'bbcode'
    // config.extraPlugins = 'bbcode';
    config.font_names = 'Arial;Arial Black;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana;新細明體;細明體;標楷體;微軟正黑體';
    config.fontSize_sizes = '100%/100%;120%/120%;150%/150%;200%/200%;250%/250%;300%/300%;350%/350%';
    config.toolbar = 'basic';
    config.toolbar_bbcode =
    [
        ['FontSize','Bold','Italic','Underline','TextColor'],
        ['Image','Link','Unlink'],
        ['Source']
    ];
    config.toolbar_note =
    [
        ['FontSize','Font','Bold','Italic','Underline','TextColor'],
        ['Image','Link','Unlink','Table','HorizontalRule','RemoveFormat'],
        ['NumberedList','BulletedList','JustifyLeft','JustifyCenter','JustifyRight'],
        ['Source']
    ];
    config.toolbar_html =
    [
        ['FontSize','Font','Format','Styles','Bold','Italic','Underline','Strike','Subscript','Superscript','TextColor','BGColor'],
        ['Source','-','SelectAll', 'Preview'],
        '/',
         ['Image','Link','Unlink','Anchor','Table','HorizontalRule','SpecialChar','PageBreak','RemoveFormat'], ['NumberedList','BulletedList','JustifyLeft','JustifyCenter','JustifyRight','Outdent','Indent','Blockquote','CreateDiv'],
         ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField', 'Iframe'],
        [ 'Find', 'Replace', 'ShowBlocks','Scayt','PasteFromWord' ],
    ];
};

