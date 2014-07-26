// urlArgs is important to stop it caching functions
// change the v is you need to
  require.config({
	  	paths: {
	    jquery: 'libs/jquery/jquery',
	    backbone: 'libs/backbone/backbone',
	    handlebars: 'libs/handlebars/handlebars',
	    underscore: 'libs/underscore/underscore'
	  },
     urlArgs: "bust=v1"
  });
/*
require([
  // Load our app module and pass it to our definition function
  'app',
], function(App){
  // The "app" dependency is passed in as "App"
  App.initialize();


}); */

require( [ "jquery", 
			"js/libs/bootstrap/bootstrap.min.js",
			"js/libs/jquery/jquery.qtip.js",
			"js/libs/jquery/jquery-ui-1.8.21.custom.min.js",
			"js/libs/handlebars/handlebars.js",
		//	"js/easydocs/applicationSetup.js",
		//	"js/easydocs/questions-flow.js",		
			"js/easydocs/pagination.js",
			"easydocs/easydocs.loginMenu",
			"easydocs/easydocs.welcomeMessage",
		//	"jqueryFunctions/easydocs.workbench"
			], function($) {
   					    //the jquery.alpha.js and jquery.beta.js plugins have been loaded.
					    $(function() {
        					var loginMenu_data = { title: "Logged in:", name:"ff Watters"} ; 
							var welcomeMessage_Data = { name: "Pete1", welcomeMessage:"The home of easy, painless paperwork!"} ; 
							$("#menu").loginMenu(loginMenu_data);							
							$("#welcomemsg").welcomeMessage(welcomeMessage_Data);
					    });
});
