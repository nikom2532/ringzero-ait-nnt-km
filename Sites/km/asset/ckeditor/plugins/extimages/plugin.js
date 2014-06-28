CKEDITOR.plugins.add('extimages',
{
    requires: ['iframedialog'],
    init : function(editor)
    {
        CKEDITOR.dialog.addIframe('extimages_dialog', 'Image', BASE_URI + '/image',800,500)
        editor.addCommand('extimages', {exec:pyroimage_onclick});
        editor.ui.addButton('extimages',{ label:'Insert images from library', command:'extimages', icon:this.path+'images/icon.png' });

		editor.on('selectionChange', function(evt)
		{
			/*
			 * Despite our initial hope, document.queryCommandEnabled() does not work
			 * for this in Firefox. So we must detect the state by element paths.
			 */
			var command = editor.getCommand('extimages'),
				element = evt.data.path.lastElement.getAscendant('img', true);

			// If nothing or a valid document
			if ( ! element || (element.getName() == 'img' && element.hasClass('pyro-image')))
			{
				command.setState(CKEDITOR.TRISTATE_OFF);
			}

			else
			{
				command.setState(CKEDITOR.TRISTATE_DISABLED);
			}
		});
    }
});

function pyroimage_onclick(e)
{
	update_instance();
    // run when pyro button is clicked]
    CKEDITOR.currentInstance.openDialog('extimages_dialog')
}