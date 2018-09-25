( function( blocks, element ) {
    var el = wp.element.createElement,
    source 		= blocks.source,
	InspectorControls = wp.editor.InspectorControls,
	category 	= {slug:'contact-form-to-email', title : 'Contact Form to Email'};
    
    /* Plugin Category */
    blocks.getCategories().push({slug: 'cpcfte', title: 'Contact Form to Email'});    
    
    /* ICONS */
	const iconCPCFTE = el('img', { width: 20, height: 20, src:  "data:image/gif;base64,R0lGODlhFAAQAOYAAP//////AP8A//8AAAD//wD/AAAA/wAAAPH2+/T4/Ofw+Mne79Pk8t3q9d/r9ePu9wxrtQxstQ1stg1rtQ1stQ5ttg9ttg9uthBtthButhFuthhzuRl0uRx1uh11uh12uh52ux53ux93uyF4uyF5uyJ5uyN6vCR6vCd8vid7vSh9vSp+vi6AvzOEwTeFwjmHwz2JxECLxUCMxUSNxkSOxkWPxlOXy1SXy12czl6ezl+ezmCezmKfz2Kgz2Sh0Gai0Wai0Gei0Wej0Wij0Wum0mym02ym0nmt1nuv132w2H6x2ICx2ICy2IGz2YS02oa12oa22om424q424y53I+73Y663JG83pG83ZvC4ZrC4JzD4Z/F4qbJ5KjK5afJ5KjK5L3X68HZ7MTb7cne7uHt9uDs9evz+fL3+9Lk8eLu9uny+PD2+vj7/fP4+/b6/P///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAG8ALAAAAAAUABAAAAfhgACCg4SFhl84QUNDQoxCjY+MQztUAEpkPREQEZybnhCeNA5XGjBqWJqfoJucSAk3FSQRJgtiHxSaFJ8YXQ4uESEjoBlcZS66mhEUJ2NhHbogI8qgR2Y2uJovDlnYECAlERKrVgBJmzoAYMqcESCyFLg5DkxnWk1sT2hLuLjRrDxuYkRg0aBNDQgoFDgBRUGEsAhCEAgEtQEcPBUPpkCYEIIEBCFrZqiCgC3CijRSIniwAMSNDFDJSKbSlEJNlAtQ0rRAVhLeKlAcGGwB4MUHkSJIixgxohTp0iI/qhiaSjUQADs=" } );  
    
    blocks.registerBlockType( 'cpcfte/cp-contact-form-to-email-step-01', {
        title: 'Contact Form to Email', 
        icon: iconCPCFTE,    
        category: 'cpcfte',
        supports: {
			customClassName: false,
			className: false
		},
		attributes: {
			shortcode : {
				type : 'string',
				source : 'text',
				default: '[CONTACT_FORM_TO_EMAIL]'
			}
		},        
    
		edit: function( props ) {
			var focus = props.isSelected;
			return [
				!!focus && el(
					InspectorControls,
					{
						key: 'cpcfte_inspector'
					},
					[
						el(
							'span',
							{
								key: 'cpcfte_inspector_help',
								style:{fontStyle: 'italic'}
							},
							'If you need help: '
						),
						el(
							'a',
							{
								key		: 'cpcfte_inspector_help_link',
								href	: 'https://form2email.dwbooster.com/contact-us',
								target	: '_blank'
							},
							'CLICK HERE'
						),
					]
				),
				el('textarea',
					{
						key: 'cpcfte_form_shortcode',
						value: props.attributes.shortcode,
						onChange: function(evt){
							props.setAttributes({shortcode: evt.target.value});
						},
						style: {width:"100%", resize: "vertical"}
					}
				)
			];
		},
    
		save: function( props ) {
			return props.attributes.shortcode;
		},
    } );

} )(
	window.wp.blocks,
	window.wp.element
);