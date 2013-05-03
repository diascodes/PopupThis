(function() {

    tinymce.create('tinymce.plugins.popupThis', {

        init : function(ed, url){

            ed.addButton('popupThis', {
                title : 'Generate a popup',
                onclick : function() {
                    if( ed.selection.getContent() ){
                        ed.execCommand('mceInsertContent', false, '[popupThis label="Read more" autodimensions="false" width="auto" height="auto"]' + ed.selection.getContent() + '[/popupThis]');
                    }else{
                        alert('Please select some texts to show it on the popup');
                    }
                }
            });

        },

        getInfo : function() {
            return {
                longname : 'PopupThis',
                author : 'SAID ASSEMLAL',
                authorurl : 'http://www.diascodes.com',
                infourl : '',
                version : "1.0"
            };
        }
    });

    tinymce.PluginManager.add('popupThis', tinymce.plugins.popupThis);
    
})();
