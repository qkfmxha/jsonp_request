Ext.Loader.setConfig({
	enabled : true
});

Ext.application({
	name : 'LandLove',
	appFolder : 'js',

//	controllers : [ 'Login' ],
	views : [ 'Index' ],
//	views : [ 'twoPanel' ],

	launch : function() {
		// LandLove.views.viewport = Ext.create('LandLove.view.Login');
		var panel = Ext.create('LandLove.view.Index');
		Ext.Viewport.add(panel);
	}
});
